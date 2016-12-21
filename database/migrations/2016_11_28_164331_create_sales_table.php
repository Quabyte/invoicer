<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('transaction_id');
            $table->bigInteger('customer_id')->unsigned();
            $table->dateTime('time');
            $table->string('payment_method');
            $table->string('channel');
            $table->boolean('is_cancelled');
            $table->string('transaction_type');
            $table->timestamps();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
    }
}
