<?php

Use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\Manager\DashboardController;
use App\Http\Controllers\Backend\Manager\BrandController;
use App\Http\Controllers\Backend\Manager\CategoryController;
use App\Http\Controllers\Backend\Manager\SubCategoryController;
use App\Http\Controllers\Backend\Manager\ProductController;
use App\Http\Controllers\Backend\Manager\SliderController;
use App\Http\Controllers\Backend\Manager\CouponController;
use App\Http\Controllers\Backend\Manager\ShippingZoneController;
use App\Http\Controllers\Backend\Manager\OrderController;
use App\Http\Controllers\Backend\Manager\PageInfoController;


use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserOrder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
    Route::get('/login',[AdminController::class,'loginForm']);
    Route::post('/login',[AdminController::class,'store'])->name('admin.login');
});

// Admin Routes
Route::middleware(['auth:admin'])->group(function(){
Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
Route::get('/admin/profile',[AdminProfileController::class,'AdminProfile'])->name('admin.profile');
Route::get('/admin/profile/update',[AdminProfileController::class,'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/update/store',[AdminProfileController::class,'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/security/password',[AdminProfileController::class,'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/security_update/store',[AdminProfileController::class,'AdminUpdateChangePassword'])->name('admin.update.change.password');
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard',[DashboardController::class,'AdminDashboard'])->name('admin.dashboard')->middleware('auth:admin');
});

//User Routes
Route::get('/user/logout',[IndexController::class,'UserLogout'])->name('user.logout');
Route::get('/user/profile',[IndexController::class,'UserProfile'])->name('user.profile');
Route::post('/user/profile_store',[IndexController::class,'UserProfileStore'])->name('user.profile.store');
Route::get('/user/password',[IndexController::class,'UserChangePassword'])->name('user.change.password');
Route::post('/user/password_update/store',[IndexController::class,'UserChangePasswordStore'])->name('user.change.password.store');
Route::middleware(['auth:sanctum,web', 'verified'])->get('/', function () {
    return view('frontend.index');
})->name('user.dashboard');

//Brands Routes
Route::prefix('brands')->group(function(){
    Route::get('/view',[BrandController::class,'BrandView'])->name('brands');
    Route::post('/add_store',[BrandController::class,'BrandAdd'])->name('brands.add.store');
    Route::post('/update_store/{id}',[BrandController::class,'BrandUpdate'])->name('brand.update.store');
    Route::get('/delete/{id}',[BrandController::class,'BrandDelete'])->name('brand.delete');
});

//Main Categories Routes
Route::prefix('categories')->group(function(){
    Route::get('/view',[CategoryController::class,'CategoryView'])->name('categories');
    Route::post('/add_store',[CategoryController::class,'CategoryAdd'])->name('category.add.store');
    Route::post('/update_store/{id}',[CategoryController::class,'CategoryUpdate'])->name('category.update.store');
    Route::get('/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category.delete');
});

//Sub Categories Routes
Route::prefix('categories/sub')->group(function(){
    Route::get('/view',[SubCategoryController::class,'SubCategoryView'])->name('sub.categories');
    Route::post('/add_store',[SubCategoryController::class,'SubCategoryAdd'])->name('sub.category.add.store');
    Route::post('/update_store/{id}',[SubCategoryController::class,'SubCategoryUpdate'])->name('sub.category.update.store');
    Route::get('/delete/{id}',[SubCategoryController::class,'SubCategoryDelete'])->name('sub.category.delete');
});

//Product Routes
Route::prefix('products')->group(function(){
    Route::get('/', [ProductController::class, 'ManageProduct'])->name('product.manage');
    Route::get('/add',[ProductController::class,'AddProduct'])->name('product.add');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product.store');
    Route::get('/edit/{id}/{slug}', [ProductController::class, 'EditProduct'])->name('product.edit');
    Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product.update');
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete']);
    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
    Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
});

//-------------------- ADMIN PAGE ----------------------//

Route::prefix('settings')->group(function(){
    Route::get('/sliders/view', [SliderController::class, 'SliderView'])->name('sliders');
    Route::post('/sliders/add_store', [SliderController::class, 'SliderAdd'])->name('slider.add.store');
    Route::post('/sliders/update_store/{id}',[SliderController::class,'SliderUpdate'])->name('slider.update.store');
    Route::get('/sliders/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');
    Route::get('/sliders/inactive/{id}', [SliderController::class, 'SliderInactive'])->name('slider.inactive');
    Route::get('/sliders/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');

    Route::get('/pageInfo', [PageInfoController::class, 'SiteSetting'])->name('pageInfos');
    Route::post('/pageInfo/update', [PageInfoController::class, 'SiteSettingUpdate'])->name('update.sitesetting');

});


//--------------------FRONT END----------------------//
Route::get('/',[IndexController::class,'index'])->name('home');
Route::get('/product/details/{id}/{slug}',[IndexController::class,'ProductDetails']);

//-------------------- WISHLIST ----------------------//
Route::post('/wishlist/add/{product_id}', [WishlistController::class, 'AddToWishlist']);
Route::group(['prefix'=>'user','middleware' => ['user','auth'],'namespace'=>'User'],function(){
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('user.wishlist');
    Route::get('/wishlist/remove/{product_id}', [WishlistController::class, 'RemoveToWishlist']);
    Route::get('/wishlist/get', [WishlistController::class, 'GetWishlistProduct']);
});

//-------------------   CART   ----------------------//
Route::get('/cart/getcart/',[CartController::class,'Cart']);
Route::post('/cart/data/store/{id}',[CartController::class,'AddToCart']);
Route::get('/cart/minicart-remove/{id}',[CartController::class,'RemoveToCart']);
Route::get('/cart/mycart', [CartController::class, 'MyCart'])->name('user.cart');
Route::get('/cart/cart-increment/', [CartController::class, 'IncrementCartQty']);
Route::get('/cart/cart-decrement/', [CartController::class, 'DecrementCartQty']);
Route::get('/cart/cart-update/', [CartController::class, 'ChangeCartQty']);

//-------------------- COUPON ----------------------//
Route::prefix('coupons')->group(function(){
    Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
    Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store'); 
    Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
    Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');

    // Frontend Coupon
    Route::post('/coupon-apply', [CouponController::class, 'CouponApply']);
    Route::get('/coupon-calculation', [CouponController::class, 'CouponCalculation']);
    Route::get('/coupon-remove', [CouponController::class, 'CouponRemove']);
});

//-------------------- ADMIN SHIPPING AREA ----------------------//
Route::prefix('zone')->group(function(){
    Route::get('/', [ShippingZoneController::class, 'ViewAreas'])->name('manage-shippingzone');
    Route::get('/regions', [ShippingZoneController::class, 'RegionView']);
    Route::post('/regions/store', [ShippingZoneController::class, 'RegionStore']);
    Route::post('/regions/update/{id}', [ShippingZoneController::class, 'RegionUpdate']);
    Route::get('/regions/remove/{id}', [ShippingZoneController::class, 'RegionDelete']);

    Route::get('/regions/cities', [ShippingZoneController::class, 'CityView']);
    Route::get('/regions/cities/get/{regionId}', [ShippingZoneController::class, 'GetRegionCity']);
    Route::post('/regions/cities/store', [ShippingZoneController::class, 'CityStore']);
    Route::post('/regions/cities/update/{id}', [ShippingZoneController::class, 'CityUpdate']);
    Route::get('/regions/cities/remove/{id}', [ShippingZoneController::class, 'CityDelete']);
    
    Route::get('/regions/cities/brgy', [ShippingZoneController::class, 'BrgyView']);
    Route::post('/regions/cities/brgy/store', [ShippingZoneController::class, 'BrgyStore']);
    Route::post('/regions/cities/brgy/update/{id}', [ShippingZoneController::class, 'BrgyUpdate']);
    Route::get('/regions/cities/brgy/remove/{id}', [ShippingZoneController::class, 'BrgyDelete']);
});

//-------------------- CHECKOUT ROUTES ----------------------//
Route::get('/checkout', [CartController::class, 'CreateCheckout'])->name('checkout');
Route::get('/checkout/get-cities/{region_id}', [CheckoutController::class, 'GetCities']);
Route::get('/checkout/get-brgy/{city_id}', [CheckoutController::class, 'GetBrgy']);
Route::post('/checkout/payment', [CheckoutController::class, 'CheckoutStore'])->name('checkout.payment');

// /////////////////////  User Must Login  ////
Route::group(['prefix'=>'user','middleware' => ['user','auth'],'namespace'=>'User'],function(){
    Route::post('/stripe/order', [PaymentController::class, 'Stripe'])->name('stripe.order');
    Route::get('/cod/order', [PaymentController::class, 'CashOnDelivery'])->name('cod.order');
    Route::get('/orders', [UserOrder::class, 'UserOrders'])->name('user.orders');
    Route::get('/order/details/{order_id}', [UserOrder::class, 'OrderDetails'])->name('user.orders.details');
    Route::get('/invoice/{order_id}',  [UserOrder::class,  'InvoiceDownload'])->name('user.pdf.invoice');
});

//-------------------- ORDER MANAGER ----------------------//
 Route::prefix('orders')->group(function(){
    Route::get('/view/{order_id}', [OrderController::class, 'OrderViewDetails'])->name('order.view');
    Route::get('/dl/{order_id}', [OrderController::class, 'InvoiceDownload'])->name('dl.invoice');


   
    Route::get('/pending', [OrderController::class, 'PendingOrders'])->name('pending-orders');

    Route::get('/pick/{order_id}', [OrderController::class, 'BeginToPickOrder'])->name('begin-picking');
    Route::get('/pick/get/{order_id}', [OrderController::class, 'GetToPickOrder']);
    Route::get('/pick/skip/{order_id}', [OrderController::class, 'SkipToPickOrder']);
    Route::get('/pick/confirm/{order_id}', [OrderController::class, 'ConfirmedPick']);
    Route::get('/picked', [OrderController::class, 'PickedOrders'])->name('picked-orders');

    Route::get('/quality-control', [OrderController::class, 'BeginToQCOrders'])->name('begin-qc');
    Route::get('/qc/get/{pick_bin}', [OrderController::class, 'GetOrderToQC']);
    Route::get('/qc/confirm/{order_id}', [OrderController::class, 'QCConfirmed']);
    Route::get('/qc/available', [OrderController::class, 'VerifyToQCOrders']);

    Route::get('/ship', [OrderController::class, 'ShipOrders'])->name('ship-orders');
    Route::get('/ship/{id}', [OrderController::class, 'ShipConfirm'])->name('ship-confirm');

    Route::get('/delivered', [OrderController::class, 'DeliveredParcel'])->name('delivered-parcel');
});





//Utilities
Route::get('/subcategory/data/{category_id}',[SubCategoryController::class,'GetSubCategory'])->name('get.subcategory');
Route::get('/product/view/{id}',[IndexController::class,'GetModalAddToCartProductData']);



// // Frontend Product Tags Page 
// Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

// // Frontend SubCategory wise Data
// Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

// // Frontend Sub-SubCategory wise Data
// Route::get('/subsubcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']);



// // Admin Reports Routes 
// Route::prefix('reports')->group(function(){

// Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');

// Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');

// Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');

// Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');

// });


// // Admin Return Order Routes 
// Route::prefix('return')->group(function(){

// Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');

// Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');

// Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
 
// });

// /// Frontend Product Review Routes

// Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');


// // Admin Manage Review Routes 
// Route::prefix('review')->group(function(){

// Route::get('/pending', [ReviewController::class, 'PendingReview'])->name('pending.review');

// Route::get('/admin/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');

// Route::get('/publish', [ReviewController::class, 'PublishReview'])->name('publish.review');

// Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');
 
// });



// // Admin Manage Stock Routes 
// Route::prefix('stock')->group(function(){

// Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
 
 
// });


// /// Product Search Route 
// Route::post('/search', [IndexController::class, 'ProductSearch'])->name('product.search');

// // Advance Search Routes 
// Route::post('search-product', [IndexController::class, 'SearchProduct']);


// // Shop Page Route 
// Route::get('/shop', [ShopController::class, 'ShopPage'])->name('shop.page');
// Route::post('/shop/filter', [ShopController::class, 'ShopFilter'])->name('shop.filter');