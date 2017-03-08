<?php

Route::get('/', 'HomeController@index');
Route::get('/desk-sales', 'HomeController@deskOrders');
Route::get('/remove-duplicates/{id}', 'SalesController@removeDuplicates');

Route::get('/request', 'RequestController@makeRequest');
Route::get('/getBookings', 'RequestController@getBookings');
Route::get('/getCustomer', 'RequestController@getCustomer');
Route::get('/getDeskSales', 'RequestController@getDeskSales');
Route::get('/update-tc/{id}', 'RequestController@getTcKimlik');
Route::get('/updateCustomer/{id}', 'RequestController@singleCustomer');
Route::get('/updateBooking/{id}', 'RequestController@singleBooking');

Route::resource('/company', 'CompanyController');
Route::resource('/user', 'UsersController');
Route::resource('/sale', 'SalesController');
Route::resource('/invoice', 'InvoiceController');
Route::resource('/proforma', 'ProformaController');
Route::get('/preview/{id}', 'InvoiceController@preview');
Route::get('/proforma-preview/{id}', 'ProformaController@generateProforma');
Route::get('/generated-proformas', 'ProformaController@generatedList');
Route::resource('/role', 'RolesController');
Route::resource('/permission', 'PermissionsController');

Route::get('/generate-matrah', 'LinkReportController@generate');
Route::get('/generate-kdv', 'LinkReportController@generateKDV');
Route::get('/generate-total-report', 'LinkReportController@generateTotal');

Auth::routes();