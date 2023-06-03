<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->date('tahun_keluaran');
            $table->text('warna');
            $table->double('harga');
            $table->text('mesin');
            $table->integer('kapasitas_penumpang')->nullable();
            $table->string('tipe',255)->nullable();
            $table->string('tipe_suspensi',255)->nullable();
            $table->string('tipe_transmisi',255)->nullable();
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
        Schema::dropIfExists('kendaraans');
    }
}
