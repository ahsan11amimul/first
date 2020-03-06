<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'account_number'=>'01780163857',
            'balance'=>11000,
            'pin'=>1111,
            'user_id'=>1
        ]);
         DB::table('accounts')->insert([
            'account_number'=>'01780163856',
            'balance'=>10000,
            'pin'=>2222,
            'user_id'=>2
        ]);
         DB::table('accounts')->insert([
            'account_number'=>'01780163853',
            'balance'=>9000,
            'pin'=>3333,
            'user_id'=>3
        ]);
         DB::table('accounts')->insert([
            'account_number'=>'01780163867',
            'balance'=>1000,
            'pin'=>4444,
            'user_id'=>4
        ]);
          DB::table('accounts')->insert([
            'account_number'=>'01780163851',
            'balance'=>1000,
            'pin'=>5555,
            'user_id'=>5
        ]);
          DB::table('accounts')->insert([
            'account_number'=>'01780163850',
            'balance'=>1000,
            'pin'=>6666,
            'user_id'=>6
        ]);
          DB::table('accounts')->insert([
            'account_number'=>'01721544957',
            'balance'=>1000,
            'pin'=>7777,
            'user_id'=>7
        ]);
         
    }
}
