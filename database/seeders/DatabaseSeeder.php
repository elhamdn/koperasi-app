<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('anggotas')->insert([
            'no_kta' => 'KTA2201001',
            'email' => 'ilhamdn@mailnesia.com',
            'nama_anggota' => 'Ilham Dwi Nugraha',
            'alamat_anggota' => 'Jl. Raya Puspiptek, Buaran, Kec. Pamulang, Kota Tangerang Selatan, Banten 15310',
            'jenis_kelamin' => 'L',
            'nomor_hp' => '08871224023',
            'password' => Hash::make('123'),
            'total_pinjaman' => '0',
            'total_simpanan' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('anggotas')->insert([
            'no_kta' => 'KTA2201002',
            'email' => 'ismail@mailnesia.com',
            'nama_anggota' => 'Ismail',
            'alamat_anggota' => 'Jl. Raya Puspiptek, Buaran, Kec. Pamulang, Kota Tangerang Selatan, Banten 15310',
            'jenis_kelamin' => 'L',
            'nomor_hp' => '08871224024',
            'password' => Hash::make('123'),
            'total_pinjaman' => '0',
            'total_simpanan' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('penguruses')->insert([
            'nip' => 'NIP2201002',
            'email' => 'bendahara@mailnesia.com',
            'nama_pengurus' => "Bendahara",
            'alamat_pengurus' => 'Jl. Raya Puspiptek, Buaran, Kec. Pamulang, Kota Tangerang Selatan, Banten 15310',
            'jenis_kelamin' => 'L',
            'nomor_hp' => '08871224025',
            'password' => Hash::make('123'),
            'jenis_pengurus' => 'bendahara',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
