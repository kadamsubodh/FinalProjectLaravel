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
Route::get('/front', function () {
    return view('frontend.login');
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

//---------------------login route--------------------------------------

Route::get('/','loginController@showLogin');
Route::post('/doLogin','loginController@doLogin');
Route::get('/doLogOut','loginController@doLogOut');
Route::resource('admin/users', 'userController')->middleware('checkLogin');
Route::resource('admin/configurations', 'configurationController')->middleware('checkLogin');


Route::resource('admin/banners', 'BannerController')->middleware('checkLogin');
Route::resource('admin/categories', 'CategoryController')->middleware('checkLogin');
Route::get('/demo', function () {
    return view('admin.categories.demo');
});
Route::resource('admin/products', 'ProductController')->middleware('checkLogin');
Route::resource('admin/productsattributes', 'ProductAttributesController')->middleware('checkLogin');
Route::resource('admin/coupons', 'CouponsController')->middleware('checkLogin');

Route::post('/selectAjax', function () {
    return view('admin.products.addSelect');
});

Route::get('/getCode', function () {
    return view('admin.categories.getCode');
});
Route::post('/checkCode','CouponsController@isExist');
