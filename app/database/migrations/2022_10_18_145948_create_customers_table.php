<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('氏名');
            $table->string('tel')->comment('電話番号');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->integer('postcode')->comment('郵便番号');
            $table->string('address')->comment('住所');
            $table->date('birthday')->comment('誕生日')->nullable();
            $table->tinyInteger('gender')->comment('性別'); // 0男性, 1女性、2その他 
            $table->text('memo')->comment('備考')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
