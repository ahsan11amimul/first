<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'category_id'=>1,
            'user_id'=>1,
            'name'=>'green chillis',
            'description' =>'100% organic and we collect it directly from Farmers',
            'url'=>'chillis',
            'image'=>'https://cdn.pixabay.com/photo/2013/01/05/13/54/pepperoni-73908__340.jpg',
            'quantity'=>40,
            'price'=>80,
            'unit'=>'kg',
            
        ]);
        DB::table('products')->insert([
            'category_id'=>2,
            'user_id'=>2,
            'name'=>'banana',
            'description' =>'100% organic and we collect it directly from Farmers',
            'url'=>'banana',
            'image'=>'https://cdn.pixabay.com/photo/2011/03/24/10/12/banana-5734__340.jpg',
            'quantity'=>60,
            'price'=>110,
            'unit'=>'Dozen',
            
        ]);
           DB::table('products')->insert([
            'category_id'=>3,
            'user_id'=>3,
            'name'=>'egg',
            'description' =>'100% organic and we collect it directly from Farmers',
            'url'=>'egg',
            'image'=>'https://cdn.pixabay.com/photo/2017/02/08/11/15/egg-2048476__340.jpg',
            'quantity'=>60,
            'price'=>150,
            'unit'=>'Dozen',
            
        ]);
         DB::table('products')->insert([
            'category_id'=>3,
            'user_id'=>1,
            'name'=>'milk',
            'description' =>'100% organic and we collect it directly from Farmers',
            'url'=>'milk',
            'image'=>'https://cdn.pixabay.com/photo/2015/09/09/20/25/milk-933106__340.jpg',
            'quantity'=>20,
            'price'=>80,
            'unit'=>'Litre',
            
        ]);
    }
}
