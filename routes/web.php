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

Route::get('/', 'Auth\AuthController@index')->name('auth.login-page');
Route::post('/login', 'Auth\AuthController@login')->name('auth.login');
Route::get('/logout', 'Auth\AuthController@logout')->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/employee', 'EmployeeController@index')->name('employee.list');
    Route::get('/employee/create', 'EmployeeController@create')->name('employee.create');
    Route::post('/employee', 'EmployeeController@store')->name('employee.store');
    Route::get('/employee/{id}', 'EmployeeController@show')->name('employee.show');
    Route::get('/employee/{id}/edit', 'EmployeeController@edit')->name('employee.edit');
    Route::patch('/employee/{id}', 'EmployeeController@update')->name('employee.update');
    Route::delete('/employee/{id}', 'EmployeeController@destroy')->name('employee.destroy');
});