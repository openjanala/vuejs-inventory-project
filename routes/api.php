<?php



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//for Employees
Route::apiResource('/add-employee','Api\EmployeeController');
Route::apiResource('/employees','Api\EmployeeController');

//for Suppliers
Route::apiResource('/add-supplier','Api\SupplierController');
Route::apiResource('/suppliers','Api\SupplierController');

//for Categories
Route::apiResource('/add-category','Api\CategoryController');
Route::apiResource('/categories','Api\CategoryController');

//for Products
Route::apiResource('/add-product','Api\ProductController');
Route::apiResource('/products','Api\ProductController');

//for Salary
Route::post('/salary/paid/{id}','Api\SalaryController@Paid');