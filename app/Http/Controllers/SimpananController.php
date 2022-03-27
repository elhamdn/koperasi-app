<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

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
            $dataSimpanan->deposit = $request->deposit;
            $dataSimpanan->jenis_simpanan = $request->jenis_simpanan;
            $dataSimpanan->save();

            $anggota = Anggota::find($request->no_kta);
            $anggota->total_simpanan = (int)$anggota->total_simpanan + (int)$request->deposit;
            $anggota->save();

            $getLatest = Simpanan::select('no_transaksi')->latest()->first();
            $getLatest = $getLatest->no_transaksi;

            return redirect()->to('/simpanan?no_kta=' . $request->no_kta)->with('message', json_encode(['pesan' => 'Data Berhasil Ditambahkan', 'no_transaksi' => $getLatest]));
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
            $dataSimpanan->deposit = -$request->total;
            $dataSimpanan->jenis_simpanan = 'wajib';
            $dataSimpanan->save();

            $anggota->total_simpanan = (int)$anggota->total_simpanan - (int)$request->total;
            $anggota->save();

            return redirect()->to('/simpanan?no_kta=' . $request->no_kta)->with('message', 'Tarik Dana Berhasil Ditambahkan');;
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->to('/simpanan?no_kta=' . $request->no_kta)->with('error', 'Tarik Dana Gagal Ditambahkan');;
        }
    }

    public function simpanan_all(Request $request)
    {
        //
        $data = DB::table('simpanans')->select('simpanans.no_transaksi', 'simpanans.no_kta', 'anggotas.nama_anggota', 'simpanans.tgl_deposit', 'simpanans.deposit', 'simpanans.jenis_simpanan', 'simpanans.keterangan')->join('anggotas', 'anggotas.no_kta', '=', 'simpanans.no_kta')->orderBy('simpanans.updated_at', 'desc');
        if($q = $request->search){
            $data = $data->where('simpanans.no_kta','like','%'.$q.'%')
            ->orWhere('simpanans.tgl_pinjam','like','%'.$q.'%')
            ->orWhere('simpanans.total_pinjam','like','%'.$q.'%')
            ->orWhere('anggotas.nama_anggota','like','%'.$q.'%')
            ->orWhere('simpanans.tgl_deposit','like','%'.$q.'%')
            ->orWhere('simpanans.deposit','like','%'.$q.'%')
            ->orWhere('simpanans.jenis_simpanan','like','%'.$q.'%')
            ->orWhere('simpanans.keterangan','like','%'.$q.'%');
        }

        return $data->get();
    }
}
