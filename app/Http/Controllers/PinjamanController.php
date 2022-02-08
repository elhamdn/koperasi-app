<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $latestNomorTransaksi = Pinjaman::select('no_transaksi')->latest()->first();
            $dataPinjaman = new Pinjaman;
            if ($latestNomorTransaksi) {
                $dataPinjaman->no_transaksi = $latestNomorTransaksi->no_transaksi + 1;
            } else {
                $dataPinjaman->no_transaksi = 1;
            }
            $dataPinjaman->no_kta = $request->no_kta;
            $dataPinjaman->tenor_cicilan = $request->tenor_cicilan;
            $dataPinjaman->keterangan = $request->keterangan;
            $dataPinjaman->total_pinjam = $request->total_pinjam;
            $dataPinjaman->tgl_pengajuan = Carbon::now();
            $dataPinjaman->bunga = 3;
            $dataPinjaman->status_pengajuan = 'pending';
            $dataPinjaman->save();
            return redirect()->to('/home')->with('message', 'Data Berhasil Ditambahkan');;
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->to('/home')->with('error', 'Data Gagal Ditambahkan');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }
}
