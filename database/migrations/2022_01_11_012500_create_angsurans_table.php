<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngsuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsurans', function (Blueprint $table) {
            $table->string('no_transaksi', 12)->primary();
            $table->string('no_kta', 12);
            $table->string('no_transaksi_pinjaman', 12);
            $table->datetime('tgl_angsuran');
            $table->string('total_angsuran', 10);
            // $table->string('status_angsuran', 15);
            $table->foreign('no_kta')->references('no_kta')->on('anggotas')->onDelete('cascade');
            $table->foreign('no_transaksi_pinjaman')->references('no_transaksi')->on('pinjamen')->onDelete('cascade');
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
        Schema::dropIfExists('angsurans');
    }
}
