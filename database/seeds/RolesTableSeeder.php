<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'id'=>1,
            'name' => 'customer',
            
        ]);
         DB::table('roles')->insert([
            'id'=>2,
            'name' => 'farmer',
            
        ]);
          DB::table('roles')->insert([
            'id'=>3,
            'name' => 'delivery_boy',
            
        ]);
         DB::table('roles')->insert([
             'id'=>11,
            'name' => 'admin',
            
        ]);
    }
}