<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function CategoryView()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_view',compact('category'));
    }

    public function CategoryAdd(Request $request)
    {
        $request->validate([
            'category_name'=> 'required',
        ],[
            'category_name.required'=> 'Category Name Required',
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
        ]);

        $notification = array(
            'message' => "Successfully Created New Category", 
            'alert-type' => 'success'
        );
           return redirect()->back()->with($notification);
    }

    public function CategoryUpdate(Request $request)
    {
        Category::findOrFail($request->id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
        ]);

        $notification = array(
            'message' => "Updated category Successfully", 
            'alert-type' => 'success'
        );
           return redirect()->route('categories')->with($notification);
    }

    public function CategoryDelete($id)
    {
        Category::findOrfail($id)->delete();

        SubCategory::where('category_id',$id)->delete();

        $notification = array(
            'message' => "Deleted Brand Successfully", 
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
