<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImage; 
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();

        $new_arrival_products = Product::inRandomOrder()->where('product_available_stock','>',0)->where('product_status',1)->where('product_status_new',1)->orderBy('updated_at','ASC')->limit(6)->get();

        $featured_products = Product::inRandomOrder()->where('product_status',1)->where('product_status_featured',1)->orderBy('updated_at','ASC')->limit(6)->get();

        $new_products = Product::inRandomOrder()->where('product_status',1)->where('product_status_new',1)->orderBy('updated_at','ASC')->limit(6)->get();

    	$special_deals =  Product::inRandomOrder()->where('product_status',1)->where('product_status_specialdeals',1)->orderBy('updated_at','ASC')->limit(3)->get();
        $best_seller = Product::inRandomOrder()->where('product_status',1)->where('product_status_specialdeals',1)->orderBy('product_purchased_cnt','ASC')->limit(6)->get();

        $skip_category = Category::inRandomOrder()->first();
    	$skip_category_products =  Product::inRandomOrder()->where('product_status',1)->where('category_id',$skip_category->id)->orderBy('id','DESC')->get();

        return view('frontend.index', compact('categories','subcategories','sliders','new_products','featured_products','new_arrival_products','special_deals', 'skip_category','skip_category_products','best_seller'));
    }

	public function ProductDetails($id,$slug){
		$product = Product::findOrFail($id);

		$colors = $product->product_colors;
		$product_color = explode(',', $colors);

		$multiImag = MultiImage::where('product_id',$id)->get(); 

		$cat_id = $product->category_id;
        $product_cat_name = Category::select('category_name')->where('id',$cat_id)->first()->category_name;

		$relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();
	 	return view('frontend.product.product_details',compact('product','multiImag','product_cat_name','product_color','relatedProduct'));

	}

      //Add To Cart Ajax Product
     public function GetModalAddToCartProductData($id){
        $product = Product::findOrFail($id);

        $colors = $product->product_colors;
		$product_color = explode(',', $colors);

        $data = [
           'product_id'=> $product->id,
           'product_thumbnail'=> $product->product_thumbnail,
           'product_name'=> $product->product_name,
           'product_brand'=> $product->Brand->brand_name,
           'product_category'=> $product->Category->category_name,
           'product_size'=> $product->product_size,
           'product_stock'=> $product->product_available_stock,
           'product_selling_price'=> $product->product_selling_price,
           'product_discount_price'=> $product->product_discount_price,
           'product_colors'=> $product_color,
        ];
    
        return $data;
     }

    public function UserLogout()
    {
        Auth::logout();
        return Redirect()->route('login');
    }

    public function UserProfile()
    {
        $id= Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

    public function UserProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename = date('YmdHi'). "." .$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename; 
        }
        
        $data->save();
        $notification = array(
            'message' => "Profile Updated Successfully", 
            'alert-type' => 'success'
        );

        return redirect()-> route('home')->with($notification);
    }

    public function UserChangePassword()
    {
        $id= Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_change_password',compact('user'));
    }

    public function UserChangePasswordStore(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else{
            return redirect()->back();
        }
    }

    //Product Seach 
	public function ProductSearch(Request $request){
		$request->validate(["search" => "required"]);
		$item = $request->search;
        $categories = Category::orderBy('category_name','ASC')->get();
		$products = Product::where('product_name','LIKE',"%$item%")->get();
		return view('frontend.product.search',compact('products','categories'));
	} // end method 

    public function GetProductsBySubCategory($subcategory){
        $categories = Category::orderBy('category_name','ASC')->get();
		$products = Product::where('subcategory_id',$subcategory)->get();
		return view('frontend.product.search',compact('products','categories'));
    }
    
    public function AdvanceSearch(Request $request){
        $subcategory = $request->subcategory;
        $min = $request->range_min;
        $max = $request->range_max;
        $categories = Category::orderBy('category_name','ASC')->get();
		$products = $this->GetRangePriceProducts($min, $max, $subcategory);
		return view('frontend.product.search',compact('products','categories'));
    }

    private function GetRangePriceProducts($min, $max, $subcategory)
    {
        if($subcategory){
            if($min != 0 and $max != 0){
                return Product::where('product_selling_price','>', $min)->where('product_selling_price','<', $max)->where('subcategory_id',$subcategory)->get();
            }
    
            if($min != 0 and $max == 0){
                return Product::where('product_selling_price','>', $min)->where('subcategory_id',$subcategory)->get();
            }
    
            if($min == 0 and $max != 0){
                return Product::where('product_selling_price','<', $max)->where('subcategory_id',$subcategory)->get();
            }
    
            if($min == 0 and $max == 0){
                return Product::where('subcategory_id',$subcategory)->get();
            }

        }else{

            if($min != 0 and $max != 0){
                return Product::where('product_selling_price','>', $min)->where('product_selling_price','<', $max)->get();
            }
    
            if($min != 0 and $max == 0){
                return Product::where('product_selling_price','>', $min)->get();
            }
    
            if($min == 0 and $max != 0){
                return Product::where('product_selling_price','<', $max)->get();
            }
    
            if($min == 0 and $max == 0){
                return Product::get();
            }
        }
    }




}
