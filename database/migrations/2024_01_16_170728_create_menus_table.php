<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
           
          
            $table->unsignedBigInteger('restaurant_id');
            $table->unsignedBigInteger('item_id');
            $table->double('price');
         

            $table->foreign('item_id')
            ->references('id')->on('items')->onDelete('cascade');
            $table->foreign('restaurant_id')
            ->references('id')->on('restaurants')->onDelete('cascade');
            $table->unique(["restaurant_id","item_id"]);
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
        Schema::dropIfExists('item_restaurants');
    }
};
