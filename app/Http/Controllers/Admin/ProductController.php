<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Product_images;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $product_images = Product_images::all();
        // dd($products[0]->Product_images);
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
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'small_description' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'title' => 'required',
            'additional_info' => 'required',
            'shipping_delivery' => 'required',
            // 'image.*' => 'required|mimes:jpeg,png,gif',
        ], [
            'category_id.required' => 'Category is Required',
            'subcategory_id.required' => 'Subcategory Name is Required',
            'name.required' => 'Product is Required',
            'name.unique' => 'Product is Already Exists',
            'slug.required' => 'Slug is Required',
            'price.required' => 'Price is Required',
            'qty.required' => 'Quantity is Required',
            'description.required' => 'Large Description is Required',
            'small_description.required' => 'Small Description is Required',

            'title.required' => 'Title is Required',
            'additional_info.required' => 'Additional Info is Required',
            'shipping_delivery.required' => 'Shipping Delivery is Required',
            // 'image.*.required' => 'Image is required.',
            // 'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
        ]);


        $Product = new Product;
        $Product->subcategory_id = $request->input('subcategory_id');
        $Product->name = $request->input('name');
        $Product->slug = $request->input('slug');

        $Product->title = $request->input('title');

        $Product->additional_info = $request->input('additional_info');
        $Product->shipping_delivery = $request->input('shipping_delivery');

        $Product->small_description = $request->input('small_description');
        $Product->description = $request->input('description');
        $Product->price = $request->input('price');
        $Product->qty = $request->input('qty');
        $Product->status = $request->input('status') == true ? '1' : '0'; // Use lowercase true
        $Product->created_by = session('adminId');
        $Product->save();
        $insertedId = $Product->id;


        $images = array();
        $counter = 1;
        if ($request->hasFile('image')) {
            if ($files = $request->file('image')) {
                
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'image_' . $counter . '.' . $extension;
                    
                    // Check if the filename already exists, if so, increment the counter
                    while (file_exists(public_path('images/products/' . $filename))) {
                        $counter++;
                        $filename = 'image_' . $counter . '.' . $extension;
                    }

                    $file->move(public_path('images/products'), $filename);
                    $images[] = $filename; // Store the filename in the array
                    $counter++; // Increment the counter for the next file
                }
            }
        }

        /*Insert your data*/
        $imageData = [];
        foreach ($images as $image) {
            $imageData[] = [
                'product_id' => $insertedId,
                'image' => $image,
                'created_at' => now(),
                'created_by' => session('adminId'),
            ];
        }
        
    
        Product_images::insert($imageData);

        return redirect('products')->with('status', "Added Product Successfully");
    }




    public function edit_product($id)
    {
        $Products = Product::find($id);
        // dd($Products->subcategory->category_id);   
        $subcategories = Subcategory::all();
        // dd($subcategory[0]->category_id);  
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
            'price' => 'required',
            'qty' => 'required',
            'title' => 'required',
            'additional_info' => 'required',
            'shipping_delivery' => 'required',
            // 'image' => 'nullable|mimes:jpeg,png,gif', // Updated to allow nullable
        ], [
            'category_id.required' => 'Category is Required',
            'subcategory_id.required' => 'Subcategory Name is Required',
            'name.required' => 'Product is Required',
            'name.unique' => 'Product is Already Exists',
            'slug.required' => 'Slug is Required',
            'price.required' => 'Price is Required',
            'qty.required' => 'Quantity is Required',

            'image.required' => 'Image is Required',
            'small_description.required' => 'Small Description is Required',
            'title.required' => 'Title is Required',
            'additional_info.required' => 'Additional Info is Required',
            'shipping_delivery.required' => 'Shipping Delivery is Required',
            // 'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
        ]);


        $Product = Product::find($id);
        $Product->subcategory->category->category_id = $request->input('category_id');

        $Product->subcategory_id = $request->input('subcategory_id');

        $Product->name = $request->input('name');

        $Product->slug = $request->input('slug');


        $Product->title = $request->input('title');

        $Product->additional_info = $request->input('additional_info');
        $Product->shipping_delivery = $request->input('shipping_delivery');


        $Product->small_description = $request->input('small_description');
        $Product->description = $request->input('description');
        $Product->price = $request->input('price');
        $Product->status = $request->input('status') == true ? '1' : '0'; // Use lowercase true

        $Product->updated_by = session('userId');
        $Product->updated_at = now();
        $oldImages = $Product->images;
        $Product->update();

        $images = [];
        $counter = 1;
        if ($request->hasFile('image')) {
            if (!empty($oldImages)) {
                $oldImagePaths = explode(",", $oldImages);
                foreach ($oldImagePaths as $oldImagePath) {
                    $oldImagePath = public_path('images/products/' . $oldImagePath);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

            if ($files = $request->file('image')) {

                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'image_' . $counter . '.' . $extension;

                    // Check if the filename already exists, if so, increment the counter
                    while (file_exists(public_path('images/products/' . $filename))) {
                        $counter++;
                        $filename = 'image_' . $counter . '.' . $extension;
                    }

                    $file->move(public_path('images/products'), $filename);
                    $images[] = $filename; // Store the filename in the array
                    $counter++; // Increment the counter for the next file
                }
            }
        }

        foreach ($images as $image) {
            Product_images::where('product_id', $id)
                ->update([
                    'image' => $image,
                    'updated_at' => now(),
                    'updated_by' => session('adminId'),
                ]);
        }

        return redirect('products')->with('status', "Product Updated Successfully");
    }
}
