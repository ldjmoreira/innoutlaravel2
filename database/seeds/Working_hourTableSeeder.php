<?php

use Illuminate\Database\Seeder;

class Working_hourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('working_hours')->insert(
            [
                'user_id'=>'1',
                'work_date' => '2021-01-02',
                'time1' => '08:00:00',
                'time2' => '12:00:00',
                'time3' => '13:00:00',
                'time4' => '17:00:00',
                'worked_time'=>'28800',
            ]
            );
    }
}
