<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\Reservation;
use App\Models\MembershipPayment;


class InvoiceController extends Controller
{
    public function reservation($id)
    {
        $reservations = Reservation::findorFail($id);
        $customer = new Buyer([
            'name' => $reservations->reservationpayment->customer['first_name'] . ' ' . $reservations->reservationpayment->customer['last_name'],
            'custom_fields' => [
                'email' => $reservations->reservationpayment->customer->user->email,
                'contact number' => $reservations->reservationpayment->customer->contact_number,
            ],
        ]);
        $item = (new InvoiceItem())->title($reservations->room['name'] . ', ' . $reservations->room->location['name'] . ', ' . $reservations['reservation_date'] . ', from ' . $reservations->slot['start_time'] . ' to ' . $reservations->slot['end_time'])
                ->pricePerUnit($reservations->room->price);
        
        $invoice = Invoice::make()
            ->logo(public_path('vendor/invoices/logo.png'))
            ->name("Reservation Invoice")
            ->buyer($customer)
            ->addItem($item);

        return $invoice->stream();
    }

    public function membership($id)
    {
        $membershipsPayment = MembershipPayment::findorFail($id);
        $customer = new Buyer([
            'name' => $membershipsPayment->user->customer['first_name'] . ' ' . $membershipsPayment->user->customer['last_name'],
            'custom_fields' => [
                'email' => $membershipsPayment->user->customer->email,
                'contact number' => $membershipsPayment->user->customer->contact_number,
            ],
        ]);
        $item = (new InvoiceItem())->title($membershipsPayment->membership['name'] . ' Plan (30 days subscription)')
                ->pricePerUnit($membershipsPayment->membership->price);
        
        $invoice = Invoice::make()
            ->logo(public_path('vendor/invoices/logo.png'))
            ->name("Membership Invoice")
            ->buyer($customer)
            ->addItem($item);

        return $invoice->stream();
    }
}
