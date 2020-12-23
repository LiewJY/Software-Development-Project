<?php

use App\Models\Employee;
use App\Models\User;
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
    return view('index');
})->name('index');
Route::get('/locations', function () {
    return view('locations');
})->name('locations');
Route::get('/membershipplans', function () {
    return view('membershipPlans');
})->name('membershipplans');
Route::get('/contactus', function () {
    return view('contactUs');
})->name('contactus');
Route::get('/aboutus', function () {
    return view('aboutUs');
})->name('aboutus');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/adminlocation', function () {
    return view('admin.location');
})->name('adminlocation');

Route::get('/adminrooms', function () {
    return view('admin.rooms');
})->name('adminrooms');
