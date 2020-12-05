<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Slot;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $slots = [
            [
                "start_time" => '10:00',
                "end_time" => '11:00'
            ],

            [
                "start_time" => '11:00',
                "end_time" => '12:00'
            ],

            [
                "start_time" => '13:00',
                "end_time" => '14:00'
            ],

            [
                "start_time" => '14:00',
                "end_time" => '15:00'
            ],

            [
                "start_time" => '15:00',
                "end_time" => '16:00'
            ],

            [
                "start_time" => '16:00',
                "end_time" => '17:00'
            ],

            [
                "start_time" => '17:00',
                "end_time" => '18:00'
            ],

            [
                "start_time" => '18:00',
                "end_time" => '19:00'
            ],

            [
                "start_time" => '19:00',
                "end_time" => '20:00'
            ],


        ];

        foreach ($slots as $slot) {
            Slot::create(
                $slot
            );
        }

        foreach (Slot::all() as $time) {
            $rooms = Room::pluck('id');
            $time->rooms()->attach($rooms);
        }
    }
}
