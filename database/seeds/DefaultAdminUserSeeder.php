<?php

use Illuminate\Database\Seeder;

class DefaultAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => config('DEFAULT_ADMIN_NAME','deibioctavio'),
            'email' => config('DEFAULT_ADMIN_EMAIL','deibioctavio@gmail.com'),
            'password' => bcrypt(config('DEFAULT_ADMIN_PASSWWORD','deibioctavio')),
        ]);

        DB::table('users')->insert([
            'name' => 'jolemuac91',
            'email' => 'jolemuac91@gmail.com',
            'password' => bcrypt('_jolemuac91_'),
        ]);
    }
}
