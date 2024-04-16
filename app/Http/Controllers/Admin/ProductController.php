<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // dd($products[0]->category->name);
        return view('admin.products.view', compact('products'));
    }


    public function add_product()
    {
        $subcategories = Subcategory::all();
        $categories = Category::all();
        $products = Product::all();
        return view('admin.products.add', compact('subcategories', 'categories', 'products'));
    }


    public function fetchSubcategories(Request $request)
    {

        $category_id = $request->input('category_id');

        $subcategories = Subcategory::where('category_id', $category_id)->get();

        // Prepare the response data
        $response = [];
        foreach ($subcategories as $subcategory) {
            $response[] = [
                'id' => $subcategory->id,
                'name' => $subcategory->name,
            ];
        }

        // Return the response as JSON
        return response()->json(['subcategories' => $response]);
    }

    public function insert_product(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'slug' => 'required',
            'small_description' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'status' => 'required',
            'image' => 'required',
        ], [
            'category_id.required' => 'Category is Required',
            'subcategory_id.required' => 'Subcategory Name is Required',
            'name.required' => 'Product is Required',
            'name.unique' => 'Product is Already Exists',
            'slug.required' => 'Slug is Required',
            'price.required' => 'Price is Required',
            'qty.required' => 'Quantity is Required',
            'status.required' => 'Status is Required',
            'image.required' => 'Image is Required',
            'small_description.required' => 'Small Description is Required',
            'regex' => 'Allow Alphabets and Spaces Only'
        ]);


        $subcategory = new Product;

        $subcategory->category_id = $request->input('category_id');
        $subcategory->subcategory_id = $request->input('subcategory_id');
        $subcategory->name = $request->input('name');

        $subcategory->slug = $request->input('slug');
        $subcategory->small_description = $request->input('small_description');
        $subcategory->description = $request->input('description');
        $subcategory->price = $request->input('price');
        $subcategory->qty = $request->input('qty');
        $subcategory->status = $request->input('status');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename); // Move the uploaded file to the public/images directory
            $subcategory->image = $filename; // Save the filename to the database
        }


        $subcategory->created_by = session('userId');
        $subcategory->save();
        return redirect('add-product')->with('status', "Added Product Successfully");
    }

    public function edit_product($id)
    {
        $Product = Product::find($id);
        //  dd($Product->image);
        $subcategory = Subcategory::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('Product', 'subcategory', 'categories'));
    }
}
