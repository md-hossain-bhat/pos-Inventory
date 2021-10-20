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
    return view('welcome');
});

Route::prefix('/admin')->namespace('Admin')->group(function(){


 Route::match(['get','post'],'/', 'AdminController@login');


 Route::group(['middleware' => ['admin']], function () {
 	
  Route::get('/dashboard', 'AdminController@dashboard');
  Route::get('/setting', 'AdminController@settings');
  Route::post('/check-pwd','AdminController@chkPassword');
  Route::post('/update-pwd','AdminController@updatePassword');
  Route::match(['get','post'],'/admin-details','AdminController@adminDetails');
  Route::get('/logout', 'AdminController@logout');

  //user 
    Route::get('/admins', 'AdminController@admins');
    Route::post('/update-admin-status','AdminController@updateAdminStatus');
    Route::match(['get','post'],'/add-admin','AdminController@addAdmin');
    Route::match(['get', 'post'],'/edit-admin/{id}','AdminController@editAdmin');
    Route::get('delete-admin/{id}','AdminController@deleteAdmin');
    Route::get('delete-image/{id}','AdminController@deleteUserImage');

    //suppliers
    Route::get('/suppliers', 'SupplierController@Suppliers');
    Route::post('/update-supplier-status','SupplierController@updateSupplierStatus');
    Route::match(['get','post'],'/add-edit-supplier/{id?}','SupplierController@AddEditSupplier');
    Route::get('delete-supplier/{id}','SupplierController@deleteSupplier');
    //customer
    Route::get('/customers', 'CustomerController@Customers');
    Route::match(['get','post'],'/add-edit-customer/{id?}','CustomerController@AddEditCustomer');
    Route::get('delete-customer/{id}','CustomerController@deleteCustomer');
    Route::get('/cradit', 'CustomerController@craditCustomer');
    Route::get('/cradit-pdf', 'CustomerController@craditCustomerPdf');
    
    Route::get('/invoice-edit/{invoice_id}','CustomerController@invoiceEdit');
    Route::post('/invoice-update/{invoice_id}','CustomerController@invoiceUpdate');
    Route::get('/invoice-details/pdf/{invoice_id}','CustomerController@invoiceDetailsPdf');
    Route::get('/paid', 'CustomerController@paidCustomer');
    Route::get('/paid-pdf', 'CustomerController@paidCustomerPdf');
    Route::get('/customer/wise/report', 'CustomerController@customerWiseReport');
    Route::get('/cradit/report/pdf', 'CustomerController@craditReportPdf');
    Route::get('/paid/report/pdf', 'CustomerController@paidReportPdf');
    //units
    Route::get('/units', 'UnitController@units');
    Route::match(['get','post'],'/add-edit-unit/{id?}','UnitController@AddEditUnit');
    Route::get('delete-unit/{id}','UnitController@deleteUnit');
    //categories
    Route::get('/categories','CategoryController@categories');
    Route::match(['get','post'],'/add-edit-category/{id?}','CategoryController@AddEditCategory');
    Route::get('delete-category/{id}','CategoryController@deleteCategory');
    //products
    Route::get('/products','ProductController@products');
    Route::match(['get','post'],'/add-edit-product/{id?}','ProductController@AddEditProduct');
    Route::get('delete-product/{id}','ProductController@deleteProduct');
    //purchases
    Route::get('/purchases','PurchaseController@purchases');
    Route::match(['get','post'],'/add-purchase','PurchaseController@AddPurchase');
    Route::get('delete-purchase/{id}','PurchaseController@deletePurchase');
    Route::get('/pandding','PurchaseController@panddingList');
    Route::get('approve-purchase/{id}','PurchaseController@approvePurchase');
    Route::get('/daly-purchases-report','PurchaseController@DalyPurchasesReport');
    Route::get('/daly-purchases-report-pdf','PurchaseController@DalyPurchasesReportPdf');
    //invoice
    Route::get('/invoice','InvoiceController@Invoice');
    Route::match(['get','post'],'/add-invoice','InvoiceController@AddInvoice');
    Route::match(['get','post'],'/store-invoice','InvoiceController@StoreInvoice');
    Route::get('delete-invoice/{id}','InvoiceController@deleteInvoice');
    Route::get('/pandding-invoice','InvoiceController@panddingInvoiceList');
    Route::get('approve-invoice/{id}','InvoiceController@approveInvoice');
    Route::post('aprpoval-store/{id}','InvoiceController@approvalStore');
    Route::get('print-invoice-list/','InvoiceController@printInvoiceList');
    Route::get('print-invoice/{id}','InvoiceController@printInvoice');
    Route::get('daly-report-invoice','InvoiceController@dalyReportInvoice');
    Route::get('daly-report-invoice-pdf','InvoiceController@dalyReportInvoicePdf');
    //defult controller 
    Route::get('/get-category','DefaultController@getCategory')->name('get-category');
    Route::get('/get-product','DefaultController@getProduct')->name('get-product');
    Route::get('/check-product-stock','DefaultController@getStock')->name('check-product-stock');
    //stock 
    Route::get('stock-report','StockController@StockReport');
    Route::get('stock-report-pdf','StockController@StockReportPdf');
    Route::get('stock-supplier-product-wise','StockController@StockSupplierProductWise');
    Route::get('stock-supplier-wise-pdf','StockController@StockSupplierWisePdf');
    Route::get('stock-product-wise-pdf','StockController@StockProductWisePdf');
});

});



Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
