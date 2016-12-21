<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Orcun',
            'role_id' => 1,
            'email' => 'orcun.otacioglu@acikgise.com',
            'password' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'Milos',
            'role_id' => 3,
            'email' => 'milos.nenadovic@euroleague.net',
            'password' => bcrypt('password'),
        ]);
    }
}
