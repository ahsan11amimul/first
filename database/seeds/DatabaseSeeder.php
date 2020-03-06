<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    { $this->call(AreasTableSeeder::class);  
        $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
       
        
         $this->call(AccountsTableSeeder::class);
        
         $this->call(MessagesTableSeeder::class);
        //   $this->call(CategoriesTableSeeder::class);
        //    $this->call(ProductsTableSeeder::class);
    }
}
