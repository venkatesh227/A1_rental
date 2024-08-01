<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Product_images;
use App\Models\userRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session()->has('userId')) {
                $this->user = UserRegister::select('first_name')->find(session('userId'));
            }

            // Share user data with views
            view()->share('user', $this->user);

            return $next($request);
        });
    }

    public function index()
    {
        $category = Category::all();
        return view('index', compact('category'));
    }
    public function login()
    {

        return view('auth.userLogin');
    }
    public function product_listajax()
    {
        $products = Product::select('name')->where('status', '1')->get();

        $data = [];
        foreach ($products as $item) {
            $data[] = $item['name'];
        }
        return response()->json($data);
    }
    public function search_product(Request $request)
    {
        $search_product = $request->input('product-name');

        if ($search_product !== "") {
            $product = Product::where('name', 'LIKE', '%' . $search_product . '%')->first();
            if ($product) {
                return redirect('product-details/' . $product->subcategory_id . '/' . $product->id);
            } else {
                return redirect()->back()->with('status', 'No products matched');
            }
        } else {
            return redirect()->back();
        }
    }
    public function view_email()
    {
        $category = Category::all();
        return view('frontend.email', compact('category'));
    }
    public function send_mail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'],
            'subject' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'content' => 'required',
            'captcha' => 'required|string',
        ], [
            'name.required' => 'Name is required',
            'name.regex' => 'Spaces and Letters are allowed',
            'email.required' => 'Email is required',
            'email.regex' => 'Please enter a valid email',
            'subject.required' => 'Subject is required',
            'subject.regex' => 'Spaces and Letters are allowed',
            'content.required' => 'Message is required',
            'captcha.required' => 'Captcha is required',
            'captcha.string' => 'Captcha must be a string',
        ]);

        if ($request->input('captcha') !== Session::get('captcha')) {
            return redirect()->back()->withErrors([
                'captcha' => 'Captcha doesn\'t match!'
            ])->withInput();
        }


        $data = [
            'subject' => $request->input('subject'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('content'),
        ];

        Mail::send('frontend.emailData', $data, function ($message) use ($data) {
            $message->to('satyavathi.tummala01@gmail.com')
                ->subject($data['subject']);
        });

        return redirect('/')->with('status', 'Email successfully sent!');
    }

    public function view_subCategory($id)
    {
        $category = Category::all();
        $category_name = Category::find($id);

        if (Subcategory::where('category_id', $id)->exists()) {

            $Subcategory = Subcategory::where('category_id', $id)->paginate(8);
            return view('frontend.subCategoryView', compact('Subcategory', 'category', 'category_name'));
        } else {

            return view('frontend.subCategoryView', compact('category', 'category_name'))->with('error', 'No subcategories found for this category');
        }
    }

    public function view_products($sub_id)
    {
        $category = Category::all();
        if (Product::where('subcategory_id', $sub_id)->where('status', '1')->exists()) {

            $Product = Product::where('subcategory_id', $sub_id)->where('status', '1')->get();

            return view('frontend.productsView', compact('category', 'Product'));
        } else {
            return view('frontend.productsView', compact('category'));
        }
    }

    public function product_details($sub_id, $prod_id)
    {
        $category = Category::all();
        if (Product::where('subcategory_id', $sub_id)->where('id', $prod_id)->exists()) {
            $Product = Product::where('subcategory_id', $sub_id)->where('id', $prod_id)->where('status', '1')->first();
            if ($Product) {
                $productImage = Product_images::where('product_id', $Product->id)->first();
                $productImages = Product_images::where('product_id', $Product->id)->get();
            }
            return view('frontend.productDetails', compact('category', 'Product', 'productImage', 'productImages'));
        } else {

            return redirect('/')->with('error', 'No products found for this category.');
        }
    }
    public function add_to_cart(Request $request)
    {

        $pro_id = $request->input('product_id');
        $pro_qty = $request->input('product_qty');

        if (session('userId')) {
            $user_id = session('userId');
            if (Cart::where('prod_id', $pro_id)->where('user_id', $user_id)->exists()) {
                return response()->json(['status' => " Already Added To Cart"]);
            } else {
                $cartitem = new Cart();
                $cartitem->prod_id = $pro_id;
                $cartitem->user_id = $user_id;
                $cartitem->prod_qty = $pro_qty;
                $cartitem->created_by = $user_id;
                $cartitem->save();
                return response()->json(['status' => "Added To Cart"]);
            }
        } else {
            return response()->json(['status' => "Login to continue", 'redirect' => true]);
        }
    }

    public function view_cart()
    {
        $category = Category::all();
        $cartitems = Cart::where('user_id', session('userId'))->get();
        $productImages = [];

        foreach ($cartitems as $item) {
            $images = Product_images::where('product_id', $item->prod_id)->first();
            $productImages[$item->id] = $images;
        }

        return view('frontend.cart', compact('category', 'cartitems', 'productImages'));
    }
    public function delete_cart_item(Request $request)
    {
        if (session('userId')) {
            $prod_id = $request->input('prod_id');
            $user_id = session('userId');
            if (Cart::where('prod_id', $prod_id)->where('user_id', $user_id)->exists()) {
                $cartitem = Cart::where('prod_id', $prod_id)->where('user_id', $user_id)->first();
                $cartitem->delete();
                return response()->json(['status' => "Product deleted successfully"]);
            } else {
                return response()->json(['status' => "login to continue"]);
            }
        }
    }

    public function updateCart(Request $request)
    {
        if (session('userId')) {
            $prod_id = $request->input('prod_id');
            $product_qty = $request->input('product_qty');
            if (Cart::where('prod_id', $prod_id)->where('user_id', session('userId'))->exists()) {
                $cartqty = Cart::where('prod_id', $prod_id)->where('user_id', session('userId'))->first();
                $cartqty->prod_qty = $product_qty;
                $cartqty->update();
                return response()->json(['status' => "Quantity updated"]);
            }
        } else {
            return response()->json(['status' => "Login to continue"]);
        }
    }


    public function place_order(Request $request)
    {
        $order = new Order();
        $order->order_no = rand(1111, 9999);
        $order->user_id = session('userId');
        $order->no_of_products = $request->input('no_of_products');
        $order->grand_total = $request->input('grand_total');
        $order->created_by = session('userId');
        ;
        $order->save();
        $cartitems = Cart::where('user_id', session('userId'))->get();

        foreach ($cartitems as $item) {

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'subtotal' => $item->products->selling_price * $item->prod_qty,
                'single_price' => $item->products->selling_price,
                'created_by' => session('userId'),

            ]);
            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }
        $cartitems = Cart::where('user_id', session('userId'))->get();
        Cart::destroy($cartitems);

        return redirect('cart')->with('status', 'order placed successfully');
    }

    public function myorders()
    {
        $orders = Order::where('user_id', session('userId'))->get();
        return view('frontend.orders.myorder', compact('orders'));
    }

    public function view_my_order($id, $user_id)
    {
        $orderDetails = OrderDetail::with('product')->where('order_id', $id)->get();
        $userDetails = userRegister::find($user_id);

        return view('frontend.orders.view', compact('orderDetails', 'userDetails'));
    }

    public function showCaptcha()
    {
        $captcha = $this->generateCaptcha();
        Session::put('captcha', $captcha['text']);

        return response()->make($captcha['image']);
    }

    private function generateCaptcha()
    {
        $width = 120;
        $height = 40;
        $image = imagecreatetruecolor($width, $height);

        // Colors
        $background = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);
        $lineColor = imagecolorallocate($image, 64, 64, 64);

        // Fill background
        imagefill($image, 0, 0, $background);

        // Add random lines
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
        }

        // Generate random text
        $text = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"), 0, 5);

        // Using GD's built-in font (font size 5 is built-in and doesn't need external file)
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textHeight = imagefontheight($fontSize);

        // Calculate the position of the text
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;

        // Add the text to the image
        imagestring($image, $fontSize, $x, $y, $text, $textColor);

        // Output the image
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        imagedestroy($image);

        return ['image' => $imageData, 'text' => $text];
    }

}
