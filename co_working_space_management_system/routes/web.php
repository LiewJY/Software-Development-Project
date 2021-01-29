<?php

use Illuminate\Support\Facades\Route;

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

Route::get("/locations/details{id}", \App\Http\Livewire\Customer\LocationDetails::class)->name('locationDetails');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/reservationinvoice/{id}', [InvoiceController::class, 'reservation'])->name('printreservation');

    Route::middleware(['admin'])->group(function () {

        Route::get("/adminlocation", \App\Http\Livewire\Admin\LocationTable::class)->name('adminlocation');

        Route::get("/adminmaintenance", \App\Http\Livewire\Admin\Maintenances::class)->name('maintenance');

        Route::get("/adminmembership-plans", \App\Http\Livewire\Admin\MembershipPlans::class)->name('membership-plans');

        Route::get("/adminreport", \App\Http\Livewire\Admin\BusinessReport::class)->name('business-report');

        Route::get("/adminemployee", \App\Http\Livewire\Admin\Staff::class)->name('Staff');

        Route::get("/adminrooms", \App\Http\Livewire\Admin\Rooms::class)->name('adminrooms');

        Route::get("/adminreservation", \App\Http\Livewire\Admin\Reservations::class)->name('adminreservation');

        Route::get("/admincustomer", \App\Http\Livewire\Admin\Customers::class)->name('admincustomer');
    });

    Route::middleware(['employee'])->group(function () {

        Route::get("/employeecustomer", \App\Http\Livewire\Employee\Customers::class)->name('employeecustomer');

        Route::get("/employeereservation", \App\Http\Livewire\Employee\Reservations::class)->name('reservation');

        Route::get("/employeereservationlocation/location{id}", \App\Http\Livewire\Employee\ReservationLocation::class)->name('reservationlocation');

        Route::get("/employeeemployeemaintenance", \App\Http\Livewire\Employee\Maintenances::class)->name('employeemaintenance');

        Route::get("/employeemaintenance/location{id}", \App\Http\Livewire\Employee\MaintenanceRoom::class)->name('employeeroom');
    });

    Route::middleware(['customer'])->group(function () {

        Route::get("/membershipplans/plans{id}", \App\Http\Livewire\Customer\MembershipPlans::class)->name('membershipPlans');

        Route::get("/bookings", \App\Http\Livewire\Customer\Bookings::class)->name('bookings');
        
        Route::get("/subscriptionhistory", \App\Http\Livewire\Customer\Subscriptionhistory::class)->name('subscriptionhistory');

        Route::get("/bookinghistory", \App\Http\Livewire\Customer\BookingHistory::class)->name('bookinghistory');

        Route::get('/membershipinvoice/{id}', [InvoiceController::class, 'membership'])->name('printmembership');
    });
});
