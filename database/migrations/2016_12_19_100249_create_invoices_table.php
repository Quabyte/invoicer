<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('transaction_id');
            $table->string('customer_name');
            $table->text('address');
            $table->string('zip_code');
            $table->string('province');
            $table->string('country');
            $table->string('package');
            $table->decimal('net_price');
            $table->decimal('tax');
            $table->decimal('fee');
            $table->decimal('total');
            $table->string('price_text');
            $table->string('generated');
            $table->boolean('canceled');
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
        Schema::drop('invoices');
    }
}
