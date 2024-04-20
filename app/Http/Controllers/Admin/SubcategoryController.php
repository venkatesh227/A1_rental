<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view('admin.subcategory.view', compact('subcategories', 'categories'));
    }

    // 
    public function add_subcategory()
    {
        $categories = Category::all();

        return view('admin.subcategory.add', compact('categories'));
    }


    
    public  function insert_subcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:sub_categories',
            'image' => 'required|mimes:jpeg,png,gif',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Subcategory name is required.',
            'name.unique' => 'Subcategory name already exists.',
            'image.required' => 'Image is Required',
            'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
        ]);

        $subcategory = new Subcategory;

        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->created_by = session('userId');


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/subcategories'), $filename); // Move the uploaded file to the public/images directory
            $subcategory->image = $filename; // Save the filename to the database
        }


        $subcategory->save();
        return redirect('subcategories')->with('status', "subcategories Added Successfully");
    }



    public function edit_subcategory($id)
    {
        $subcategory = Subcategory::find($id);
        $categories = Category::all(); // Assuming you have a Category model

        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }


    // 


    public function upadate_subcategory(Request $request, $id)
    {  

        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:sub_categories,name,'.$id,
            'image' => 'required|mimes:jpeg,png,gif',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Subcategory name is required.',
            'name.unique' => 'Subcategory name already exists.',
            'image.required' => 'Image is Required',
            'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
        ]);


        $subcategory = Subcategory::find($id);
        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->updated_by = session('userId');


        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:jpeg,png,gif',
            ], [
                'image.required' => 'Image is Required',
                'image.mimes' => 'Only JPG, PNG, and GIF Images are Allowed',
            ]);
        
            // Delete old image if it exists
            if ($subcategory->image && file_exists(public_path('images/subcategories/' . $subcategory->image))) {
                unlink(public_path('images/subcategories/' . $subcategory->image));
            }
        
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Make sure the 'subcategories' folder exists inside the 'images' folder
            $image->move(public_path('images/subcategories/'), $filename);
            $subcategory->image = $filename;
        }
        


        $subcategory->updated_at = now();
        $subcategory->update();
        return redirect('subcategories')->with('status', "SubCategory Updated Successfully");
    }


    

    // public function add()
    // {
    //     return view('admin.products.add');
    // }


}
