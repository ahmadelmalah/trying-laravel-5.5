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

        DB::table('stacks')->insert([
            'name' => 'Test Stack 1',
        ]);

        //sheets
        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Berg',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 1, 'answer' => 'mountain',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Turm',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 2, 'answer' => 'tower',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Gespenst',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 3, 'answer' => 'ghost',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Katze',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 4, 'answer' => 'cat',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Eule',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 5, 'answer' => 'owl',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Fledermaus',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 6, 'answer' => 'bat',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Mäuse',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 7, 'answer' => 'mice',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Mond',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 8, 'answer' => 'moon',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Uhr',]);
        DB::table('sheets_answers')->insert(['sheet_id' => 9, 'answer' => 'clock',]);
    }
}
