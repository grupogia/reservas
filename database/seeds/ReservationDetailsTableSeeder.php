<?php

use App\Reservation;
use App\Suite;
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
                'reservation_id' => Reservation::first()->id,
                'suite_id'  => Suite::where('number', '=', 2)->first()->id,
                'adults'    => 2,
                'rate_type' => 'rack',
                'children'  => 1,
                'subtotal'  => 3387,
            ],
            [
                'reservation_id' => Reservation::first()->id,
                'suite_id'  => Suite::where('number', '=', 5)->first()->id,
                'adults'    => 2,
                'rate_type' => 'rack',
                'children'  => 1,
                'subtotal'  => 3387
            ],
        ]);
    }
}
