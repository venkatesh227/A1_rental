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
            'name' => 'required|unique:sub_categories|regex:/^[\pL\s]+$/u|min:3',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Subcategory name is required.',
            'name.unique' => 'Subcategory name already exists.',
            'regex' => 'Allow Alphabets and Spaces Only'
        ]);

        $subcategory = new Subcategory;

        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->created_by = session('userId');
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
        $subcategory = Subcategory::find($id);
        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('name');
        $subcategory->updated_by = session('userId');
        $subcategory->updated_at = now();
        $subcategory->update();
        return redirect('subcategories')->with('status', "SubCategory Updated Successfully");
    }


    

    // public function add()
    // {
    //     return view('admin.products.add');
    // }


}
