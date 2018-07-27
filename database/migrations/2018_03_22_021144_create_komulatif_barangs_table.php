<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomulatifBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komulatif_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis',20);
            $table->bigInteger('pendapatan')->unsigned()->nullable();
            $table->integer('volume')->unsigned()->nullable();
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
        Schema::dropIfExists('komulatif_barang');
    }
}
