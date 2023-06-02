<?php

use Illuminate\Database\Seeder;

class DefaultSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sensors')->insert([
            'id' => env('DEFAULT_TEST_SENSOR_ID'),
            'company_id' => env('DEFAULT_ADMIN_COMPANY_ID'),
            'description' => env('DEFAULT_TEST_SENSOR_NAME'),
        ]);
    }
}
