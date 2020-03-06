<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('areas')->insert([
            'name'=>'Bashundhara',
            'delivery_charge'=>20,
            
        ]);
        DB::table('areas')->insert([
            'name'=>'Bogura',
            'delivery_charge'=>30,
            
        ]);
        DB::table('areas')->insert([
            'name'=>'Uttara',
            'delivery_charge'=>40,
            
        ]);
        DB::table('areas')->insert([
            'name'=>'Gulshan',
            'delivery_charge'=>30,
            
        ]);
        

    }
}
