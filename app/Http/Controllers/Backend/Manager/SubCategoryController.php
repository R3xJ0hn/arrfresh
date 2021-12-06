<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        $subCategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_view',compact('subCategory','categories'));
    }

    public function SubCategoryAdd(Request $request)
    {
        $request->validate([
            'category_id'=> 'required',
            'subcategory_name'=> 'required',
        ],[
            'category_id.required'=> 'Please select specific category',
            'subcategory_name.required'=> 'Sub Category Name Required',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
        ]);

        $notification = array(
            'message' => "Successfully Created New Sub Category", 
            'alert-type' => 'success'
        );
           return redirect()->back()->with($notification);
    }

    public function SubCategoryUpdate(Request $request)
    {
        SubCategory::findOrFail($request->id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),
        ]);

        $notification = array(
            'message' => "Updated Sub Category Successfully", 
            'alert-type' => 'success'
        );
           return redirect()->route('sub.categories')->with($notification);
    }

    public function SubCategoryDelete($id)
    {
        SubCategory::findOrfail($id)->delete();

        $notification = array(
            'message' => "Deleted Sub Category Successfully", 
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }
}
