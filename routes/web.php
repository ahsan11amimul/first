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
Auth::routes();
Route::get('/','IndexController@index')->name('/');
Route::match(['get','post'],'/contact','IndexController@contact')->name('contact');
Route::get('/shipping','IndexController@shipping')->name('shipping');

Route::get('/search','IndexController@search')->name('search');
Route::get('/product/{id}','IndexController@product');
Route::get('/category/{id}','IndexController@category');


Route::post('/add_wishlist','CartController@add_wishlist')->name('add_wishlist');
Route::get('/delete_item/{id}','CartController@delete_item')->name('delete_item');

Route::post('/add_cart','CartController@add_cart')->name('add_cart');
//Route::get('/show_cart','CartController@show_cart')->name('show_cart');
Route::get('/delete_cart/{id}','CartController@delete_cart')->name('delete_cart');
Route::get('/increment_cart/{id}','CartController@increment_cart')->name('increment_cart');
Route::get('/decrement_cart/{id}','CartController@decrement_cart')->name('decrement_cart');
Route::get('/clear_cart','CartController@clear_cart')->name('clear_cart');
// Route::get('/cart_items','CartController@cart_items')->name('cart_items');
// Route::get('/cart_total','CartController@cart_total')->name('cart_total');



Route::match(['get', 'post'], '/signup','SigninController@signup')->name('signup');
Route::match(['get', 'post'], '/signin','SigninController@signin')->name('signin');
Route::get('verify_user/{token}','SigninController@verifyEmail')->name('verify_user');
Route::match(['get','post'],'/forget_password','SigninController@forget_password')->name('forget_password');
Route::match(['get','post'],'/create_password/{id}','SigninController@create_password');

Route::group(['middleware' => ['auth','admin','revalidate']], function () {
     Route::get('admin/index','AdminController@index')->name('admin.index');
     Route::get('admin/search','AdminController@search')->name('admin.search');
     Route::get('admin/show_customer','AdminController@show_customer')->name('admin.show_customer');
     Route::get('admin/single_customer/{id}','AdminController@single_customer')->name('admin.single_customer');
     Route::match(['get', 'post'], 'admin/settings','AdminController@settings')->name('admin.settings');
     Route::match(['get', 'post'], '/admin/profile/{id}','AdminController@profile')->name('admin.profile');
    //admin order
    Route::get('admin/view_order/{id}','AdminController@view_order')->name('admin.view_order');
    Route::get('admin/new_order','AdminController@new_order')->name('admin.new_order');
    Route::get('admin/delete_order/{id}','AdminController@delete_order')->name('admin.delete_order');
    Route::get('admin/update_order/{id}','AdminController@update_order')->name('admin.update_order');
    // admin category
    Route::match(['get', 'post'], 'admin/add_category','CategoryController@add_category')->name('admin.add_category');
    Route::match(['get', 'post'], 'admin/edit_category/{id}','CategoryController@edit_category')->name('admin.edit_category');
    Route::get('admin/view_category','CategoryController@view_category')->name('admin.view_category');
    Route::get('admin/delete_category/{id}','CategoryController@delete_category')->name('admin.delete_category');
    Route::get('admin/single_category/{id}','CategoryController@single_category')->name('admin.single_category');
    //admin product
    Route::match(['get', 'post'], 'admin/add_product','ProductController@add_product')->name('admin.add_product');
    Route::match(['get', 'post'], 'admin/edit_product/{id}','ProductController@edit_product')->name('admin.edit_product');
    Route::get('admin/view_product','ProductController@view_product')->name('admin.view_product');
    Route::match(['get','post'],'admin/single_product/{id}','ProductController@single_product')->name('admin.single_product');
    Route::get('admin/delete_product/{id}','ProductController@delete_product')->name('admin.delete_product');
    //admin report
    Route::get('admin/sales_report','AdminController@sales_report')->name('admin.sales_report');
    Route::get('admin/cost_report','AdminController@cost_report')->name('admin.cost_report');
    Route::get('admin/products_report','AdminController@products_report')->name('admin.products_report');
    Route::get('admin/new_products','AdminController@new_products')->name('admin.new_products');
    Route::get('admin/buy_product/{id}','AdminController@buy_product')->name('admin.buy_product');
    Route::get('admin/low_products','AdminController@low_products')->name('admin.low_products');
   
    //admin area  
    Route::get('admin/view_area','AreaController@view_area')->name('admin.view_area');
    Route::match(['get', 'post'], 'admin/add_area','AreaController@add_area')->name('admin.add_area');
    Route::match(['get', 'post'], 'admin/edit_area/{id}','AreaController@edit_area')->name('admin.edit_area');
    Route::match(['get', 'post'], 'admin/add_delivery/{id}','AreaController@add_delivery')->name('admin.add_delivery');
    Route::get('admin/delete_delivery/{id}','AreaController@delete_delivery');

    Route::post('admin/need_product','AdminController@need_product')->name('admin.need_product');
    Route::get('admin/view_message','AdminController@view_message')->name('admin.view_message');
    Route::get('admin/contact','AdminController@contact')->name('admin.contact');
    Route::get('admin/contact_delete/{id}','AdminController@contact_delete');
    Route::post('admin/contact_reply','AdminController@contact_reply');
         
});
Route::group(['middleware' => ['auth','customer','revalidate']], function () {
  
    Route::get('customer/index','CustomerController@index')->name('customer.index');
    Route::get('customer/search','CustomerController@search')->name('customer.search');
    Route::get('/customer_payment','PaymentController@customer_payment')->name('customer_payment');
   
  
   
    Route::get('customer/details/{id}','CustomerController@details')->name('customer.details');
    Route::get('customer/product/{id}','CustomerController@product')->name('customer.product');
    Route::match(['get', 'post'], '/customer/settings/{id}','CustomerController@settings')->name('customer.settings');
   
    //
    Route::get('customer/checkout','OrderController@checkout')->name('customer.checkout');
    Route::post('customer/updateAddress','OrderController@updateAdress')->name('customer.updateAddress');
    Route::get('customer/summary','OrderController@summary')->name('customer.summary');
    Route::get('customer/order_summary/{id}','OrderController@order_summary')->name('customer.order_summary');
     Route::get('customer/order_status/{id}','OrderController@order_status')->name('customer.order_status');
    Route::get('customer/order_history/{id}','OrderController@order_history')->name('customer.order_history');
    Route::post('customer/orderStore','OrderController@orderStore')->name('customer.orderStore');
    Route::get('customer/cancelOrder','OrderController@cancelOrder')->name('customer.cancelOrder');
    Route::post('customer/onlinePayment','OrderController@onlinePayment')->name('customer.onlinePayment');
    
   
});  

Route::group(['middleware' => ['auth','farmer','revalidate']], function () {
     Route::get('customer/shop','CustomerController@shop')->name('customer.shop');
     Route::match(['get', 'post'], '/customer/profile/{id}','CustomerController@profile')->name('customer.profile');
     Route::match(['get', 'post'], 'customer/add_product','CustomerController@add_product')->name('customer.add_product');
     Route::get('customer/view_message','CustomerController@view_message')->name('customer.view_message');
     Route::match(['get', 'post'], 'customer/edit_product/{id}','CustomerController@edit_product')->name('customer.edit_product');
     Route::post('customer/confirm_product','CustomerController@confirm_product')->name('customer.confirm_product');
     Route::get('customer/view_product','CustomerController@view_product')->name('customer.view_product');
     Route::get('shop/search','CustomerController@shop_search')->name('shop.search');
     Route::get('customer/verify/{id}','CustomerController@verify')->name('customer.verify');
      Route::match(['get', 'post'], '/farmer/settings/{id}','CustomerController@farmer_settings')->name('farmer.settings');
});
Route::group(['middleware' => ['auth','revalidate']], function () {
     //message
    Route::get('message','MessageController@index')->name('message');
    Route::get('message/{id}','MessageController@getmessage');
    Route::post('message_sent','MessageController@sentmessage');
    Route::post('customer/update_password','CustomerController@update_password')->name('customer.update_password');
    Route::post('customer/show_account/','CustomerController@show_account')->name('customer.show_account');
    Route::post('customer/create_account/','CustomerController@create_account')->name('customer.create_account');
    Route::post('customer/delete_account/{id}','CustomerController@delete_account')->name('customer.delete_account');
    Route::get('/logout','SigninController@logout')->name('logout');


   
    //payment
    Route::post('/payment','PaymentController@payment')->name('payment');
    Route::post('/check_trx','PaymentController@check_trx')->name('check_trx');
    Route::post('admin/online_payment','PaymentController@online_payment')->name('admin.online_payment');
    Route::get('/payment_report','PaymentController@payment_report')->name('payment_report');
});
// Route::get('/',function()
// {
//     event(new MyEvent('hello world'));
//     return view('welcome');
// });
//Route::get('/home', 'HomeController@index')->name('home');
