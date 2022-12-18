<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', App\Http\Controllers\InvoicesController::class);

Route::resource('sections', App\Http\Controllers\SectionsController::class);

Route::resource('products', App\Http\Controllers\ProductsController::class);

Route::get('/change_password', 'App\Http\Controllers\HomeController@ChangePassword')->name('change_password');

Route::post('/update/password','App\Http\Controllers\HomeController@UpdatePassword')->name('update.password');

Route::get('/user/profile','App\Http\Controllers\HomeController@Profile')->name('profile');

Route::post('/my_profile','App\Http\Controllers\HomeController@StoreProfile')->name('store_profile');

Route::get('/section/{id}', 'App\Http\Controllers\InvoicesController@getproducts');

Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoicesController@show')->name('Status_show');

Route::post('/Status_Update/{id}', 'App\Http\Controllers\InvoicesController@Status_Update')->name('Status_Update');

Route::post('/Add_Attachment', 'App\Http\Controllers\InvoicesController@add_attachments')->name('addattachments');

Route::get('/InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');

Route::get('Invoice_Paid','App\Http\Controllers\InvoicesController@Invoice_Paid');

Route::get('Invoice_UnPaid','App\Http\Controllers\InvoicesController@Invoice_UnPaid');

Route::get('Invoice_Partial','App\Http\Controllers\InvoicesController@Invoice_Partial');

Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailsController@destroy')->name('delete_file');

Route::get('/edit_invoice/{id}', 'App\Http\Controllers\InvoicesController@edit');

Route::resource('Archive', App\Http\Controllers\InvoiceAchiveController::class);

Route::resource('/InvoiceAttachments', App\Http\Controllers\InvoiceAttachmentsController::class);

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles',App\Http\Controllers\RoleController::class);
    Route::resource('users',App\Http\Controllers\UserController::class);
});

Route::get('MarkAsRead_all','App\Http\Controllers\InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('invoices_report', 'App\Http\Controllers\Invoices_Report@index');

Route::post('Search_invoices', 'App\Http\Controllers\Invoices_Report@Search_invoices');

Route::get('Print_invoice/{id}','App\Http\Controllers\InvoicesController@Print_invoice');
 
Route::get('customers_report', 'App\Http\Controllers\Customers_Report@index')->name("customers_report");

Route::post('Search_customers', 'App\Http\Controllers\Customers_Report@Search_customers');

Route::get('/{page}', 'App\Http\Controllers\AdminController@index');