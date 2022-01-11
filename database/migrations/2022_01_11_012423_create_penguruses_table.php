<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguruses', function (Blueprint $table) {
            $table->string('nip', 12)->primary();
            $table->string('email', 30);
            $table->string('nama_pengurus', 30);
            $table->string('alamat_pengurus', 100);
            $table->string('jenis_kelamin', 1);
            $table->string('nomor_hp', 15);
            $table->string('password');
            $table->string('jenis_pengurus', 12);
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
        Schema::dropIfExists('penguruses');
    }
}
