<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpanans', function (Blueprint $table) {
            $table->string('no_transaksi', 12)->primary();
            $table->string('no_kta', 12);
            $table->datetime('tgl_deposit');
            $table->string('deposit_pokok', 10);
            $table->string('deposit_wajib', 10);
            $table->string('keterangan', 30);
            $table->foreign('no_kta')->references('no_kta')->on('anggotas')->onDelete('cascade');
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
        Schema::dropIfExists('simpanans');
    }
}
