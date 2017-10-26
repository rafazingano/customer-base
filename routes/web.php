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

Route::get('/welcome', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset'); 

Route::middleware(['auth', 'role:administrator'])->group(function () {
    
    Route::get('/campaigns/{campaign}/customers/create', 'CustomerController@create')->name('campaigns.customers.create');
    Route::get('/customers/export/{campaign}', 'CustomerController@exportStore')->name('customers.export');
    Route::get('/customers/{campaign}/import', 'CustomerController@import')->name('customers.import');
    Route::post('/customers/import', 'CustomerController@importStore')->name('customers.import.post');
    
    Route::resource('/users', 'UserController');
    
    Route::resource('/blogImages', 'BlogImageController');

    
    Route::get('/campaigns/{campaign}/kits/create', 'KitController@create')->name('campaigns.kits.create');
    

    
    
    Route::post('/kitItems/updatemany', 'KitItemController@updatemany')->name('kitsitems.updatemany');
    Route::get('/kititems/{kititem}/import', 'KitItemController@import')->name('kititems.import');
    Route::post('/kititems/import', 'KitItemController@importStore')->name('kititems.import.post');

    
    Route::get('/campaigns/{campaign}/galleries/create', 'GalleryController@create')->name('campaigns.galleries.create');
    Route::get('/campaigns/{campaign}/galleries/{id}/edit', 'GalleryController@edit')->name('campaigns.galleries.edit');
    

    Route::delete('/files/{id}', 'FileController@destroy')->name('files.destroy');
    
});
Route::middleware(['auth', 'role:administrator|client'])->group(function () {
    Route::resource('/kitItems', 'KitItemController');
    Route::get('/campaigns/{campaign}/kits', 'KitController@index')->name('campaigns.kits.index');
    Route::resource('/kits', 'KitController');
    Route::get('/campaigns/{campaign}/kits/{id}/edit', 'KitController@edit')->name('campaigns.kits.edit');
    Route::resource('/galleries', 'GalleryController');
    Route::get('/campaigns/{campaign}/galleries', 'GalleryController@index')->name('campaigns.galleries.index');
    Route::resource('/galleryImages', 'GalleryImageController');
});

Route::middleware(['auth', 'role:administrator|promoter'])->group(function () {
    Route::get('/campaigns/{campaign}/customers/{id}', 'CustomerController@edit')->name('campaigns.customers.edit');
}); 

Route::middleware('auth')->group(function () {
    Route::get('/', 'CampaignController@index');
    Route::get('/home', 'CampaignController@index')->name('home');
    Route::resource('/campaigns', 'CampaignController');
    Route::resource('/customers', 'CustomerController');
    Route::get('/campaigns/{campaign}/customers', 'CustomerController@index')->name('campaigns.customers.index');
    Route::resource('/blogs', 'BlogController');
});