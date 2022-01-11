<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->string('no_kta', 12)->primary();
            $table->string('email', 30);
            $table->string('nama_anggota', 30);
            $table->string('alamat_anggota', 100);
            $table->string('jenis_kelamin', 1);
            $table->string('nomor_hp', 15);
            $table->string('password');
            $table->string('total_pinjaman', 10);
            $table->string('total_simpanan', 10);
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
        Schema::dropIfExists('anggotas');
    }
}
