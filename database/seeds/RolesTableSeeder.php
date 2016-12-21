<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	'name' => 'batman',
        	'display_name' => 'Batman',
        	'description' => 'I\'m Batman'
        ]);

        DB::table('roles')->insert([
            'name' => 'accountant',
            'display_name' => 'Detur',
            'description' => 'Detur Accountants'
        ]);

        DB::table('roles')->insert([
            'name' => 'euroleague',
            'display_name' => 'EB Basketball',
            'description' => 'EuroLeague Team'
        ]);
    }
}
