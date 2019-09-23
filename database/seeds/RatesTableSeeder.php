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
                'price' => 2340,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'bar 1',
                'price' => 1950,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'bar 2',
                'price' => 1625,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'grupal',
                'price' => 1070,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'rack',
                'price' => 2340,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'bar 1',
                'price' => 1950,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'bar 2',
                'price' => 1625,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'grupal',
                'price' => 1070,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 3,
                'type' => 'rack',
                'price' => 2340,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 3,
                'type' => 'bar 1',
                'price' => 1950,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 3,
                'type' => 'bar 2',
                'price' => 1625,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 3,
                'type' => 'grupal',
                'price' => 1070,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 4,
                'type' => 'rack',
                'price' => 2340,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 4,
                'type' => 'bar 1',
                'price' => 1950,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 4,
                'type' => 'bar 2',
                'price' => 1625,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 4,
                'type' => 'grupal',
                'price' => 1070,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 5,
                'type' => 'rack',
                'price' => 2340,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 5,
                'type' => 'bar 1',
                'price' => 1950,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 5,
                'type' => 'bar 2',
                'price' => 1625,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 5,
                'type' => 'grupal',
                'price' => 1070,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 6,
                'type' => 'rack',
                'price' => 2340,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 6,
                'type' => 'bar 1',
                'price' => 1950,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 6,
                'type' => 'bar 2',
                'price' => 1625,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 6,
                'type' => 'grupal',
                'price' => 1070,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 7,
                'type' => 'rack',
                'price' => 1950,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 7,
                'type' => 'bar 1',
                'price' => 1625,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 7,
                'type' => 'bar 2',
                'price' => 1354,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 7,
                'type' => 'grupal',
                'price' => 975,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 8,
                'type' => 'rack',
                'price' => 1950,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 8,
                'type' => 'bar 1',
                'price' => 1625,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 8,
                'type' => 'bar 2',
                'price' => 1354,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 8,
                'type' => 'grupal',
                'price' => 975,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 9,
                'type' => 'rack',
                'price' => 1560,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 9,
                'type' => 'bar 1',
                'price' => 1300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 9,
                'type' => 'bar 2',
                'price' => 1083,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 9,
                'type' => 'grupal',
                'price' => 780,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 10,
                'type' => 'rack',
                'price' => 1560,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 10,
                'type' => 'bar 1',
                'price' => 1300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 10,
                'type' => 'bar 2',
                'price' => 1083,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 10,
                'type' => 'grupal',
                'price' => 780,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 11,
                'type' => 'rack',
                'price' => 3705,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 11,
                'type' => 'bar 1',
                'price' => 3088,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 11,
                'type' => 'bar 2',
                'price' => 2573,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 11,
                'type' => 'grupal',
                'price' => 1853,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 12,
                'type' => 'rack',
                'price' => 3705,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 12,
                'type' => 'bar 1',
                'price' => 3088,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 12,
                'type' => 'bar 2',
                'price' => 2573,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 12,
                'type' => 'grupal',
                'price' => 1853,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 13,
                'type' => 'rack',
                'price' => 3705,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 13,
                'type' => 'bar 1',
                'price' => 3088,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 13,
                'type' => 'bar 2',
                'price' => 2573,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 13,
                'type' => 'grupal',
                'price' => 1853,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 14,
                'type' => 'rack',
                'price' => 2730,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 14,
                'type' => 'bar 1',
                'price' => 2275,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 14,
                'type' => 'bar 2',
                'price' => 1896,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 14,
                'type' => 'grupal',
                'price' => 1365,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
