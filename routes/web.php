<?php

Route::get('/', 'HomeController@index');

Route::get('/request', 'RequestController@makeRequest');
Route::get('/getBookings', 'RequestController@getBookings');

Route::resource('/company', 'CompanyController');
Route::resource('/user', 'UsersController');
Route::resource('/sale', 'SalesController');
Route::resource('/invoice', 'InvoiceController');
Route::resource('/proforma', 'ProformaController');
Route::get('/preview/{id}', 'InvoiceController@preview');
Route::get('/proformaPreview/{$id}', 'ProformaController@generateProforma');
Route::resource('/role', 'RolesController');
Route::resource('/permission', 'PermissionsController');

Auth::routes();