<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeSeeder extends Seeder
{
    public function run()
    {
        // Define the 7 days of the week
        $days = [
            ['name' => 'Saturday', 'day' => '1'],
            ['name' => 'Sunday', 'day' => '2'],
            ['name' => 'Monday', 'day' => '3'],
            ['name' => 'Tuesday', 'day' => '4'],
            ['name' => 'Wednesday', 'day' => '5'],
            ['name' => 'Thursday', 'day' => '6'],
            ['name' => 'Friday', 'day' => '7'],
           
        ];
        $timestamp = Carbon::now();
        // Loop through the days and insert them into the 'times' table
        foreach ($days as $day) {
            DB::table('times')->insert([
                'name' => $day['name'],
                'day' => $day['day'],
                'start_time' => null,
                'end_time' => null,
                'is_opened' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}
