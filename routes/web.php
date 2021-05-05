<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Invoice
Route::get('invoices_list', [App\Http\Controllers\InvoiceController::class, 'show'])->name('invoices_list');
Route::get('add_invoices', [App\Http\Controllers\InvoiceController::class, 'addcreate'])->name('add_invoices');
Route::put('add_invoices', [App\Http\Controllers\InvoiceController::class, 'add'])->name('add_invoices');
Route::get('edit_invoices/{id}', [App\Http\Controllers\InvoiceController::class, 'edit'])->name('edit_invoices');
Route::put('edit_invoices', [App\Http\Controllers\InvoiceController::class, 'update'])->name('edit_invoices');
Route::get('delete_invoices/{id}', [App\Http\Controllers\InvoiceController::class, 'delete'])->name('delete_invoices');

// Estimate
Route::get('estimates_list', [App\Http\Controllers\EstimateController::class, 'show'])->name('estimates_list');
Route::get('add_estimates', [App\Http\Controllers\EstimateController::class, 'addcreate'])->name('add_estimates');
Route::post('add_estimates', [App\Http\Controllers\EstimateController::class, 'add'])->name('add_estimates');
Route::get('edit_estimates/{id}', [App\Http\Controllers\EstimateController::class, 'edit'])->name('edit_estimates');
Route::put('edit_estimates', [App\Http\Controllers\EstimateController::class, 'update'])->name('edit_estimates');
Route::get('delete_estimates/{id}', [App\Http\Controllers\EstimateController::class, 'delete'])->name('delete_invoices');

//Estimate Data
Route::post('edit_estimates_data', [App\Http\Controllers\EstimateDataController::class, 'updateEstimate'])->name('edit_estimates_data');
Route::get('delete_estimates_data/{id}', [App\Http\Controllers\EstimateDataController::class, 'delete'])->name('delete_estimates_data');

//Invoice Data
Route::post('edit_invoices_data', [App\Http\Controllers\InvoiceDataController::class, 'updateInvoice'])->name('edit_invoices_data');
Route::get('delete_invoices_data/{id}', [App\Http\Controllers\InvoiceDataController::class, 'delete'])->name('delete_invoices_data');

// Service
Route::get('services', [App\Http\Controllers\ServiceController::class, 'show'])->name('services');
Route::get('services_edit/{id}', [App\Http\Controllers\ServiceController::class, 'edit'])->name('services_edit');
Route::get('services_delete/{id}', [App\Http\Controllers\ServiceController::class, 'delete'])->name('services_delete');
Route::put('add_services', [App\Http\Controllers\ServiceController::class, 'add'])->name('add_services');
Route::put('services_edit', [App\Http\Controllers\ServiceController::class, 'update'])->name('services_edit');

// Customer
Route::get('customers_list', [App\Http\Controllers\CustomerController::class, 'show'])->name('customers_list');
Route::get('edit_customers/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('edit_customers');
Route::get('delete_customers/{id}', [App\Http\Controllers\CustomerController::class, 'delete'])->name('delete_customers');
Route::put('add_customers', [App\Http\Controllers\CustomerController::class, 'add'])->name('add_customers');
Route::put('edit_customers', [App\Http\Controllers\CustomerController::class, 'update'])->name('edit_customers');

// Payment
Route::get('payments_list', [App\Http\Controllers\PaymentController::class, 'show'])->name('payments_list');
Route::get('edit_payments/{id}', [App\Http\Controllers\PaymentController::class, 'edit'])->name('edit_payments');
Route::get('delete_payments/{id}', [App\Http\Controllers\PaymentController::class, 'delete'])->name('delete_payments');
Route::get('add_payments', [App\Http\Controllers\PaymentController::class, 'addcreate'])->name('add_payments');
Route::put('add_payments', [App\Http\Controllers\PaymentController::class, 'add'])->name('add_payments');
Route::put('edit_payments', [App\Http\Controllers\PaymentController::class, 'update'])->name('edit_payments');

Route::get('payment/{id}', [App\Http\Controllers\PaymentController::class, 'payment'])->name('payment');

// Todo
Route::get('todo_list', [App\Http\Controllers\TodoController::class, 'show'])->name('todo_list');
Route::get('edit_todo/{id}', [App\Http\Controllers\TodoController::class, 'edit'])->name('edit_todo');
Route::get('delete_todo/{id}', [App\Http\Controllers\TodoController::class, 'delete'])->name('delete_todo');
Route::put('add_todo', [App\Http\Controllers\TodoController::class, 'add'])->name('add_todo');
Route::put('edit_todo', [App\Http\Controllers\TodoController::class, 'update'])->name('edit_todo');

// Expance
Route::get('expance_list', [App\Http\Controllers\ExpanceManagerController::class, 'show'])->name('expance_list');
Route::get('edit_expance/{id}', [App\Http\Controllers\ExpanceManagerController::class, 'edit'])->name('edit_expance');
Route::get('delete_expance/{id}', [App\Http\Controllers\ExpanceManagerController::class, 'delete'])->name('delete_expance');
Route::put('add_expance', [App\Http\Controllers\ExpanceManagerController::class, 'add'])->name('add_expance');
Route::put('edit_expance', [App\Http\Controllers\ExpanceManagerController::class, 'update'])->name('edit_expance');

//Invoice Report
Route::get('invoices_report', [App\Http\Controllers\InvoiceController::class, 'showInvoiceReport'])->name('invoices_report');

//Customer Report
Route::get('customers_report', [App\Http\Controllers\CustomerController::class, 'showCustomerReport'])->name('customers_report');

//Payment Report
Route::get('payments_report', [App\Http\Controllers\PaymentController::class, 'showPaymentReport'])->name('payments_report');

//Export Excel Invoice
Route::get('download_invoice_report',[App\Http\Controllers\InvoiceController::class, 'exportInvoiceExcel'])->name('download_invoice_report');

//Export Excel Customer
Route::get('download_customer_report',[App\Http\Controllers\CustomerController::class, 'exportCustomerExcel'])->name('download_customer_report');

//Export Excel Payment
Route::get('download_payment_report',[App\Http\Controllers\PaymentController::class, 'exportPaymentExcel'])->name('download_payment_report');

//Show Invoice
Route::get('show_invoice/{id}',[App\Http\Controllers\InvoiceController::class, 'showInvoice'])->name('show_invoice');

//Show payment
Route::get('show_payment/{id}',[App\Http\Controllers\PaymentController::class, 'showPayment'])->name('show_payment');

//pdf invoice_reprot
Route::get('download_invoice_report_pdf',[App\Http\Controllers\InvoiceController::class, 'downloadInvoiceReportPDF'])->name('download_invoice_report_pdf');

//pdf invoice
Route::get('download_invoice/{id}',[App\Http\Controllers\InvoiceController::class, 'downloadInvoice'])->name('download_invoice');

//pdf customer_report
Route::get('download_customer_report_pdf',[App\Http\Controllers\CustomerController::class, 'CustomerReportDownload'])->name('download_customer_report_pdf');

//pdf payment_report
Route::get('download_payment_report_pdf',[App\Http\Controllers\paymentController::class, 'PaymentReportDownload'])->name('download_payment_report_pdf');

//Mail Invoice
Route::get('send_email/{id}',[App\Http\Controllers\InvoiceController::class, 'sendMail'])->name('send_email');

//Print Invoice
Route::get('print_invoice/{id}',[App\Http\Controllers\InvoiceController::class, 'printInvoice'])->name('print_invoice');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

// User
Route::get('edit/{id}', 'App\Http\Controllers\UserController@edit')->name('edit')->middleware('auth');
Route::get('delete/{id}', 'App\Http\Controllers\UserController@delete')->name('delete')->middleware('auth');
Route::put('add', 'App\Http\Controllers\UserController@add')->name('add')->middleware('auth');
Route::put('edit', 'App\Http\Controllers\UserController@update')->name('edit')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('add', function () {
		return view('users.add');
	})->name('add');
	Route::get('add_services', function () {
		return view('pages.services.add');
	})->name('add_services');
	Route::get('add_customers', function () {
		return view('pages.customers.add_customer');
	})->name('add_customers');
	Route::get('add_todo', function () {
		return view('pages.todo.add_todo');
	})->name('add_todo');
	Route::get('add_expance', function () {
		return view('pages.expancemanager.add_expancemanager');
	})->name('add_expance');
});
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});