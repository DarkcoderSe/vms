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


Route::redirect('/', '/login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('profile')->middleware('auth')->group(function(){
    Route::get('/', 'ProfileController@edit');
    Route::post('/', 'ProfileController@update')->name('profile.update');
    Route::post('/password', 'ProfileController@password')->name('profile.password');
});

Route::prefix('tempBook')->middleware('auth')->group(function(){
    Route::get('/', 'TempBookController@index');
    Route::get('/create', 'TempBookController@create');
    Route::get('/edit/{id}', 'TempBookController@edit');
     Route::get('/delete/{id}', 'TempBookController@delete');
    Route::post('/submit', 'TempBookController@submit');
    Route::post('/update', 'TempBookController@update');

    Route::prefix('cart')->group(function(){
        Route::post('/update', 'TempBookController@updateCartItem');
        Route::get('/delete/{id}/{tempBookId}', 'TempBookController@deleteCartItem');
    });
});

Route::prefix('customer')->middleware('auth')->group(function(){
    Route::get('/get/{name}', 'CustomerController@getAJAXCustomers');
    Route::get('/first/{phoneNo}', 'CustomerController@getAJAXCustomers');

    Route::get('/', 'CustomerController@index');
    Route::get('/edit/{id}', 'CustomerController@edit');
    Route::post('/update', 'CustomerController@update');

});
Route::prefix('cashBook')->group(function(){
    Route::get('/', 'CashFlowController@index');
    // Route::get('/delete/{id}', 'CashFlowController@delete');
});
Route::prefix('provider')->middleware('auth')->group(function(){
    Route::get('/', 'ProviderController@index');
    Route::get('/create', 'ProviderController@create');
    Route::get('/edit/{id}', 'ProviderController@edit')->name("providerEdit");
    Route::get('/delete/{id}', 'ProviderController@delete');
    Route::post('/submit', 'ProviderController@submit');
    Route::post('/update', 'ProviderController@update');

    Route::prefix('tradeMark')->group(function(){
        Route::post('/update', 'ProviderController@tradeMarkUpdate');

        Route::prefix('truck')->group(function(){
            Route::post('/submit', 'ProviderController@truckSubmit');
            Route::get('/delete/{id}', 'ProviderController@truckDelete');
        });
        Route::prefix('foodType')->group(function(){
            Route::get('/create/{id}', 'FoodTypeController@create');
            Route::get('/edit/{id}', 'FoodTypeController@edit');
            Route::get('/delete/{id}', 'FoodTypeController@delete');
            Route::post('/submit', 'FoodTypeController@submit');
            Route::post('/update', 'FoodTypeController@update');

            Route::get('/get/{id}', 'FoodTypeController@getAJAXFoodTypes');
            Route::get('/first/{id}', 'FoodTypeController@getAJAXFoodType');

        });
    });

    Route::prefix('bikri')->group(function(){
        Route::get('/{id}', 'BikriController@index');
        Route::post('/submit', 'BikriController@submit');

    });
});

Route::prefix('owner')->middleware('auth')->group(function(){
    Route::get('/', 'OwnerController@index');
    Route::get('/create', 'OwnerController@create');
    Route::get('/edit/{id}', 'OwnerController@edit');
    Route::get('/delete/{id}', 'OwnerController@delete');
    Route::post('/submit', 'OwnerController@submit');
    Route::post('/update', 'OwnerController@update');
    Route::get('/updateTransaction/{id}', 'OwnerController@transaction_page')->name("updateTransaction");
    Route::post('/saveTransaction', 'OwnerController@calculate_transactions')->name("calculate_transactions");
    Route::get('/transactionHistory', 'OwnerController@indexTransactions')->name("transactionHistory");
});

Route::prefix('agent')->middleware('auth')->group(function(){
    Route::get('/','agentController@index')->name("index");
    Route::get('/create','agentController@create')->name("create");
    Route::post('/store','agentController@store')->name("store");
    Route::get('/delete/{id}','agentController@destroy')->name("agent.destroy"); 
});