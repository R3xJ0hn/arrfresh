<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Image;

class PageInfoController extends Controller
{

    public static function GetSettingInfo(){
    return SiteSetting::find(1);
    }

    public function SiteSetting(){
    	$setting = self::GetSettingInfo();
    	return view('backend.pageinfo.setting_update',compact('setting'));
    }

   public function SiteSettingUpdate(Request $request){
    	
    	$setting_id = $request->id;
        $setting = self::GetSettingInfo();

        SiteSetting::findOrFail($request->id)->update([
            'phone_one' => $request->phone_one,
            'phone_two' => $request->phone_two,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
        ]);

    	if ($request->file('logo')) {

            if(!empty($setting->logo)){
                $old_img = $request->old_logo;
                unlink($old_img);
            }

            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(139,36)->save('upload/logo/'.$name_gen);
            $save_url = 'upload/logo/'.$name_gen;
            SiteSetting::findOrFail($setting_id)->update([
            'logo' => $save_url,
            ]);
    	}
        
    	if ($request->file('banner1')) {

            if(!empty($setting->banner1)){
                $old_img = $request->old_banner1;
                unlink($old_img);
            }

            $image = $request->file('banner1');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(848,201)->save('upload/banners/'.$name_gen);
            $save_url = 'upload/banners/'.$name_gen;
            SiteSetting::findOrFail($setting_id)->update([
            'banner1' => $save_url,
            ]);
    	}

                
    	if ($request->file('banner2')) {
    
            if(!empty($setting->banner2)){
                $old_img = $request->old_banner2;
                unlink($old_img);
            }

            $image = $request->file('banner2');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(848,201)->save('upload/banners/'.$name_gen);
            $save_url = 'upload/banners/'.$name_gen;

            SiteSetting::findOrFail($setting_id)->update([
            'banner2' => $save_url,
            ]);
    	}
                
    	if ($request->file('banner3')) {
               
            if(!empty($setting->banner3)){
                $old_img = $request->old_banner3;
                unlink($old_img);
            }

            $image = $request->file('banner3');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(848,201)->save('upload/banners/'.$name_gen);
            $save_url = 'upload/banners/'.$name_gen;

            SiteSetting::findOrFail($setting_id)->update([
            'banner3' => $save_url,
            ]);
    	}

        $notification = array(
            'message' => 'Setting Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method 


}
