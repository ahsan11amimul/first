<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('messages')->insert([
            'sender_id'=>4,
            'message'=>'brother how are you',
            'reciever_id'=>1,
             ]);
              DB::table('messages')->insert([
            'sender_id'=>1,
            'message'=>'Alhamdullah valo',
            'reciever_id'=>4,
             ]);
              DB::table('messages')->insert([
            'sender_id'=>3,
            'message'=>'when you will return',
            'reciever_id'=>2,
             ]);
              DB::table('messages')->insert([
            'sender_id'=>2,
            'message'=>'I do not know',
            'reciever_id'=>3,
             ]);
        
    }
}
