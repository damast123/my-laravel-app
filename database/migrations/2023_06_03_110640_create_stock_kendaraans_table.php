<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kendaraans_id');
            $table->integer('stock')->nullable();
            $table->timestamps();
            $table->foreign('kendaraans_id')->references('id')->on('kendaraans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_kendaraans');
    }
}
