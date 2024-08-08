<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        return view('admin.subcategory.view', compact('subcategories', 'categories'));
    }

    // 
    public function add_subcategory()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.subcategory.add', compact('categories'));
    }

    public  function insert_subcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|regex:/^[A-Za-z\s]+$/|unique:sub_categories',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ], [
            'category_id.required' => 'Category is Required.',
            'name.required' => 'Subcategory Name is Required.',
            'name.regex' => 'Spaces and Letters Should be Allowed.',
            'name.unique' => 'Subcategory Name Already Exists.',
            'image.required' => 'Image is Required',
            'image.mimes' => 'Only PNG, GIF, and JPG Files are Accepted',
        ]);

        $subcategory = new Subcategory;

        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->created_by = session('adminId');
        $subcategory->created_at = Carbon::now('Asia/Calcutta');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/subcategories'), $filename); // Move the uploaded file to the public/images directory
            $subcategory->image = $filename; // Save the filename to the database
        }


        $subcategory->save();
        return redirect('subcategories')->with('status', "Sub Category Added Successfully");
    }



    public function edit_subcategory($id)
    {
        $subcategory = Subcategory::find($id);
        $categories = Category::orderBy('name', 'asc')->get(); // Assuming you have a Category model

        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function upadate_subcategory(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|regex:/^[A-Za-z\s]+$/|unique:sub_categories,name,' . $id,
            'image' => 'nullable|mimes:jpeg,jpg,png,gif',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Subcategory name is required.',
            'name.regex' => 'Spaces and Letters should be Allowed.',
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
                'image' => 'required|mimes:jpeg,jpg,png,gif',
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
        $subcategory->updated_at = Carbon::now('Asia/Calcutta');
        $subcategory->update();
        return redirect('subcategories')->with('status', "Sub Category Updated Successfully");
    }




    public function subcategory_status($subcategory_id, $currentStatus)
    {
        $subcategory_status = Subcategory::find($subcategory_id);
        $subcategory_status->status = $currentStatus;
        $subcategory_status->update();

        $updatesubCategory = Subcategory::find($subcategory_id);

        return response()->json(['status' => 'success', 'user' => $updatesubCategory]);
    }
}
