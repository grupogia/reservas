<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SuiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suites')->insert([
            [
                'title' => 'TULIPAN',
                'number' => 2,
                'bed_number' => 1,
                'bed_type' => 'King',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'TULIPAN',
                'number' => 5,
                'bed_number' => 1,
                'bed_type' => 'King',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'TULIPAN',
                'number' => 8,
                'bed_number' => 1,
                'bed_type' => 'King',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'TULIPAN',
                'number' => 9,
                'bed_number' => 1,
                'bed_type' => 'King',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'TULIPAN',
                'number' => 10,
                'bed_number' => 1,
                'bed_type' => 'King',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'TULIPAN',
                'number' => 15,
                'bed_number' => 1,
                'bed_type' => 'King',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'ORQUIDIA',
                'number' => 3,
                'bed_number' => 1,
                'bed_type' => 'Queen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'ORQUIDIA',
                'number' => 7,
                'bed_number' => 1,
                'bed_type' => 'Queen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'BUGAMBILEAS',
                'number' => 4,
                'bed_number' => 1,
                'bed_type' => 'Matri',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'BUGAMBILEAS',
                'number' => 12,
                'bed_number' => 1,
                'bed_type' => 'Matri',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'VILLA',
                'number' => 6,
                'bed_number' => 2,
                'bed_type' => 'Queen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'VILLA',
                'number' => 14,
                'bed_number' => 2,
                'bed_type' => 'Queen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'VILLA',
                'number' => 16,
                'bed_number' => 2,
                'bed_type' => 'Queen',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'NUPCIAL',
                'number' => 11,
                'bed_number' => 1,
                'bed_type' => 'King',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
