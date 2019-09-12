<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            'user_id' => 1,
            'resourceId' => 1,
            'client_id' => 1,
            'title' => 'Reservacion',
            'folio' => 1,
            'checkin' => Carbon::today(),
            'checkout' => Carbon::tomorrow(),
            'payment_method' => 'Tarjeta',
            'start' => Carbon::today(),
            'end' => Carbon::tomorrow(),
            'notes' => 'Notas de prueba',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
