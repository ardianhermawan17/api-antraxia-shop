<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_order', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('book_id')->unsigned();
           $table->integer('order_id')->unsigned();
           $table->integer('quantity')->unsigned()->default(1);
           $table->timestamps();

           $table->foreign('order_id')->references('id')->on('orders');
           $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_order');
    }
}
