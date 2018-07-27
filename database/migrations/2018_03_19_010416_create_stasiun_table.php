<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStasiunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stasiun', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama_stasiun',50);
          $table->boolean('stasiun_barang');
          $table->boolean('stasiun_penumpang');
          $table->timestamps();
        });
        DB::table('stasiun')->insert([
              'id'=>0,
	            'nama_stasiun' => 'DAOP 4',
              'stasiun_barang'=>0,
	            'stasiun_penumpang' => 1
	       ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stasiun');
    }
}
