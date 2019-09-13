<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation_details')->insert([
            [
                'reservation_id' => 1,
                'suite_id' => 1,
                'adults' => 2,
                'children' => 1,
                'subtotal' => 200,
            ],
            [
                'reservation_id' => 1,
                'suite_id' => 2,
                'adults' => 2,
                'children' => 1,
                'subtotal' => 2000,
            ],
        ]);
    }
}
