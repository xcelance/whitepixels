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

Route::get('', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('change_currency', 'PageController@change_currency');
Route::get('sendmail', 'PageController@sendmail');

Route::get('category/{maincat}/{slug}', 'CategoryViewController@view')->name('category');
Route::get('product/{maincat}/{slug}', 'ProductViewController@view')->name('product.view');
// Route::get('product-search', 'SearchController@result')->name('search.result');

Route::get('product-search', 'SearchController@index');
Route::get('autocomplete', 'SearchController@searchProducts');

Route::post('product-demo-download', 'ProductViewController@downloadDemoProduct')->name('product.demo.download');

Route::post('add-to-cart', 'CartController@addToCart')->name('cart.add-to-cart');
Route::get('cart/view', 'CartController@view')->name('cart.view');
Route::put('cart/update', 'CartController@update')->name('cart.update');
Route::get('cart/destroy/{id}', 'CartController@destroy')->name('cart.destroy');

Route::get('checkout', 'CheckoutController@index')->name('checkout.index');

Route::post('checkout-field-updated', 'CheckoutController@checkoutFieldUpdated')->name('checkout.field.updated');

Route::get('login/{provider}', 'Auth\LoginController@providerLogin')->name('login.provider');
Route::get('login/{provider}/callback', 'Auth\LoginController@providerCallback')->name('provider.callback');
Route::post('login_ajax', 'Auth\LoginController@login_ajax');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('order/loginprocess', 'Auth\LoginController@loginprocessForm')->name('loginprocess');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset.token.post');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset.form');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.post');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

Route::get('order', 'OrderController@index')->name('order.index');
Route::post('order', 'OrderController@place')->name('order.place');
Route::get('order/success/{order}', 'OrderController@success')->name('order.success');

Route::get('page/{slug}', 'PageController@show')->name('page.show');
Route::get('products', 'CategoryViewController@products_all');
Route::get('cat_products', 'CategoryViewController@cat_products');
Route::get('aboutus', 'PageController@aboutus')->name('aboutus');
Route::get('faq', 'PageController@faq');
Route::get('artwork-guide', 'PageController@artwork_guide');
Route::get('contact-us', 'PageController@contact');
Route::get('legal', 'PageController@legal');
Route::get('cutting-forme', 'PageController@cuttingForme');
Route::get('request_quote', 'PageController@request_quote')->name('page.request_quote');
Route::post('request_quote', 'PageController@post_request_quote');
Route::get('getproductsbycat', 'PageController@getProductsByCatid');
Route::get('get_custom_data', 'ProductViewController@get_custom_data');
Route::get('get_custom_change_data', 'ProductViewController@get_custom_change_data');
Route::get('get_order_detail_data', 'ProductViewController@get_order_detail_data');
Route::get('get_sort_data', 'ProductViewController@get_sort_data');
Route::post('send_order', 'ProductViewController@send_order');
Route::get('uploadartwork', 'PageController@uploadartwork');
Route::post('uploadartwork', 'PageController@postuploadartwork');
Route::post('check_jobId', 'PageController@check_jobId');
Route::get('samplepacks', 'PageController@samplePacks');
Route::post('samplepacks', 'PageController@postsamplePacks');

Route::get('order/orderprocess', 'OrderController@orderprocess');
Route::get('guest_login', 'Auth\RegisterController@guest_login');
Route::group(['middleware' => ['auth']], function() {
 Route::post('order_product', 'OrderController@place')->name('order.place');
 Route::get('quotes', 'OrderController@myQuotes');
 Route::get('quotation/place_order/{quote_id}', 'CartController@quotationPlaceOrder');
 Route::post('quotation/cart', 'CartController@quotationPlaceOrder');
 Route::post('quote_place', 'OrderController@quote_place');
});
Route::middleware(['auth', 'verified'])->prefix('my-account')->name('my-account.')->group(function () {
    Route::get('', 'User\MyAccountController@home')->name('home');
    Route::get('edit', 'User\MyAccountController@edit')->name('edit');
    Route::post('edit', 'User\MyAccountController@store')->name('store');
    Route::post('edit_profile', 'User\MyAccountController@edit_profile');
    Route::post('edit_billing', 'User\MyAccountController@edit_billing');
    Route::post('edit_delivery', 'User\MyAccountController@edit_delivery');
    Route::get('upload-image', 'User\MyAccountController@uploadImage')->name('upload-image');
    Route::post('upload-image', 'User\MyAccountController@uploadImagePost')->name('upload-image.post');
    Route::get('change-password', 'User\MyAccountController@changePassword')->name('change-password');
    Route::post('change-password', 'User\MyAccountController@changePasswordPost')->name('change-password.post');

    Route::delete('destroy', 'User\MyAccountController@destroy')->name('destroy');

    Route::resource('address', 'User\AddressController');

    Route::get('order/list', 'OrderController@myAccountOrderList')->name('order.list');
    Route::get('order/{order}/view', 'OrderController@myAccountOrderView')->name('order.view');
    Route::get('order/{order}/return', 'OrderController@return')->name('order.return');
    Route::post('order/{order}/return', 'OrderController@returnPost')->name('order.return.post');
    Route::get('invoice/list', 'OrderController@myAccountinvoiceList');
    Route::get('invoice/detail/{job_id}', 'OrderController@myAccountinvoiceDetail');
    Route::get('jobs/list', 'OrderController@myAccountJobsList');
    Route::get('jobs/detail/{job_id}', 'OrderController@myAccountJobDetail');

    Route::get('quote/detail/{job_id}', 'OrderController@myAccountquoteDetail');
    Route::get('quote/payment/{job_id}', 'OrderController@myAccountquotePayment');

    Route::get('wishlist/add/{slug}', 'User\WishlistController@add')->name('wishlist.add');
    Route::get('wishlist', 'User\WishlistController@mylist')->name('wishlist.list');
    Route::get('wishlist/remove/{slug}', 'User\WishlistController@destroy')->name('wishlist.remove');

    Route::post('product-main-download', 'ProductViewController@downloadMainProduct')->name('product.main.download');
});
