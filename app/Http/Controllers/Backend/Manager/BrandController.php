<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;


class BrandController extends Controller
{
    public static function GetAllBrands(){
        return Brand::latest()->get();
    }

    public function BrandView()
    {
        $brands = self::GetAllBrands();
        return view('backend.brand.brand_view',compact('brands',));
    }

    public function BrandAdd(Request $request)
    {
        $request->validate([
            'brand_image_path'=> 'required',
            'brand_name'=> 'required',
        ]);

        $image = $request->file('brand_image_path');
        $name_gen = hexdec(uniqid()). "." .$image->getClientOriginalExtension();
        Image::make($image)->resize(166,110)->save('upload/brand/'.$name_gen);
        $save_url =$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image_path' =>  $save_url,
            'brand_slug' => strtolower(str_replace(' ','-',$request->brand_name)),
        ]);

        $notification = array(
            'message' => "Added Brand Successfully", 
            'alert-type' => 'success'
        );
           return redirect()->back()->with($notification);
    }

    public function BrandUpdate(Request $request)
    {
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if($request->file('brand_image_path')){

            $image = $request->file('brand_image_path');
            $name_gen = hexdec(uniqid()). "." .$image->getClientOriginalExtension();
            unlink('upload/brand/'.$old_img);
            Image::make($image)->resize(166,110)->save('upload/brand/'.$name_gen);
            $save_url =$name_gen;
    
    
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_image_path' =>  $save_url,
                'brand_slug' => strtolower(str_replace(' ','-',$request->brand_name)),
            ]);
    
            $notification = array(
                'message' => "Updated Brand Successfully", 
                'alert-type' => 'success'
            );
               return redirect()->route('brands')->with($notification);
        }else{

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ','-',$request->brand_name)),
            ]);
    
            $notification = array(
                'message' => "Updated Brand Successfully", 
                'alert-type' => 'success'
            );
               return redirect()->route('brands')->with($notification);
        }
    }// end brandUpdate


    public function BrandDelete($id)
    {
        $brand = Brand::findOrfail($id);
        $img = $brand->brand_image_path;
        unlink('upload/brand/'.$img);

        Brand::findOrfail($id)->delete();

        $notification = array(
            'message' => "Deleted Brand Successfully", 
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }


}
