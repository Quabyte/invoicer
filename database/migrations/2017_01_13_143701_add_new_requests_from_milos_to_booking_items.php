<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewRequestsFromMilosToBookingItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proformas', function ($table) {
            $table->string('category_names');
            $table->string('ticket_counts');
            $table->integer('generate_count');
            $table->decimal('vat');
            $table->decimal('tax');
            $table->decimal('net_price');
            $table->integer('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proformas', function ($table) {
            $table->dropColumn('category_names');
            $table->dropColumn('ticket_counts');
            $table->dropColumn('generate_count');
            $table->dropColumn('vat');
            $table->dropColumn('tax');
            $table->dropColumn('net_price');
            $table->dropColumn('customer_id');
        });
    }
}
