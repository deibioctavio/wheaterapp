<?php

use Illuminate\Database\Seeder;

class DefaultCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'id' => env('DEFAULT_ADMIN_COMPANY_ID'),
            'name' => env('DEFAULT_ADMIN_COMPANY_NAME'),
        ]);
    }
}
