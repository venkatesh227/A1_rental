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
        // $products = Product::all();
        $products = Product::orderBy('created_at', 'desc')->get();
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
            'name' => 'required|unique:products',
            'slug' => 'required',
            'description' => 'required',
            'small_description' => 'required',
            'selling_price' => 'required|numeric',
            'qty' => 'required',
            'title' => 'required',
            'additional_info' => 'required',
            'shipping_delivery' => 'required',
            'original_price' => 'required|numeric',
            'original_price' => 'required|numeric|gte:selling_price',
            'image.*' => 'required|mimes:jpg,jpeg,png,gif',
        ], [
            'category_id.required' => 'Category is Required',
            'subcategory_id.required' => 'Subcategory Name is Required',
            'name.required' => 'Product is Required',
            'name.unique' => 'Product is Already Exists',
            'slug.required' => 'Slug is Required',
            'selling_price.required' => 'Original Price is Required',
            'original_price.required' => 'Selling Price is Required',
            'selling_price.numeric' => 'Selling Price Must be a Numeric Value',
            'original_price.numeric' => 'Original Price Must be a Numeric Value',
            'qty.required' => 'Quantity is Required',
            'description.required' => 'Large Description is Required',
            'small_description.required' => 'Small Description is Required',

            'title.required' => 'Title is Required',
            'additional_info.required' => 'Additional Info is Required',
            'shipping_delivery.required' => 'Shipping Delivery is Required',
            'original_price.gte' => 'Original Price must be greater than or equal to Selling Price',
            'image.*.required' => 'Image is required.',
            'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
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
        $Product->selling_price = $request->input('selling_price');
        $Product->original_price = $request->input('original_price');
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
            'name' => 'required|unique:products,name,' . $id,
            'slug' => 'required',
            'small_description' => 'required',
            'description' => 'required',
            'selling_price' => 'required',
            'qty' => 'required',
            'title' => 'required',
            'additional_info' => 'required',
            'shipping_delivery' => 'required',
            'original_price' => 'required',
            'image.*' => 'nullable|mimes:jpg,jpeg,png,gif',
        ], [
            'category_id.required' => 'Category is Required',
            'subcategory_id.required' => 'Subcategory Name is Required',
            'name.required' => 'Product is Required',
            'name.unique' => 'Product is Already Exists',
            'slug.required' => 'Slug is Required',
            'selling_price.required' => 'Selling Price is Required',
            'qty.required' => 'Quantity is Required',
            'original_price.required' => 'Selling Price is Required',
            'image.required' => 'Image is Required',
            'small_description.required' => 'Small Description is Required',
            'description.required' => 'Large Description is Required',
            'title.required' => 'Title is Required',
            'additional_info.required' => 'Additional Info is Required',
            'shipping_delivery.required' => 'Shipping Delivery is Required',
            'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
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
        $Product->updated_at = now();

        $Product->update();
        $images = [];
        $counter = 1;


        $unlinkimages = array();



        if (!empty($request->hasFile('image'))) {

            $productImages = Product_images::where('product_id', $id)->get();

            if ($productImages) {
                foreach ($productImages as $value) {
                    if ($value && isset($value->image)) {
                        $unlinkimages[] = $value->image;
                    }
                }

                foreach ($unlinkimages as $imagePath) {
                    $fullImagePath = public_path('images/products/' . trim($imagePath)); // Trim to remove any whitespace

                    if (file_exists($fullImagePath)) {
                        unlink($fullImagePath); // Delete the file
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

            foreach ($images as $key => $image) {

                $productImage = Product_images::where('product_id', $id)->skip($key)->first();

                if ($productImage) {
                    $productImage->update([
                        'image' => $image,
                        'updated_at' => now(),
                        'updated_by' => session('adminId'),
                    ]);
                }
            }
        }

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
