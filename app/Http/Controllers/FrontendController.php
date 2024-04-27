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

class FrontendController extends Controller
{
    public function  index()
    {
        $category  = Category::all();
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
        return view('frontend.email');
    }
    public function send_mail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'name' => 'required',
            'content' => 'required',
        ]);

        $data = [
            'subject' => $request->input('subject'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('content'),
        ];


        Mail::send('frontend.emailData', $data, function ($message) use ($data) {
            $message->to('meranna60@gmail.com')
                ->subject($data['subject']);
        });



        return redirect('/')->with('status', 'Email successfully sent!');
    }

    public function view_subCategory($id)
    {

        $category_name = Category::find($id);

        if (Subcategory::where('category_id', $id)->exists()) {

            $Subcategory = Subcategory::where('category_id', $id)->paginate(8);
            return view('frontend.subCategoryView', compact('Subcategory', 'category_name'));
        } else {

            return view('frontend.subCategoryView', compact('category_name'))->with('error', 'No subcategories found for this category');
        }
    }

    public function view_products($sub_id)
    {
    
        if (Product::where('subcategory_id', $sub_id)->where('status', '1')->exists()) {

            $Product = Product::where('subcategory_id', $sub_id)->where('status', '1')->get();
            return view('frontend.productsView', compact('Product'));
        } else {
            return view('frontend.productsView');
        }
    }

    public function product_details($sub_id, $prod_id)
    {
    
        if (Product::where('subcategory_id', $sub_id)->where('id', $prod_id)->exists()) {
            $Product = Product::where('subcategory_id', $sub_id)->where('id', $prod_id)->where('status', '1')->first();

            if ($Product) {
                $productImage = Product_images::where('product_id', $Product->id)->first();
                $productImages = Product_images::where('product_id', $Product->id)->get();
            }
            return view('frontend.productDetails', compact('Product', 'productImage', 'productImages'));
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
                return response()->json(['status' =>  "Added To Cart"]);
            }
        } else {
            return response()->json(['status' => "login to continue"]);
        }
    }
    public function view_cart()
    {
        $cartitems = Cart::where('user_id', session('userId'))->get();
        $productImages = [];

        foreach ($cartitems as $item) {
            $images = Product_images::where('product_id', $item->prod_id)->first();
            $productImages[$item->id] = $images;
        }

        return view('frontend.cart', compact('cartitems', 'productImages'));
    }
    public function delete_cart_item(Request $request)
    {
        if (session('userId')) {
            $prod_id = $request->input('prod_id');
            $user_id = session('userId');
            if (Cart::where('prod_id', $prod_id)->where('user_id', $user_id)->exists()) {
                $cartitem = Cart::where('prod_id', $prod_id)->where('user_id', $user_id)->first();
                $cartitem->delete();
                return response()->json(['status' =>  "Product deleted "]);
            } else {
                return response()->json(['status' => "login to continue"]);
            }
        }
    }

    public function updatecart(Request $request)
    {
        if (session('userId')) {
            $prod_id = $request->input('prod_id');
            $product_qty = $request->input('product_qty');
            if (Cart::where('prod_id', $prod_id)->where('user_id', session('userId'))->exists()) {
                $cartqty = Cart::where('prod_id', $prod_id)->where('user_id', session('userId'))->first();
                $cartqty->prod_qty = $product_qty;
                $cartqty->update();
                return response()->json(['status' =>  "Quantity updated"]);
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
        $order->created_by = session('userId');;
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

    public function  myorders()
    {
        $orders = Order::where('user_id', session('userId'))->get();
        return view('frontend.orders.myorder', compact('orders'));
    }

    public function view_my_order($id, $user_id)
    {
        $orderDetails = OrderDetail::with('product')->where('order_id', $id)->get();
        $userDetails =  userRegister::find($user_id);

        return view('frontend.orders.view', compact('orderDetails', 'userDetails'));
    }
}
