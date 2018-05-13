<?php

use Illuminate\Database\Seeder;

class AccesslevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accesslevel')->insert([
            'level' => '0',
            'type' => 'ingentilgang',
        ]);

        DB::table('accesslevel')->insert([
            'level' => '1',
            'type' => 'student',
        ]);

        DB::table('accesslevel')->insert([
            'level' => '2',
            'type' => 'admin',
        ]);
    }
}
