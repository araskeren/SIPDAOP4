<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenumpangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penumpang', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
          $table->integer('stasiun_id')->unsigned();
          $table->foreign('stasiun_id')->references('id')->on('stasiun')->onUpdate('cascade');
          $table->string('jenis',50)->nullable();
          $table->bigInteger('volume')->nullable();
          $table->bigInteger('pendapatan')->nullable();
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
        Schema::dropIfExists('penumpang');
    }
}
