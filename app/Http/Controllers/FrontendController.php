<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
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
    public function view_subCategory($id)
    {
        $category  = Category::all();
        if (Subcategory::where('category_id', $id)->exists()) {
            $Subcategory = Subcategory::where('category_id', $id)->get();
            return view('frontend.subCategoryView', compact('Subcategory', 'category'));
        } else {

            return redirect('/')->with('error', 'No subcategories found for this category.');
        }
    }
    public function view_products($sub_id)
    {
        $category  = Category::all();
        if (Product::where('subcategory_id', $sub_id)->exists()) {
            $Product = Product::where('subcategory_id', $sub_id)->where('status', '1')->get();
            return view('frontend.productsView', compact('category', 'Product'));
        } else {

            return redirect('/')->with('error', 'No products found for this category.');
        }
    }
    public function product_details($sub_id, $prod_id)
    {
        $category  = Category::all();
        if (Product::where('subcategory_id', $sub_id)->where('id', $prod_id)->exists()) {
            $Product = Product::where('subcategory_id', $sub_id)->where('id', $prod_id)->where('status', '1')->first();
            return view('frontend.productDetails', compact('category', 'Product'));
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
}
