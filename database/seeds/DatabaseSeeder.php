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
        //Look-ups tables
        DB::table('type_stack')->insert(['id' => 1, 'name' => 'Under Development']);
        DB::table('type_stack')->insert(['id' => 2, 'name' => 'Private']);
        DB::table('type_stack')->insert(['id' => 3, 'name' => 'Public']);

        DB::table('sheets_answers_types')->insert(['id' => 1, 'name' => 'Open Tex']);
        DB::table('sheets_answers_types')->insert(['id' => 2, 'name' => 'Multiple Options']);

        //str_random(10)
        DB::table('users')->insert([
            'name' => 'Mr. Demo',
            'email' => 'demo@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        DB::table('stacks')->insert([
            'name' => 'Test Stack 1',
            'description' => 'Stack Desciption',
            'type' => 3,
            'created_by' => 1
        ]);

        //sheets
        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Berg','id' => 1]);
        DB::table('sheets_answers')->insert(['sheet_id' => 1, 'answer' => 'mountain',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Turm','id' => 2]);
        DB::table('sheets_answers')->insert(['sheet_id' => 2, 'answer' => 'tower',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Gespenst','id' => 3]);
        DB::table('sheets_answers')->insert(['sheet_id' => 3, 'answer' => 'ghost',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Katze','id' => 4]);
        DB::table('sheets_answers')->insert(['sheet_id' => 4, 'answer' => 'cat',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Eule','id' => 5]);
        DB::table('sheets_answers')->insert(['sheet_id' => 5, 'answer' => 'owl',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Fledermaus','id' => 6]);
        DB::table('sheets_answers')->insert(['sheet_id' => 6, 'answer' => 'bat',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Mäuse','id' => 7]);
        DB::table('sheets_answers')->insert(['sheet_id' => 7, 'answer' => 'mice',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Mond','id' => 8]);
        DB::table('sheets_answers')->insert(['sheet_id' => 8, 'answer' => 'moon',]);

        DB::table('sheets')->insert(['stack_id' => 1,'question' => 'Uhr','id' => 9]);
        DB::table('sheets_answers')->insert(['sheet_id' => 9, 'answer' => 'clock',]);
    }
}
