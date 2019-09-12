<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rates')->insert([
            [
                'suite_id' => 1,
                'type' => 'rack',
                'price' => 3952,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'bar 1',
                'price' => 3293,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'bar 2',
                'price' => 2744,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'grupal',
                'price' => 2013,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'rack',
                'price' => 5363,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'bar 1',
                'price' => 4469,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'bar 2',
                'price' => 3724,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'grupal',
                'price' => 2732,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
