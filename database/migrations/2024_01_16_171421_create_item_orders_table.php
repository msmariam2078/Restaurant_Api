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
        Schema::create('item_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->integer('number');
            $table->unsignedBigInteger('order_id');
            $table->foreign('menu_id')
            ->references('id')->on('menus')->onDelete('cascade');

            $table->foreign('order_id')
            ->references('id')->on('orders')->onDelete('cascade');
            $table->unique(["order_id","menu_id"]);
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
        Schema::dropIfExists('item_orders');
    }
};
