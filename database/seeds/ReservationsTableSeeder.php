<?php

use App\Client;
use App\User;
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
        $user = User::where('email', '=', 'desarrollo@lasmananitas.com.mx')->first();
        $client = Client::first();

        DB::table('reservations')->insert([
            'user_id'    => $user->id,
            'client_id'  => $client->id,
            'credit_card_id' => null,
            'title'      => 'Reservacion',
            'folio'      => 1,
            'checkin'    => Carbon::today(),
            'checkout'   => Carbon::tomorrow(),
            'start'      => Carbon::today(),
            'end'        => Carbon::tomorrow(),
            'notes'      => 'Notas de prueba',
            'total'      => 9000.00,
            'payment_method' => 'deposito',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
