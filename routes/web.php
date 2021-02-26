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

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/worker', 'HomeController@worker');
Route::get('/stockReport', 'HomeController@stockReport');
Route::get('/getStockReport', 'HomeController@getStockReport');
Route::get('/monthlyConsumption', 'HomeController@monthlyConsumption');
Route::get('/getMonthlyConsumption', 'HomeController@getMonthlyConsumption');
Route::get('/deptStockReport', 'HomeController@deptStockReport');
Route::get('/getDeptStockReport', 'HomeController@getDeptStockReport');
Route::get('/multipleMonths', 'HomeController@multipleMonths');
Route::get('/getMultipleReport', 'HomeController@getMultipleReport');
Route::get('/singleMonth', 'HomeController@singleMonth');
Route::get('/getSingleConsumption', 'HomeController@getSingleConsumption');
Route::post('/checkStockReport', 'HomeController@checkStockReport');
Route::post('/checkSingleMonth', 'HomeController@checkSingleMonth');
Route::post('/checkDeptStockReport', 'HomeController@checkDeptStockReport');
Route::post('/checkMultipleReport', 'HomeController@checkMultipleReport');
Route::post('/checkMonthReport', 'HomeController@checkMonthReport');

Route::get('/addworker', 'HomeController@addworker');

Route::get('/adddrug', 'HomeController@adddrug');

Route::get('/drug', 'HomeController@drug');

Route::get('/sales', 'HomeController@sales');

Route::get('/recnum', 'HomeController@recnum');

Route::get('/payment', 'HomeController@payment');

Route::get('/receipt', 'HomeController@receipt');

Route::get('/tendered', 'HomeController@tendered');

Route::get('/rangesales', 'HomeController@rangesales');

Route::get('/profit', 'HomeController@profit');

Route::get('/drugedit/{id}', 'HomeController@drugedit');

Route::get('/drugadd/{id}', 'HomeController@drugadd');

Route::get('/getrec/{id}', 'HomeController@getrec');

Route::get('/drugbreakdown/{id}', 'HomeController@drugbreakdown');

Route::get('/workeredit/{id}', 'HomeController@workeredit');

Route::get('/workerdelete/{id}', 'HomeController@workerdelete');

Route::get('/stock', 'HomeController@stock');

Route::get('/addnewstock', 'HomeController@addnewstock');

Route::post('/enterdrug', 'HomeController@enterdrug');

Route::post('/registerworker', 'HomeController@registerworker');

Route::post('/updatedrug', 'HomeController@updatedrug');

Route::post('/updateworker', 'HomeController@updateworker');

Route::post('/addstock', 'HomeController@addstock');

Route::get('/stockadd/{id}', 'HomeController@stockadd');

Route::get('/stockedit/{id}', 'HomeController@stockedit');

Route::get('/stockbreakdown/{id}', 'HomeController@stockbreakdown');

Route::get('/breakdown', 'HomeController@breakdown');

Route::get('/recall', 'HomeController@recall');

Route::get('/report', 'HomeController@report');

Route::get('/thereport', 'HomeController@thereport');

Route::get('/return', 'HomeController@return');

Route::get('/thereturn', 'HomeController@thereturn');

Route::get('/order/{id}', 'HomeController@order');

Route::post('/sale_enter', 'HomeController@sale_enter');

Route::post('/updatestock', 'HomeController@updatestock');

Route::post('/checkreturn', 'HomeController@checkreturn');

Route::post('/searchrec', 'HomeController@searchrec');

Route::post('/enterstock', 'HomeController@enterstock');

Route::post('/entertendered', 'HomeController@entertendered');
Route::post('/enterDetails', 'HomeController@enterDetails');

Route::post('/checkprofit', 'HomeController@checkprofit');

Route::post('/stockenter', 'HomeController@stockenter');

Route::post('/orderenter', 'HomeController@orderenter');

Route::post('/checkbreakdown', 'HomeController@checkbreakdown');

Route::post('/checkreport', 'HomeController@checkreport');

Route::post('/checkpres', 'HomeController@checkpres');

Route::post('/returndrugs', 'HomeController@returndrugs');

Route::get('/live_search/action', 'HomeController@action')->name('live_search.action');