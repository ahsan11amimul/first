<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
           
            'name'=>'vegetables',
            'description' =>'100% organic and we collect it directly from Farmers',
            
            'url'=>'vegetable',
            'image'=>'https://cdn.pixabay.com/photo/2015/05/04/10/16/vegetables-752153_960_720.jpg'
            
        ]);
          DB::table('categories')->insert([
           
            'name'=>'fruits',
            'description' =>'100% organic and we collect it directly from Farmers',
            
            'url'=>'fruits',
            'image'=>'https://cdn.pixabay.com/photo/2015/12/30/11/57/fruit-basket-1114060__340.jpg'
            
        ]);
         DB::table('categories')->insert([
           
            'name'=>'egg',
            'description' =>'100% organic and we collect it directly from Farmers',
            
            'url'=>'egg',
            'image'=>'https://cdn.pixabay.com/photo/2017/02/08/11/15/egg-2048476__340.jpg'
            
        ]);
         DB::table('categories')->insert([
           
            'name'=>'dairy',
            'description' =>'100% organic and we collect it directly from Farmers',
            
            'url'=>'dairy',
            'image'=>'https://cdn.pixabay.com/photo/2015/09/09/20/25/milk-933106__340.jpg'
            
        ]);
    }
}
