<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.view', compact('category'));
        return view('index', compact('category'));
    }
    
    public function add_category()
    {
        return view('admin.category.add');
    }
    public  function insert_category(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|regex:/^[A-Za-z\s]+$/',
            'image' => 'required|mimes:jpeg,png,gif',
        ], [
            'name.required' => 'Category Name is Required.',
            'name.unique' => 'Category Name Already Exists',
            'name.regex' => 'Spaces and Letters should be Allowed.',
            'image.required' => 'Image is Required',
            'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',

        ]);



        $category = new Category;
        $category->name = $request->input('name');
        $category->image = $request->input('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $filename); // Move the uploaded file to the public/images directory
            $category->image = $filename; // Save the filename to the database
        }

        $category->created_by = session('adminId');
        $category->save();
        return redirect('categories')->with('status', "Category Added Successfully");
    }
    public function edit_category($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function upadate_category(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'image' => 'nullable|mimes:jpeg,png,gif',
        ], [
            'name.required' => 'Category Name is Required',
            'name.unique' => 'Category Name Already Exists',
            'image.required' => 'Image is Required',
            'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
        ]);


        $category = Category::find($id);
        $category->name = $request->input('name');


        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:jpeg,png,gif',
            ], [
                'image.required' => 'Image is Required',
                'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
            ]);

            // Delete old image if it exists
            if ($category->image && file_exists(public_path('images/categories/' . $category->image))) {
                unlink(public_path('images/categories/' . $category->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Make sure the 'subcategories' folder exists inside the 'images' folder
            $image->move(public_path('images/categories/'), $filename);
            $category->image = $filename;
        }


        $category->updated_by = session('userId');
        $category->updated_at = now();
        $category->update();
        return redirect('categories')->with('status', "Category Updated Successfully");
    }

    public function category_status($category_id, $currentStatus)
    {
        $category_status = Category::find($category_id);
        $category_status->status = $currentStatus;

        $category_status->update();

        $updateCategory = Category::find($category_id);

        return response()->json(['status' => 'success', 'user' => $updateCategory]);
    }
}
