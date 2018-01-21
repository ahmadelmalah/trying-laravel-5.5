<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //str_random(10)
        DB::table('users')->insert([
            'name' => 'Ahmad',
            'email' => 'ahmedelmalah@hotmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
