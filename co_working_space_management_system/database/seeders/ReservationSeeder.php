<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Reservation;
use App\Models\ReservationPayment;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ms_MY');
        $customer = Customer::pluck('id');
        $rooms = Room::with('slots')->get();


        foreach (range(5, 10) as $index) {

            $year  = rand(2020, 2021);
            $month = rand(1, 12);
            $day = rand(1, 28);


            $date = Carbon::create($year, $month, $day);

            foreach ($rooms as $room) {
                $payment = ReservationPayment::create([
                    'created_at' => $date,
                    'updated_at' => $date,
                    'customer_id' => $faker->randomElement($customer),
                    'amount' => $room->price
                ]);

                $slots = [];

                foreach ($room->slots as $slot) {
                    array_push($slots, $slot->id);
                }

                $reservation = Reservation::create([
                    'room_id' => $room->id,
                    'slot_id' => $faker->randomElement($slots),
                    'reservation_date' => $date,
                ]);

                $payment->reservation()->save($reservation);
            }
        }
    }
}
