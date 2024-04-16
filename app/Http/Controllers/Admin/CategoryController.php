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
    }
    public function add_category()
    {
        return view('admin.category.add');
    }
    public  function insert_category(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ], [
            'name.required' => 'Category name is required.',
            'name.unique' => 'Category name already exists',
        ]);


        $category = new Category;
        $category->name = $request->input('name');
        $category->created_by = session('userId');
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
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->updated_by = session('userId');
        $category->updated_at = now();
        $category->update();
        return redirect('categories')->with('status', "Category Updated Successfully");
    }
}
