<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

// Route::prefix('ugraiBook')->middleware('auth:api')->group(function(){
//     Route::get('/', 'Api\UgraiController@listOfCustomers');
//     Route::get('/unPaidDuesCustomers', 'Api\UgraiController@unPaidDuesCustomer');
//     Route::get('/edit/{customerId}', 'Api\UgraiController@edit');
//     Route::post('/update', 'Api\UgraiController@update');

// });


// Route::prefix('ugraiBook')->group(function(){
//     Route::get('/', 'Api\UgraiController@listOfCustomers');
//     Route::get('/CustomerswithDues', 'Api\UgraiController@CustomerswithDues');
//     Route::get('/edit/{customerId}', 'Api\UgraiController@edit');
//     Route::post('/update', 'Api\UgraiController@update');
// });


Route::prefix('customers')->group(function(){
    Route::get('/', 'Api\CustomerController@listOfCustomers');
    Route::get('/customerswithDues', 'Api\CustomerController@customerswithDues');
    Route::get('/edit/{customerId}', 'Api\CustomerController@edit');
    Route::post('/update/{id}', 'Api\CustomerController@updatebyid');
});


//Route::prefix('customer')->middleware('auth:api')->group(function(){
//    Route::post('/update/dues', 'Api\CustomerController@updatePaidAmmount');
//});
Route::prefix('customer')->group(function(){
    Route::post('/update/dues', 'Api\CustomerController@updatePaidAmmount');
});


//Route::get('customers', 'Api\CustomerController@CustomerswithDues');
//Route::post('customers', 'Api/CustomerController@update');


//Route::prefix('providers')->middleware('auth:api')->group(function(){
//    Route::get('/', 'Api\ProviderController@listOfProviders');
//});
Route::get('providers', 'Api\ProviderController@listOfProviders');




//Route::prefix('owners')->middleware('auth:api')->group(function(){
//    Route::get('/', 'Api\OwnerController@listOfOwners');
//});
Route::get('owners', 'Api\OwnerController@listOfOwners');


//Route::prefix('trade_marks')->middleware('auth:api')->group(function(){
//    Route::get('/', 'Api\TradeMarkController@listofTradeMarks');
//});
Route::get('trade_marks', 'Api\TradeMarkController@listofTradeMarks');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});