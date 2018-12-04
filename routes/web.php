<?php

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
//-x-x-x-x-x-x-x-x-x-x-x-x-x- FrontEnd Routes -x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x

Route::get('/admin/check','UserOrderController@checkEmailView');
Route::get('/eshopers/home', function () {
    return view('frontend.index');
})->middleware('checkIsCustomer');

Route::get('/eshopers/shop', function () {
    return view('frontend.shop');
});
Route::get('/eshopers/bolgs', function () {
    return view('frontend.blogs');
});
Route::get('/eshopers/singleBlog', function () {
    return view('frontend.singleBlog');
});
Route::get('/eshopers/productDetails', function () {
    return view('frontend.productDetails');
});
//-----------------Cart Routes-----------------------------------------
Route::get('/eshopers/cart', 'front\CartController@cartList');
Route::get('/eshopers/cart/{product_id}','front\CartController@addToCart');

Route::get('/eshopers/clearCart', 'front\CartController@emptyCart');
Route::get('/eshopers/removeFromCart/{product_id}','front\CartController@removeFromCart');
Route::post('/eshopers/addOneQuantityOfProduct','front\CartController@addOneQuantityOfProduct');
Route::post('/eshopers/removeOneQuantityOfProduct','front\CartController@removeOneQuantityOfProduct');
Route::post('/eshopers/cart/{product_id}','front\CartController@addToCartFromWishList');

//------------------------checkOut-------------------
Route::post("/eshopers/placeOrder",'front\CheckoutController@placeOrder');
Route::get('/eshopers/checkout','front\CheckoutController@checkoutList');
Route::post("/eshopers/setFinalCheckOutData",'front\CheckoutController@setCookieForFinalCheckOutData');
Route::get("/eshopers/getPaymentStatus",'front\CheckoutController@getPaymentStatus')->name('status');


//--------------------my orders------
Route::get("eshopers/myOrders", function(){
    return view('frontend.myOrders');
});

//-------------------------------------------------------------------------
Route::get('/eshopers/login', function(){
    return view('frontend.login');
});

//---------------------- Track Order ----------------------
Route::get("/eshopers/trackOrderView", function(){
    return view('frontend.trackOrderView');
});
Route::post("eshopers/getMyOrderStatus",'UserOrderController@checkOrderStatus');


//-----------------------User Wish List------------------------------------
Route::get('eshopers/addtowishlist/{productId}','front\userWishListController@addProductToWishlist')->middleware('checkCustomerLogin');
Route::get('/eshopers/wishlist',function(){
    return view('frontend.wishlist');
})->middleware('checkCustomerLogin');
Route::get('eshopers/clearWishList','front\userWishListController@emptyWishList')->middleware('checkCustomerLogin');
Route::get('eshopers/removeFromWishList/{product_id}','front\userWishListController@removeItemFromWishList')->middleware('checkCustomerLogin');
//-------------------------SIGN IN & LOGOUT---------------------------
Route::get('/eshopers/logout', 'front\customerLoginController@customerLogout');
Route::post('/eshopers/signup','front\customerLoginController@customerSignUp');
Route::post('/eshopers/signin','front\customerLoginController@customerSignIn');
//----------------------------USer Address-------------------------------

Route::resource('/eshopers/userAddress','UserAddressController');

//---------------------------change password-------------
Route::post("/eshopers/changePassword","front\customerLoginController@changePassword");
Route::get('/eshopers/passwordChange',function(){
return view('frontend.changePassword');
});

//-----------------my profile----------------------
Route::get("/eshopers/myProfile",function(){
return view('frontend.myProfile');
});
Route::get("/eshopers/editMyInfo", function(){
    return view('frontend.updateMyInfo');
});
Route::post("/eshopers/updateMyInfo","userController@updateMyInfo");

//------------------contactUs
Route::get('/eshopers/contactUs', function () {
    return view('frontend.contactUs');
});
Route::post('/eshopers/contactAdmin','ContactAdminController@contactAdmin');

Route::resource('admin/contactUs','ContactUsController');
Route::post('/admin/replyToCustomer','ContactUsController@replyToCustomer');
//--------------socialite routes------------------------------------

Route::get('/auth/social/{method}','front\customerLoginController@redirectToProvider');
Route::get('/auth/social/callback/{method}','front\customerLoginController@handleProviderCallback');

//---------------Product Details Route----------------------------------
Route::get('/eshopers/productDetails/{product_id}','front\productDetailsController@getDetails');

//-------------newsletter Route----------------------------------------

Route::resource('/eshopers/subscribeNewsletter','NewsletterController');

//--------Routes for getting Products According to category---------
Route::get('/eshopers/products/{category}','front\frontViewController@listProducts');
Route::get('eshopers/forgetpassword', function() {
    return view('frontend.forgetpassword');
});
Route::post('eshopers/sendMail','front\customerLoginController@sendPasswordByEmail');

Route::get("/demoCookie",function(){
return view('frontend.demoCookie');
});


Route::get('/', function () {
    return view('admin.layout.login');
})->middleware('checkLogin');
Route::get('/index', function () {
    return redirect('admin/reports/salesReport');
})->middleware('checkLogin');

Route::resource('/admin/mailTemplate','EmailTemplateController')->middleware('checkLogin');

//---------------------login route--------------------------------------

Route::get('/','loginController@showLogin');
Route::post('/doLogin','loginController@doLogin');
Route::get('/doLogOut','loginController@doLogOut');
//-------------------users Route----------------------------------------
Route::resource('admin/users', 'userController')->middleware('checkLogin');
//-------------------Config route---------------------------------------
Route::resource('admin/configurations', 'configurationController')->middleware('checkLogin');
//----------------------------------------------------------------------
//banners
Route::resource('admin/banners', 'BannerController')->middleware('checkLogin');
//categories
Route::resource('admin/categories', 'CategoryController')->middleware('checkLogin');
//category tree
Route::get('/demo', function () {
    return view('admin.categories.demo');
});

Route::resource('admin/products', 'ProductController')->middleware('checkLogin');
Route::resource('admin/productsattributes', 'ProductAttributesController')->middleware('checkLogin');

Route::post('/selectAjax', function () {
    return view('admin.products.addSelect');
});
//----------------------- Coupon code Routes------------------------------------
Route::get('/getCode', function () {
    return view('admin.categories.getCode');
});
Route::post('/checkCode','CouponsController@isExist');
Route::resource('admin/coupons', 'CouponsController')->middleware('checkLogin');
Route::get('/getCouponCode','CouponsController@getCouponCode')->middleware('checkLogin');
Route::post('/eshopers/checkIsCouponUsed', 'CouponsController@checkIsCouponUsed');
Route::post('/eshopers/applyCoupon', 'CouponsController@applyCoupon');
Route::post('/eshopers/updateCartBill','CouponsController@updateCartBill');
Route::get('eshopers/removeCoupon','CouponsController@removeCoupon');

//------------------------Order Management---------------------
Route::resource('admin/orderManagement','OrderManagementController');
Route::post("admin/changeOrderStatus/{order_id}","OrderManagementController@changeOrderStatus");

//---------------------------CMS Controller-----------------------------------
Route::resource('admin/cms','CmsController');
Route::get("admin/about/{cms}","CmsController@cms");

//--------------------------Reports-----------------------------------
Route::get('admin/reports/{typeOfReport}','ReportController@getReport');