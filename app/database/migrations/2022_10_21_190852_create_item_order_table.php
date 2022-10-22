<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id')->comment('顧客ID');
            $table->unsignedBigInteger('order_id')->comment('商品ID');
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade');
            // $table->timestamps(); いらない
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_order');
    }
}
