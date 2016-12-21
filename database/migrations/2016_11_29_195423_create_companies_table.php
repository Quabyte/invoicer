<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('logo_path')->nullable();
            $table->text('telephone');
            $table->text('fax');
            $table->text('tax_administration');
            $table->text('tax_number');
            $table->text('mersis_number')->nullable();
            $table->integer('vat');
            $table->text('address');
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('branch_number');
            $table->string('account_number');
            $table->string('swift');
            $table->string('iban');
            $table->text('branch_address');
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
        Schema::drop('companies');
    }
}
