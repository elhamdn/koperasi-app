<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $anggotas = Anggota::all();
        $no_kta = $request->no_kta;
        $simpanans = Simpanan::where('no_kta', $no_kta)->latest('created_at')->paginate(5)->withQueryString();
        $totalSimpanan = Anggota::where('no_kta', $no_kta)->first();
        return view('pages.simpanan', compact('anggotas', 'simpanans', 'no_kta', 'totalSimpanan'));
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
            if ((int)$request->deposit_wajib >= (int)$request->total) {
                return redirect()->to('/simpanan?no_kta=' . $no_kta)->with('error', 'Duit yang diterima tidak sesuai');;
            }
            $latestNomorTransaksi = Simpanan::select('no_transaksi')->latest()->first();
            $dataSimpanan = new Simpanan();
            if ($latestNomorTransaksi) {
                $dataSimpanan->no_transaksi = $latestNomorTransaksi->no_transaksi + 1;
            } else {
                $dataSimpanan->no_transaksi = 1;
            }
            $depositPokok = (int)$request->total - (int)$request->deposit_wajib;
            $dataSimpanan->no_kta = $request->no_kta;
            $dataSimpanan->keterangan = $request->keterangan;
            $dataSimpanan->tgl_deposit = Carbon::now();
            $dataSimpanan->deposit_wajib = $request->deposit_wajib;
            $dataSimpanan->deposit_pokok = $depositPokok;
            $dataSimpanan->save();

            $anggota = Anggota::find($request->no_kta);
            $anggota->total_simpanan = (int)$anggota->total_simpanan + (int)$request->total;
            $anggota->save();

            return redirect()->to('/simpanan?no_kta=' . $request->no_kta)->with('message', 'Data Berhasil Ditambahkan');;
        } catch (\Throwable $th) {
            return redirect()->to('/simpanan?no_kta=' . $request->no_kta)->with('error', 'Data Gagal Ditambahkan');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function show(Simpanan $simpanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Simpanan $simpanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simpanan $simpanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simpanan $simpanan)
    {
        //
    }

    public function withdraw(Request $request)
    {
        try {

            $anggota = Anggota::find($request->no_kta);

            if ((int)$request->total >= (int)$anggota->total_simpanan) {
                return redirect()->to('/simpanan?no_kta=' . $request->no_kta)->with('error', 'Duit yang diterima tidak sesuai');;
            }
            $latestNomorTransaksi = Simpanan::select('no_transaksi')->latest()->first();
            $dataSimpanan = new Simpanan();
            if ($latestNomorTransaksi) {
                $dataSimpanan->no_transaksi = $latestNomorTransaksi->no_transaksi + 1;
            } else {
                $dataSimpanan->no_transaksi = 1;
            }

            $dataSimpanan->no_kta = $request->no_kta;
            $dataSimpanan->keterangan = $request->keterangan;
            $dataSimpanan->tgl_deposit = Carbon::now();
            $dataSimpanan->deposit_wajib = -$request->total;;
            $dataSimpanan->deposit_pokok = 0;
            $dataSimpanan->save();

            $anggota->total_simpanan = (int)$anggota->total_simpanan - (int)$request->total;
            $anggota->save();

            return redirect()->to('/simpanan?no_kta=' . $request->no_kta)->with('message', 'Tarik Dana Berhasil Ditambahkan');;
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->to('/simpanan?no_kta=' . $request->no_kta)->with('error', 'Tarik Dana Gagal Ditambahkan');;
        }
    }
}
