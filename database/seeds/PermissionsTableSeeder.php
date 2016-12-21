<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
        	'role_id' => 1,
        	'name' => 'all',
        ]);

        DB::table('permissions')->insert([
        	'role_id' => 2,
        	'name' => 'invoice'
        ]);

        DB::table('permissions')->insert([
        	'role_id' => 2,
        	'name' => 'report'
        ]);
    }
}
