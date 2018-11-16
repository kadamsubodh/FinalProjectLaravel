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
Route::get('/eshopers/home', function () {
    return view('frontend.index');
})->middleware('checkIsCustomer');

Route::get('/eshopers/checkout','front\CheckoutController@checkoutList');
Route::get('/eshopers/contactUs', function () {
    return view('frontend.contactUs');
});
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
Route::post("/eshopers/placeOrder", function(){
    var_dump(get_defined_vars());
return extract($_POST);

});

//-------------------------------------------------------------------------
Route::get('/eshopers/login', function(){
    return view('frontend.login');
});



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

//--------------socialite routes------------------------------------

Route::get('/auth/social/{method}','front\customerLoginController@redirectToProvider');
Route::get('/auth/social/callback/{method}','front\customerLoginController@handleProviderCallback');

//---------------Product Details Route----------------------------------
Route::get('/eshopers/productDetails/{product_id}','front\productDetailsController@getDetails');

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
    return view('admin.dashboard.index');
})->middleware('checkLogin');
Route::get('/index2', function () {
    return view('admin.dashboard.index2');
})->middleware('checkLogin');
Route::get('top_nav', function () {
    return view('admin.layout.app_top_nav');
});
Route::get('/boxed', function () {
    return view('admin.layout.app_box');
});
Route::get('/fixed', function () {
    return view('admin.layout.fixed');
});
Route::get('/collapsed', function () {
    return view('admin.layout.collapsed_sidebar');
});
Route::get('/widgets', function () {
    return view('admin.widgets.widgets');
});
Route::get('/chartJS', function () {
    return view('admin.charts.chartJS');
});
Route::get('/morris', function () {
    return view('admin.charts.morris');
});
Route::get('/flot', function () {
    return view('admin.charts.flot');
});
Route::get('/inline', function () {
    return view('admin.charts.inline');
});
Route::get('/generalUI', function () {
    return view('admin.UI_Elements.generalUI');
});
Route::get('/iconsUI', function () {
    return view('admin.UI_Elements.iconsUI');
});
Route::get('/buttonsUI', function () {
    return view('admin.UI_Elements.buttonsUI');
});
Route::get('/slidersUI', function () {
    return view('admin.UI_Elements.slidersUI');
});
Route::get('/timelineUI', function () {
    return view('admin.UI_Elements.timelineUI');
});

Route::get('/modalsUI', function () {
    return view('admin.UI_Elements.modalsUI');
});

//Route for admin.forms
Route::get('/forms/generalForms', function () {
    return view('admin.forms.generalForms');
});
Route::get('/forms/advanceForms', function () {
    return view('admin.forms.advanceForms');
});
Route::get('/forms/editors', function () {
    return view('admin.forms.editors');
});
Route::resource('/admin/email_templates','Email_templateController')->middleware('checkLogin');

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