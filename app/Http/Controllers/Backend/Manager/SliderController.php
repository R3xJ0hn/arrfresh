<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{
    public function SliderView(){
		$sliders = Slider::latest()->get();
		return view('backend.slider.slider_view',compact('sliders'));
	}

    public function SliderAdd(Request $request){

    	$request->validate([
    		'slider_img' => 'required',
    	],[
    		'slider_img.required' => 'Please Select One Image',
    	]);

    	$image = $request->file('slider_img');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
    	$save_url = 'upload/slider/'.$name_gen;

	    Slider::insert([
		'title' => $request->slide_title,
		'description' => $request->slide_description,
		'slider_img' => $save_url,
    	]);

	    $notification = array(
			'message' => 'Slider Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 
    
    public function SliderUpdate(Request $request)
    {
        $slider_id = $request->id;
        $old_img = $request->old_image;

        if($request->file('slider_img')){

            $image = $request->file('slider_img');
            $name_gen = hexdec(uniqid()). "." .$image->getClientOriginalExtension();
            unlink($old_img);
            Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
            $save_url = 'upload/slider/'.$name_gen;
    
            Slider::findOrFail($slider_id)->update([
                'title' => $request->slide_title,
		        'description' => $request->slide_description,
                'slider_img' =>  $save_url,
            ]);
    
            $notification = array(
                'message' => "Updated slider Successfully", 
                'alert-type' => 'success'
            );
               return redirect()->route('sliders')->with($notification);
        }else{

            Slider::findOrFail($slider_id)->update([
                'title' => $request->slide_title,
                'description' => $request->slide_description,
            ]);
    
            $notification = array(
                'message' => "Updated slider Successfully", 
                'alert-type' => 'success'
            );
               return redirect()->route('sliders')->with($notification);
        }
    }// end sliderUpdate
    
    public function SliderDelete($id)
    {
        $slide = Slider::findOrfail($id);
        $img = $slide->slider_img;
        unlink($img);

        Slider::findOrfail($id)->delete();

        $notification = array(
            'message' => "Deleted slide Successfully", 
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    public function SliderInactive($id){
    	Slider::findOrFail($id)->update(['status' => 0]);

    	$notification = array(
			'message' => 'Slider Inactive Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 

    public function SliderActive($id){
    	Slider::findOrFail($id)->update(['status' => 1]);

    	$notification = array(
			'message' => 'Slider Active Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 

}
