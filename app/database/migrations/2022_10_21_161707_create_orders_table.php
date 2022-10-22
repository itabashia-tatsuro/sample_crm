<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->comment('顧客ID');
            $table->integer('quantity')->unsigned()->comment('個数');
            $table->integer('price')->unsigned()->comment('合計金額');
            $table->string('status', 10)->comment('注文状況');
            $table->text('memo', 65535)->nullable()->comment('備考');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade');
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
        Schema::dropIfExists('orders');
    }
}
