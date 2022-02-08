<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->string('no_transaksi', 12)->primary();
            $table->string('no_kta', 12);
            $table->datetime('tgl_pinjam')->nullable();
            $table->string('total_pinjam', 10);
            $table->string('keterangan', 30);
            $table->string('tenor_cicilan', 3);
            $table->string('bunga', 3);
            $table->string('status_pengajuan_pinjaman', 7);
            $table->datetime('tgl_pengajuan');
            $table->string('alasan_approval', 30)->nullable();
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
        Schema::dropIfExists('pinjamen');
    }
}
