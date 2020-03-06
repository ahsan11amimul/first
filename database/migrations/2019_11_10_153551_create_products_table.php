<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('name');
            $table->string('description');
            $table->string('image');  
           
            $table->integer('quantity');
            $table->integer('old_quantity')->default(0);
            $table->integer('price');
            $table->string('unit');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('is_verified')->default(1);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           
            $table->timestamps();
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
