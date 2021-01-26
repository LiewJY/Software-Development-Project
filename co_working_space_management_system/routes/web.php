<?php

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\InvoiceController;


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

//GENERAL
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

//ADMIN
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
Route::get('/adminreservation', function () {
    return view('admin.reservation');
})->name('adminreservation');
//ok

//EMPLOYEE
Route::get('/employeecustomer', function () {
    return view('employee.customer');
})->name('employeecustomer');
//ok
Route::get('/reservation', function () {
    return view('employee.reservation');
})->name('reservation');
//ok
Route::get('/reservationlocation/location{id}', function ($id) {
    return view('employee.reservationLocation', compact('id'));
})->name('reservationlocation');


Route::get('/employeemaintenance', function () {
    return view('employee.maintenance');
})->name('employeemaintenance');
//ok
Route::get('/employeemaintenance/location{id}', function ($id) {
    return view('employee.maintenanceRoom', compact('id'));
})->name('employeeroom');
//ok

//CUSTOMER
Route::get('/membershipplans/plans{id}', function ($id) {
    return view('customer.membershipPlans', compact('id'));
})->name('membershipPlans');

Route::get('/locations/details{id}', function ($id) {
    return view('customer.locationDetails', compact('id'));
})->name('locationDetails');

Route::get('/customerbookings', function () {
    return view('customer.bookings');
})->name('bookings');

//for invoice
// Route::get('/membershipinvoice', [InvoiceController::class, 'member']);

Route::get('/reservationinvoice/{id}', [InvoiceController::class, 'reservation'])
->name('printreservation');
//this does not work
// Route::get('/reservationinvoice/{id}', function ($id) {
//     return view([InvoiceController::class, 'reservation'], compact('id'));
// })->name('printreservation');


Route::get('/test', function () {
    $state = [];

        $state = User::with("customer")->find(3)->toArray();


    dd($state);
});