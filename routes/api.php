<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('loantypes', 'LoanTypesController@create'); // create record.
Route::get('loantypes', 'LoanTypesController@getAllLoantypes'); // get all records.
Route::get('loantypes/{id}', 'LoanTypesController@getLoanType'); // fetch indiviual record.
Route::put('loantypes/{id}', 'LoanTypesController@update'); // update record. 
Route::delete('loantypes/{id}','LoanTypesController@destroy'); //delete


Route::post('loanplans', 'LoanPlansController@create'); // create record.
Route::get('loanplans', 'LoanPlansController@getAllLoanPlantypes'); // get all records.
Route::get('loanplans/{id}', 'LoanPlansController@getLoanPlanType'); // fetch indiviual record.
Route::put('loanplans/{id}', 'LoanPlansController@update'); // update record. 
Route::delete('loanplans/{id}','LoanPlansController@destroy'); //delete

Route::post('borrowers', 'BorrowersController@create'); // create record.
Route::get('borrowers', 'BorrowersController@getAllBorrowers'); // get all records.
Route::get('borrowers/{id}', 'BorrowersController@getBorrower'); // fetch indiviual record.
Route::put('borrowers/{id}', 'BorrowersController@update'); // update record. 
Route::delete('borrowers/{id}','BorrowersController@destroy'); //delete

Route::post('borrowers', 'BorrowersController@create'); // create record.
Route::get('borrowers', 'BorrowersController@getAllBorrowers'); // get all records.
Route::get('borrowers/{id}', 'BorrowersController@getBorrower'); // fetch indiviual record.
Route::put('borrowers/{id}', 'BorrowersController@update'); // update record. 
Route::delete('borrowers/{id}','BorrowersController@destroy'); //delete

Route::post('loans', 'LoansController@create'); // create record.
Route::get('loans', 'LoansController@getAllLoans'); // get all records.
Route::get('loans/{id}', 'LoansController@getLoan'); // fetch indiviual record.
Route::put('loans/{id}', 'LoansController@update'); // update record. 
Route::delete('loans/{id}','LoansController@destroy'); //delete

Route::get('loancalc/{id}','LoansController@calculation');

Route::post('payments', 'PaymentsController@create'); // create record.
Route::get('payments', 'PaymentsController@getAllPayments'); // get all records.
Route::get('payments/{id}', 'PaymentsController@getPayment'); // fetch indiviual record.
Route::put('payments/{id}', 'PaymentsController@update'); // update record. 
Route::delete('payments/{id}','PaymentsController@destroy'); //delete
