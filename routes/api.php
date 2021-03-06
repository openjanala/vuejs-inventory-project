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

//for Expense
Route::apiResource('/add-expense','Api\ExpenseController');
Route::apiResource('/expenses','Api\ExpenseController');
 
 //for Salary
Route::post('/salary/paid/{id}','Api\SalaryController@Paid');
Route::get('/salary','Api\SalaryController@AllSalary');
Route::get('/salary/view/{id}','Api\SalaryController@ViewSalary');
Route::get('/edit/salary/{id}','Api\SalaryController@EditSalary');
Route::post('/salary/update/{id}','Api\SalaryController@SalaryUpdate');
 
//for Stock
Route::patch('/stock/update/{id}','Api\StockController@StockUpdate');

//for Customer
Route::apiResource('/add-customer','Api\CustomerController');
Route::apiResource('/customers','Api\CustomerController');
 