<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hesap_kodu');
            $table->string('ba_bs')->nullable();
            $table->string('aciklama');
            $table->string('islem_para_birimi');
            $table->string('ba');
            $table->string('tutar');
            $table->string('unvan');
            $table->string('vergi_hesap')->nullable();
            $table->string('ulke')->nullable();
            $table->string('evrak_sayisi')->nullable();
            $table->string('doviz_cinsi');
            $table->string('doviz_kuru');
            $table->string('doviz_tutari');
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
        Schema::drop('link_reports');
    }
}
