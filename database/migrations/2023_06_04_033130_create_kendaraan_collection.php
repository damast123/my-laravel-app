<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKendaraanCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('kendaraan_collection', function (Blueprint $collection) {
            $collection->index('id');
            $collection->date('tahun_keluaran');
            $collection->text('warna');
            $collection->double('harga');
            $collection->text('mesin');
            $collection->integer('kapasitas_penumpang')->nullable();
            $collection->string('tipe',255)->nullable();
            $collection->string('tipe_suspensi',255)->nullable();
            $collection->string('tipe_transmisi',255)->nullable();
            // Define other fields and indexes as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraan_collection');
    }
}
