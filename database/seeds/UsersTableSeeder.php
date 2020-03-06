<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'role_id' => 1,
            'email_verified'=>1,
            'email_verification_token'=>'',
            
            'name'=>'Sifat',
            'email' =>'sifat99@gmail.com',
            'password'=>bcrypt('sifat99'),
            'phone'=>'01780163857',
            'address'=>'Village:Aoura,Post:kalai,dist:Joypurhat',
            'area_id'=>1
            
        ]);
         DB::table('users')->insert([
            'role_id' => 1,
            'email_verified'=>1,
            'email_verification_token'=>'',
            
            'name'=>'Sibli',
            'email' =>'sibli99@gmail.com',
            'password'=>bcrypt('sibli99'),
            'phone'=>'01780163856',
            'address'=>'Village:Baiguni,Post:kalai,dist:Joypurhat',
            'area_id'=>2
            
        ]);
          DB::table('users')->insert([
            'role_id' => 2,
            'email_verified'=>1,
            'email_verification_token'=>'',
            
            'name'=>'Sahid',
            'email' =>'sahid99@gmail.com',
            'password'=>bcrypt('sahid99'),
            'phone'=>'01780163853',
            'address'=>'Village:Aoura,Post:kalai,dist:Joypurhat',
            'area_id'=>1
            
        ]);
        DB::table('users')->insert([
            'role_id' => 2,
            'email_verified'=>1,
            'email_verification_token'=>'',
            
            'name'=>'Sijar',
            'email' =>'sijar99@gmail.com',
            'password'=>bcrypt('sijar99'),
            'phone'=>'01780163867',
            'address'=>'Village:baiguni,Post:kalai,dist:Joypurhat',
            'area_id'=>2
            
        ]);
           DB::table('users')->insert([
            'role_id' => 3,
            'email_verified'=>1,
            'email_verification_token'=>'',
            
            'name'=>'Habibul',
            'email' =>'habib99@gmail.com',
            'password'=>bcrypt('habib99'),
            'phone'=>'01780163851',
            'address'=>'Village:Talora Baiguni,Post:kalai,dist:Joypurhat',
            'area_id'=>1
            
        ]);
        DB::table('users')->insert([
            'role_id' => 3,
            'email_verified'=>1,
            'email_verification_token'=>'',
            
            'name'=>'Lotus',
            'email' =>'lotus99@gmail.com',
            'password'=>bcrypt('lotus99'),
            'phone'=>'01780163850',
            'address'=>'Village:Talora Baiguni,Post:kalai,dist:Joypurhat',
            'area_id'=>2
            
        ]);
        DB::table('users')->insert([
            'role_id' => 11,
            'email_verified'=>1,
            'email_verification_token'=>'',
          
            'name'=>'Ahsan',
            'email' =>'ahsan99@gmail.com',
            'password'=>bcrypt('ahsan99'),
            'phone'=>'01721544957',
            'address'=>'House:91,Road:14,G-block',
            'area_id'=>1
            
        ]);
      
    }
}