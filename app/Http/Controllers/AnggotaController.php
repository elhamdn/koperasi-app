<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::guard('anggota')->user();
        $pinjaman = Pinjaman::where('no_kta', $user->no_kta)->get();
        try {
            $pinjamanPilihan = Pinjaman::select('tenor_cicilan')->where('no_transaksi', $request->no_transaksi_pilihan)->first();
            $tenor_cicilan = $pinjamanPilihan->tenor_cicilan ? $pinjamanPilihan->tenor_cicilan : 0;
            $isSudahLunas = Angsuran::where('no_transaksi_pinjaman', $request->no_transaksi_pilihan)->count() == $tenor_cicilan ? true : false;
            $no_transaksi_pilihan = $request->no_transaksi_pilihan;
            $angsurans = Angsuran::where('no_transaksi_pinjaman', $request->no_transaksi_pilihan)->get();
        } catch (\Throwable $th) {
            $isSudahLunas = false;
            $no_transaksi_pilihan = 0;
            $angsurans = Angsuran::where('no_transaksi_pinjaman', $request->no_transaksi_pilihan)->get();
        }
        return view('pages.home', compact('isSudahLunas', 'user', 'pinjaman', 'angsurans', 'no_transaksi_pilihan'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anggota $anggota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        //
    }
}
