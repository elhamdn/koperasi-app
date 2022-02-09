<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nama = 'lala';
        return view('pages.dashboard', compact('nama'));
    }

    public function index_angsuran(Request $request)
    {
        $anggotas = Anggota::all();
        $no_kta = $request->no_kta;
        $no_transaksi = $request->no_transaksi;
        $pinjamans = Pinjaman::where('no_kta', $request->no_kta)->get();
        $angsurans = Angsuran::where('no_transaksi_pinjaman', $no_transaksi)->paginate(5);
        $pinjamanPilihan = Pinjaman::find($no_transaksi);
        try {
            $isSudahLunas = Angsuran::where('no_transaksi_pinjaman', $no_transaksi)->count() == $pinjamanPilihan->tenor_cicilan ? true : false;
            $Pokokpinjamanperbulan = (int)$pinjamanPilihan->total_pinjam / (int)$pinjamanPilihan->tenor_cicilan;
            $Bungaperbulan = ((int)$pinjamanPilihan->total_pinjam * ((int)$pinjamanPilihan->bunga / 100) / 12);
            $cicilan = round($Pokokpinjamanperbulan + $Bungaperbulan, 0);
            $anggotaPilihan = Anggota::find($request->no_kta);
            if ($isSudahLunas) {
                $jmlCicilan = 0;
            } else {
                $jmlCicilan = (int)$pinjamanPilihan->tenor_cicilan - Angsuran::where('no_transaksi_pinjaman', $no_transaksi)->count();
            }
        } catch (\Throwable $th) {
            $isSudahLunas = false;
            $Pokokpinjamanperbulan = 0;
            $Bungaperbulan = 0;
            $cicilan = 0;
        }
        return view('pages.angsuran', compact('jmlCicilan', 'anggotaPilihan', 'isSudahLunas', 'cicilan', 'anggotas', 'no_transaksi', 'no_kta', 'pinjamans', 'angsurans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total_cicilan_skrng = Angsuran::where('no_transaksi_pinjaman', $request->no_transaksi_pinjaman)->sum('total_angsuran');
        $jmlPinjam = Pinjaman::where('no_transaksi', $request->no_transaksi_pinjaman)->first();
        $total_bunga = (((int)$jmlPinjam->total_pinjam * ((int)$jmlPinjam->bunga / 100) / 12)) * (int)$jmlPinjam->tenor_cicilan;
        $total_diharapkan_lunas = (int)$jmlPinjam->total_pinjam + round($total_bunga, 0);
        if ($total_cicilan_skrng == $total_diharapkan_lunas) {
            return redirect()->to('/angsuran?no_kta=' . $request->no_kta . '&no_transaksi=' . $request->no_transaksi_pinjaman)->with('message', 'Tagihan Sudah Lunas');;
        }
        try {
            $angsuran = new Angsuran();
            $latestNomorTransaksi = Angsuran::select('no_transaksi')->latest()->first();
            if ($latestNomorTransaksi) {
                $angsuran->no_transaksi = $latestNomorTransaksi->no_transaksi + 1;
            } else {
                $angsuran->no_transaksi = 1;
            }
            $angsuran->no_kta = $request->no_kta;
            $angsuran->no_transaksi_pinjaman = $request->no_transaksi_pinjaman;
            $angsuran->tgl_angsuran = Carbon::now();
            $angsuran->total_angsuran = $request->cicilan;
            $angsuran->save();

            $pinjamanPilihan = Pinjaman::select('tenor_cicilan', 'total_pinjam')->where('no_transaksi', $request->no_transaksi_pinjaman)->first();
            $tenor_cicilan = $pinjamanPilihan->tenor_cicilan ? $pinjamanPilihan->tenor_cicilan : 0;
            $isSudahLunas = Angsuran::where('no_transaksi_pinjaman', $request->no_transaksi_pinjaman)->count() == $tenor_cicilan ? true : false;

            if ($isSudahLunas) {
                // change user total pinjaman
                $anggota = Anggota::find($request->no_kta);
                $hasil = (int)$anggota->total_pinjaman - (int)$pinjamanPilihan->total_pinjam;
                $anggota->update(['total_pinjaman' => $hasil]);
            }

            return redirect()->to('/angsuran?no_kta=' . $request->no_kta . '&no_transaksi=' . $request->no_transaksi_pinjaman)->with('message', 'Data Berhasil diapprove');;
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->to('/angsuran?no_kta=' . $request->no_kta . '&no_transaksi=' . $request->no_transaksi_pinjaman)->with('error', 'Data gagal diapprove');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function show(Angsuran $angsuran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function edit(Angsuran $angsuran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Angsuran $angsuran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angsuran $angsuran)
    {
        //
    }
}
