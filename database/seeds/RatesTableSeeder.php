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
                'price' => 3387,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'bar 1',
                'price' => 2823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'bar 2',
                'price' => 2352,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 1,
                'type' => 'grupal',
                'price' => 1726,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'rack',
                'price' => 3387,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'bar 1',
                'price' => 2823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'bar 2',
                'price' => 2352,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 2,
                'type' => 'grupal',
                'price' => 1726,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 3,
                'type' => 'rack',
                'price' => 3387,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 3,
                'type' => 'bar 1',
                'price' => 2823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 3,
                'type' => 'bar 2',
                'price' => 2352,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 3,
                'type' => 'grupal',
                'price' => 1726,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 4,
                'type' => 'rack',
                'price' => 3387,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 4,
                'type' => 'bar 1',
                'price' => 2823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 4,
                'type' => 'bar 2',
                'price' => 2352,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 4,
                'type' => 'grupal',
                'price' => 1726,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 5,
                'type' => 'rack',
                'price' => 3387,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 5,
                'type' => 'bar 1',
                'price' => 2823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 5,
                'type' => 'bar 2',
                'price' => 2352,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 5,
                'type' => 'grupal',
                'price' => 1726,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 6,
                'type' => 'rack',
                'price' => 3387,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 6,
                'type' => 'bar 1',
                'price' => 2823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 6,
                'type' => 'bar 2',
                'price' => 2352,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 6,
                'type' => 'grupal',
                'price' => 1726,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 7,
                'type' => 'rack',
                'price' => 2823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 7,
                'type' => 'bar 1',
                'price' => 2352,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 7,
                'type' => 'bar 2',
                'price' => 1960,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 7,
                'type' => 'grupal',
                'price' => 1438,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 8,
                'type' => 'rack',
                'price' => 2823,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 8,
                'type' => 'bar 1',
                'price' => 2352,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 8,
                'type' => 'bar 2',
                'price' => 1960,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 8,
                'type' => 'grupal',
                'price' => 1438,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 9,
                'type' => 'rack',
                'price' => 2258,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 9,
                'type' => 'bar 1',
                'price' => 1882,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 9,
                'type' => 'bar 2',
                'price' => 1568,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 9,
                'type' => 'grupal',
                'price' => 1151,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 10,
                'type' => 'rack',
                'price' => 2258,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 10,
                'type' => 'bar 1',
                'price' => 1882,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 10,
                'type' => 'bar 2',
                'price' => 1568,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 10,
                'type' => 'grupal',
                'price' => 1151,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 11,
                'type' => 'rack',
                'price' => 5363,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 11,
                'type' => 'bar 1',
                'price' => 4469,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 11,
                'type' => 'bar 2',
                'price' => 3724,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 11,
                'type' => 'grupal',
                'price' => 2732,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 12,
                'type' => 'rack',
                'price' => 5363,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 12,
                'type' => 'bar 1',
                'price' => 4469,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 12,
                'type' => 'bar 2',
                'price' => 3724,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 12,
                'type' => 'grupal',
                'price' => 2732,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 13,
                'type' => 'rack',
                'price' => 5363,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 13,
                'type' => 'bar 1',
                'price' => 4469,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 13,
                'type' => 'bar 2',
                'price' => 3724,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 13,
                'type' => 'grupal',
                'price' => 2732,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 14,
                'type' => 'rack',
                'price' => 2952,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 14,
                'type' => 'bar 1',
                'price' => 3293,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 14,
                'type' => 'bar 2',
                'price' => 2744,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'suite_id' => 14,
                'type' => 'grupal',
                'price' => 2013,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
