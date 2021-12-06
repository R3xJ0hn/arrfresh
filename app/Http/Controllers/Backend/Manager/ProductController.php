<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImage;
use App\Models\Wishlist;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
  Public static function HotDealsData()
  { 
    return Product::where('product_status',1)->where('product_status_hotdeals',1)->where('product_discount_price','!=',NULL)->orderBy('updated_at','ASC')->limit(3)->get();
  }

    public function AddProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories','brands'));
    }

  	  public function StoreProduct(Request $request){
        $request->validate(
          [ 'subcategory_id.required'=> 'Category Name Required', ],
          [ 'product_size.required'=> 'Product Size Required', ]
        );

        // Main Thumbnail
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnails/'.$name_gen);
        $save_url = 'upload/products/thumbnails/'.$name_gen;
        
          $product_id = Product::insertGetId([    
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,

            'product_name' => $request->product_name,
            'product_slug' =>  strtolower(str_replace(' ', '-', $request->product_name)),
            
            'product_total_stock' => $request->product_stock,
            'product_available_stock' => $request->product_stock,

            'product_sku' => $request->product_sku,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_colors' => $request->product_colors,
            
            'product_selling_price' =>  (double)$request->product_selling_price,
            'product_discount_price' => ((double)($request->product_discount_price == NULL ? 0 : (double)$request->product_discount_price)),

            'product_location' => $request->product_location,
            'product_expiry_date' => $request->product_expiry_date,
            
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,

            'product_status_new' => $request->product_status_new,
            'product_status_hotdeals' => $request->product_status_hotdeals,
            'product_status_featured' => $request->product_status_featured,
            'product_status_specialdeals' => $request->product_status_specialdeals,

            'product_thumbnail' => $save_url,
            'product_status' => 1,
            'created_at' => Carbon::now(),   
            'updated_at' => Carbon::now(),   
          ]);

          $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
          );

        // Multiple Image
        $images = $request->file('product_multi_img');
        foreach ($images as $img) {
          $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
          Image::make($img)->resize(917,1000)->save('upload/products/multi-images/'.$make_name);
          $uploadPath = 'upload/products/multi-images/'.$make_name;

          MultiImage::insert([
            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(), 
        ]);
        }

		  return redirect()->route('product.add')->with($notification);
    }


    public function ManageProduct(){
      $products = Product::latest()->get();
      return view('backend.product.product_view',compact('products'));
    }

    public function EditProduct($id,$slug){
      $multiImgs =  MultiImage::where('product_id',$id)->get();
      $brands = Brand::latest()->get();
      $categories = Category::latest()->get();
      $subcategory = SubCategory::latest()->get();
      $products = Product::findOrFail($id);
      return view('backend.product.product_edit',compact('categories','brands','subcategory','products','multiImgs'));
    }

    public function ProductDataUpdate(Request $request){

      $request->validate([
        'subcategory_id'=> 'required',
        'product_size'=> 'required',
      ]);

      
      if( $request->product_colors == null){
        $product_color = 'none';
      } else {
        $product_color = $request->product_colors;
      }

      // Product Data
      $product_id = $request->id;

        // Main Thumbnail
        if($request->file('product_thumbnail')){
          $product_id = $request->id; 
          $oldImage = $request->old_mainThumb;
          unlink($oldImage);
  
          $image = $request->file('product_thumbnail');
          $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  
          Image::make($image)->resize(917,1000)->save('upload/products/thumbnails/'.$name_gen);
          $save_url = 'upload/products/thumbnails/'.$name_gen;
            Product::findOrFail($product_id)->update([
              'product_thumbnail' => $save_url,
              'updated_at' => Carbon::now(),
            ]); 
        }

        //Created New Image
        if($request->file('new_multiImg')){
          $imgs = $request->new_multiImg;

          foreach ($imgs as $id => $img) {
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-images/'.$make_name);
            $uploadPath = 'upload/products/multi-images/'.$make_name;

            MultiImage::insert([
              'product_id' => $product_id,
              'photo_name' => $uploadPath,
              'created_at' => Carbon::now(), 
            ]);

          }
        }

        Product::findOrFail($product_id)->update([ 
          'brand_id' => $request->brand_id,
          'category_id' => $request->category_id,
          'subcategory_id' => $request->subcategory_id,

          'product_name' => $request->product_name,
          'product_slug' =>  strtolower(str_replace(' ', '-', $request->product_name)),
          
          'product_total_stock' => $request->product_stock,
          'product_available_stock' => $request->product_stock,

          'product_sku' => $request->product_sku,
          'product_tags' => $request->product_tags,
          'product_size' => $request->product_size,
          'product_colors' =>  $product_color,
          
          'product_selling_price' =>  (double)$request->product_selling_price,
          'product_discount_price' => ((double)($request->product_discount_price == NULL ? 0 : (double)$request->product_discount_price)),

          'product_location' => $request->product_location,
          'product_expiry_date' => $request->product_expiry_date,
          
          'product_short_description' => $request->product_short_description,
          'product_long_description' => $request->product_long_description,

          'product_status_new' => $request->product_status_new,
          'product_status_hotdeals' => $request->product_status_hotdeals,
          'product_status_featured' => $request->product_status_featured,
          'product_status_specialdeals' => $request->product_status_specialdeals,
          
          'product_status' => 1,
          'created_at' => Carbon::now(),   
      ]);

        $notification = array(
        'message' => 'Product Updated Successfully',
        'alert-type' => 'info' );
        return redirect()->route('product.manage')->with($notification);

    } 

    public function MultiImageDelete($id){
      $oldimg = MultiImage::findOrFail($id);
      unlink($oldimg->photo_name);
      MultiImage::findOrFail($id)->delete(); 
      return response()->json(['info' => 'Product Image has been Deleted']);
    } 

    public function ProductInactive($id){
      Product::findOrFail($id)->update(['product_status' => 0]);
      $notification = array(
      'message' => 'Product Inactived',
      'alert-type' => 'success' );
      return redirect()->back()->with($notification);
    }

    public function ProductActive($id){
      Product::findOrFail($id)->update(['product_status' => 1]);
        $notification = array(
      'message' => 'Product Actived',
      'alert-type' => 'success' );
        return redirect()->back()->with($notification);
    }
      
    public function ProductDelete($id){
      $product = Product::findOrFail($id);
      unlink($product->product_thumbnail);
      Product::findOrFail($id)->delete();
      Wishlist::where('product_id',$id)->delete();
      
      $images = MultiImage::where('product_id',$id)->get();
      foreach ($images as $img) {
        unlink($img->photo_name);
        MultiImage::where('product_id',$id)->delete();
      }

      $notification = array(
     'message' => 'Product Deleted Successfully',
     'alert-type' => 'success' );
      return redirect()->back()->with($notification);
    }
    
    public function ProductStock(){
      $products = Product::latest()->get();
      return view('backend.product.product_stock',compact('products'));
    }


}
