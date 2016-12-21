<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigInteger('id')->unsigned()->primary();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('birth_date');
            $table->string('gender', 2);
            $table->text('address');
            $table->string('zip_code');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country');
            $table->string('telephone');
            $table->string('email');
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
        Schema::drop('customers');
    }
}
