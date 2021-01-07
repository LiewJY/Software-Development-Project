<?php

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;

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
//ok
Route::get('/adminmaintenance', function () {
    return view('admin.maintenance');
})->name('maintenance');
//ok
Route::get('/adminmembership-plans', function () {
    return view('admin.membership-plans');
})->name('membership-plans');
//ok
Route::get('/adminreport', function () {
    return view('admin.businessReport');
})->name('business-report');
//ok need to have data to check
Route::get('/adminstaff', function () {
    return view('admin.staff');
})->name('Staff');
//ok
Route::get('/adminrooms', function () {
    return view('admin.rooms');
})->name('adminrooms');
//ok

Route::get('/employeecustomer', function () {
    return view('employee.customer');
})->name('employeecustomer');
//ok
Route::get('/reservation', function () {
    return view('employee.reservation');
})->name('reservation');
//
Route::get('/employeemaintenance', function () {
    return view('employee.maintenance');
})->name('maintenance');
//ok
Route::get('/employeemaintenance/location{id}', function ($id) {
    return view('employee.maintenanceRoom', compact('id'));
})->name('employeeroom');
//ok
