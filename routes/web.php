<?php

use App\Models\Customer;
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
//Route::get('Customers', 'Customer\CustomerController@index')->name('Customer.index');
Route::group(['namespace' => 'Dashboard', 'prefix' => 'Dashboard', 'middleware ' => 'auth'], function () {
    //box
    Route::group(['prefix' => 'Boxs'], function () {

        Route::get('/', 'BoxController@index')->name('Boxs.index');
        Route::post('/', 'BoxController@store')->name('Boxs.store');
        Route::get('/{id}/edit', 'BoxController@edit')->name('Boxs.edit');
        Route::put('/update/{id}', 'BoxController@update')->name('Boxs.update');
        Route::get('/destroy/{id}', 'BoxController@destroy')->name('Box.destroy');
        Route::get('/pdf', 'BoxController@createPDF');
    });
    //Start Counter Controller
    //Route::resource('Counters', 'CounterController');
    Route::get('Counters', 'CounterController@index')->name('Counters.index');
    Route::get('Counters/Create', 'CounterController@Create')->name('Counters.Create');

    Route::post('Counters', 'CounterController@store')->name('Counters.store');
    Route::get('Counters/{id}/edit', 'CounterController@edit')->name('Counters.edit');
    Route::put('Counters/update/{id}', 'CounterController@update')->name('Counters.update');
    Route::get('Counters/destroy/{id}', 'CounterController@destroy')->name('Counters.destroy');
    //  Route::get('Counters/destroy/{id}', 'BoxController@destroy')->name('Box.destroy');
    //end Counter Controller

    //Start Customer
    Route::get('Customers', 'CustomerController@index')->name('Customers.index');
    Route::get('/Customer/register', 'CustomerController@getRegister')->name('Customer.getRegister');
    Route::post('/Customer/register', 'CustomerController@create')->name('Customer.create');
    Route::get('Customer/{id}/edit', 'CustomerController@edit')->name('Customer.edit');
    Route::put('Customer/update/{id}', 'CustomerController@update')->name('Customer.update');
    Route::get('/Get_counter/{id}', 'CustomerController@getcounter');
    //end Customer

    //Start Invoice
    Route::get('Invoice', 'InvoiceController@index')->name('Invoice.index');
    Route::get('Invoice/create', 'InvoiceController@create')->name('Invoice.create');
    Route::post('Invoice', 'InvoiceController@store')->name('Invoice.store');
    Route::get('Invoice/{id}/edit', 'InvoiceController@edit')->name('Invoice.edit');
    Route::put('Invoice/update/{id}', 'InvoiceController@update')->name('Invoice.update');
    Route::get('Invoice/destroy/{id}', 'InvoiceController@destroy')->name('Invoice.destroy');
    Route::get('Invoice/Driven', 'InvoiceController@driven')->name('Invoice.driven');
    Route::get('Invoice/Unpaid', 'InvoiceController@unpaid')->name('Invoice.unpaid');


    //Start Invoice
    // Route::resource('Payment', 'PaymentController');
    Route::get('Payment', 'PaymentController@index')->name('Payment.index');
    Route::get('Payment/create', 'PaymentController@create')->name('Payment.create');
    Route::post('Payment', 'PaymentController@store')->name('Payment.store');
    Route::get('Payment/{id}/show', 'PaymentController@show')->name('Payment.edit');
    Route::get('Payment/{id}/edit', 'PaymentController@edit')->name('Payment.edit');
    Route::put('Payment/update/{id}', 'PaymentController@update')->name('Payment.update');
    Route::get('Payment/destroy/{id}', 'PaymentController@destroy')->name('Payment.destroy');
    Route::get('Payment/Get_Invoice/{id}', 'PaymentController@Get_Invoice');
    //   Route::resource('Expense', 'ExpenseController');
    Route::get('Expense', 'ExpenseController@index')->name('Expense.index');
    Route::get('Expense/create', 'ExpenseController@create')->name('Expense.create');
    Route::post('Expense', 'ExpenseController@store')->name('Expense.store');
    Route::get('Expense/{id}/edit', 'ExpenseController@edit')->name('Expense.edit');
    Route::put('Expense/update/{id}', 'ExpenseController@update')->name('Expense.update');
    Route::get('Expense/destroy/{id}', 'ExpenseController@destroy')->name('Expense.destroy');

    Route::get('Profile/', 'ProfileController@Profile')->name('User.Profile');
    Route::put('Profile/{id}/Update/', 'ProfileController@UpdateProfile')->name('User.Profile.update');
    Route::get('changePassword/', 'ProfileController@changePassword')->name('User.Profile.password');
    Route::post('Profile/change-password', 'ProfileController@store')->name('change.password');
    Route::get('logout', 'ProfileController@logout')->name('admin.logout');

    Route::resource('roles', 'RoleController');
//    Route::resource('', 'UserController');
    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::post('users', 'UserController@store')->name('users.store');
    Route::get('users/{id}/show', 'UserController@show')->name('users.show');
    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::put('users/update/{id}', 'UserController@update')->name('users.update');
    Route::get('users/destroy/{id}', 'UserController@destroy')->name('users.destroy');


    //end Invoice
});


//Route::resource('ajaxproducts', 'ExpenseController');

Route::group(['namespace' => 'Customer\Auth', 'prefix' => 'Customer', 'middleware' => 'guest:customer'], function () {
    Route::get('/login', 'LoginController@login')->name('Customer.login');
    Route::post('/login/', 'LoginController@postLogin')->name('postLogin');
});


Route::group(['namespace' => 'Customer', 'prefix' => 'Customers', 'middleware ' => 'auth:customer'], function () {
    Route::get('Profile/', 'ProfileController@Profile')->name('Customer.Profile');
    Route::put('Profile/{id}/Update/', 'ProfileController@UpdateProfile')->name('Customer.Profile.update');
    Route::get('changePassword/', 'ProfileController@changePassword')->name('Customer.Profile.password');
    Route::post('Profile/change-password', 'ProfileController@store')->name('change.password');
    Route::get('logout', 'ProfileController@logout')->name('Customer.logout');
    Route::get('Invoice', 'InvoiceController@index')->name('Customer.Invoice.index');
    Route::get('Payment', 'PaymentController@index')->name('Customer.Payment.index');
    Route::get('Payment/{id}/show', 'PaymentController@show')->name('Customer.Payment.show');
});
Route::get('/home', 'HomeController@index');

Auth::routes(['register' => false]);
Route::get('test', function () {
    return view('layouts.login_user');
});
