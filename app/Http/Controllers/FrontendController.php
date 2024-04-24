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
use Illuminate\Support\Facades\Auth;

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
    // public function view_subCategory($id)
    // {

    //     $category  = Category::all();
    //     $category_name  = Category::find($id);
    //     if (Subcategory::where('category_id', $id)->exists()) {
    //         // $Subcategory = Subcategory::where('category_id', $id)->get();
    //         $Subcategory = Subcategory::where('category_id', $id)->paginate(8);
    //         return view('frontend.subCategoryView', compact('Subcategory', 'category', 'category_name'));
    //     } else {

    //         //  return view('frontend.subCategoryView');
    //         return redirect('/')->with('error', 'No subcategories found for this category.');
    //     }
    // }

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





    // public function view_products($sub_id)
    // {
    //     $category  = Category::all();
    //     if (Product::where('subcategory_id', $sub_id)->exists()) {
    //         $Product = Product::where('subcategory_id', $sub_id)->where('status', '1')->get();
    //         foreach ($Product as $item) {
    //             $productImage = Product_images::where('product_id', $item->id)->first();
    //         }
    //         return view('frontend.productsView', compact('category', 'Product', 'productImage'));
    //     } else {
    //         return redirect('/')->with('error', 'No products found for this category.');
    //     }
    // }



    public function view_products($sub_id)
    {
        $category  = Category::all();
        if (Product::where('subcategory_id', $sub_id)->where('status', '1')->exists()) {

            $Product = Product::where('subcategory_id', $sub_id)->where('status', '1')->get();
            foreach ($Product as $item) {
                $productImage = Product_images::where('product_id', $item->id)->first();
            }

            return view('frontend.productsView', compact('category', 'Product', 'productImage'));
        } else {
            // return redirect('/')->with('error', 'No products found for this category.');
            return view('frontend.productsView', compact('category'));
        }
    }

    public function product_details($sub_id, $prod_id)
    {
        $category  = Category::all();
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
                return response()->json(['status' =>  "Added To Cart"]);
            }
        } else {
            return response()->json(['status' => "login to continue"]);
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
                return response()->json(['status' =>  "Product deleted successfully"]);
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
                'subtotal' => $item->products->price * $item->prod_qty,
                'single_price' => $item->products->price,
                'created_by' => session('userId'),

            ]);
            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }
        $cartitems = Cart::where('user_id', session('userId'))->get();
        Cart::destroy($cartitems);

        return redirect('/')->with('status', 'order placed successfully');
    }
}
