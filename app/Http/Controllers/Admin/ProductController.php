<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Product_images;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $product_images = Product_images::all();
        return view('admin.products.view', compact('products', 'product_images'));
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
        $response = [];
        foreach ($subcategories as $subcategory) {
            $response[] = [
                'id' => $subcategory->id,
                'name' => $subcategory->name,
            ];
        }
        return response()->json(['subcategories' => $response]);
    }

    public function insert_product(Request $request)
    {
        // Validate request data
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'small_description' => 'required',
            'selling_price' => 'required|numeric',
            'original_price' => 'required|numeric|gte:selling_price',
            'qty' => 'required',
            'title' => 'required',
            'additional_info' => 'required',
            'shipping_delivery' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ], [
            'category_id.required' => 'Category is Required',
            'subcategory_id.required' => 'Subcategory Name is Required',
            'name.required' => 'Product is Required',
            'name.unique' => 'Product is Already Exists',
            'slug.required' => 'Slug is Required',
            'selling_price.required' => 'Original Price is Required',
            'original_price.required' => 'Selling Price is Required',
            'original_price.gte' => 'Original Price must be greater than or equal to Selling Price',
            'selling_price.numeric' => 'Selling Price Must be a Numeric Value',
            'original_price.numeric' => 'Original Price Must be a Numeric Value',
            'qty.required' => 'Quantity is Required',
            'description.required' => 'Large Description is Required',
            'small_description.required' => 'Small Description is Required',
            'title.required' => 'Title is Required',
            'additional_info.required' => 'Additional Info is Required',
            'shipping_delivery.required' => 'Shipping Delivery is Required',
            'image.required' => 'Image is Required',
            'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
        ]);

        // Create a new Product instance
        $Product = new Product;
        $Product->subcategory_id = $request->input('subcategory_id');
        $Product->name = $request->input('name');
        $Product->slug = $request->input('slug');
        $Product->title = $request->input('title');
        $Product->additional_info = $request->input('additional_info');
        $Product->shipping_delivery = $request->input('shipping_delivery');
        $Product->small_description = $request->input('small_description');
        $Product->description = $request->input('description');
        $Product->selling_price = $request->input('selling_price');
        $Product->original_price = $request->input('original_price');
        $Product->qty = $request->input('qty');
        $Product->created_by = session('adminId');

        // Handle the single image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/products/'), $filename); // Move the uploaded file to the public/images directory
            $Product->image = $filename; // Save the filename to the database
        }
        $Product->save();
        return redirect('products')->with('status', "Added Product Successfully");
    }

    public function viewProductImages($product_id)
    {
        $product_images = Product_images::where('product_id', $product_id)->get();

        return view('admin.products.product_view_images', compact('product_images', 'product_id'));
    }


    public function addProductImages(Request $request, $id)
    {
        $request->validate(
            [
                'image' => 'required',
            ],
            [
                'image.required' => 'Image is Required',
            ]
        );
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $extension = $file->getClientOriginalExtension();
                $uniqueId = uniqid();
                $filename = $uniqueId . '.' . $extension;
                $file->move(public_path('images/product_images'), $filename);
                $productImage = new Product_images();
                $productImage->product_id = $id;
                $productImage->image = $filename;
                $productImage->created_by = session('adminId');
                $productImage->created_at = Carbon::now('Asia/Calcutta');
                $productImage->save();
            }
        }

        return redirect('viewProductImages/' . $id)->with('status', "Images Added Successfully");
    }

    public function editProductImage($product_id)
    {
        $product_images = Product_images::where('product_id', $product_id)->get();
        return view('admin.products.product_edit_images', compact('product_images', 'product_id'));
    }
    public function update_product_images(Request $request, $product_id)
    {
        $productImage = Product_images::find($product_id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $uniqueId = uniqid();
            $filename = $uniqueId . '.' . $extension;
            $file->move(public_path('images/product_images'), $filename);
            $productImage->image = $filename;
            $productImage->updated_by = session('adminId');
            $productImage->updated_at = Carbon::now('Asia/Calcutta');
            $productImage->update();
        }
        return redirect('viewProductImages/' . $productImage->product_id)->with('status', "Images Updated Successfully");
    }



    public function edit_product($id)
    {
        $Products = Product::find($id);
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('Products', 'subcategories', 'categories'));
    }



    public function update_products(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'small_description' => 'required',
            'description' => 'required',
            'selling_price' => 'required',
            'qty' => 'required',
            'title' => 'required',
            'additional_info' => 'required',
            'shipping_delivery' => 'required',
            'original_price' => 'required|numeric|gte:selling_price',
            'image' => ['image', 'mimes:jpeg,jpg,png,gif'],
        ], [
            'category_id.required' => 'Category is Required',
            'subcategory_id.required' => 'Subcategory Name is Required',
            'name.required' => 'Product is Required',
            'name.unique' => 'Product is Already Exists',
            'slug.required' => 'Slug is Required',
            'selling_price.required' => 'Selling Price is Required',
            'qty.required' => 'Quantity is Required',
            'original_price.required' => 'Original Price is Required',
            'original_price.gte' => 'Original Price must be greater than or equal to Selling Price',
            'image.required' => 'Image is Required',
            'small_description.required' => 'Small Description is Required',
            'description.required' => 'Large Description is Required',
            'title.required' => 'Title is Required',
            'additional_info.required' => 'Additional Info is Required',
            'shipping_delivery.required' => 'Shipping Delivery is Required',
            'image.image' => 'Only PNG, GIF, and JPG files are accepted',
        ]);

        $Product = Product::find($id);
        $Product->subcategory->category->category_id = $request->input('category_id');
        $Product->subcategory_id = $request->input('subcategory_id');
        $Product->name = $request->input('name');
        $Product->slug = $request->input('slug');
        $Product->original_price = $request->input('original_price');
        $Product->title = $request->input('title');
        $Product->additional_info = $request->input('additional_info');
        $Product->shipping_delivery = $request->input('shipping_delivery');
        $Product->small_description = $request->input('small_description');
        $Product->description = $request->input('description');
        $Product->selling_price = $request->input('selling_price');
        $Product->status = $request->input('status') == true ? '1' : '0'; // Use lowercase true
        $Product->updated_by = session('userId');
        $Product->updated_at = Carbon::now('Asia/Calcutta');
        $Product->update();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $uniqueId = uniqid();
            $filename = $uniqueId . '.' . $extension;
            $file->move(public_path('images/products'), $filename);
            $Product->image = $filename;
            $Product->updated_by = session('adminId');
            $Product->updated_at = Carbon::now('Asia/Calcutta');
        }
        $Product->update();

        return redirect('products')->with('status', "Product Updated Successfully");
    }


    public function product_status($product_id, $currentStatus)
    {
        $product_status = Product::find($product_id);
        $product_status->status = $currentStatus;
        $product_status->update();

        $product = Product::find($product_id);
        return response()->json(['status' => 'success', 'user' => $product]);
    }
}
