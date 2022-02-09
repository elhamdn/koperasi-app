<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_pengajuan(Request $request)
    {
        $anggotas = Anggota::all();
        $no_kta = $request->no_kta;
        $pinjamans = Pinjaman::where('no_kta', $no_kta)->paginate(5)->withQueryString();
        return view('pages.pengajuan', compact('anggotas', 'pinjamans', 'no_kta'));
    }

    public function approve_pinjaman(Request $request)
    {
        try {
            $pinjaman = Pinjaman::find($request->no_transaksi);
            $pinjaman->status_pengajuan_pinjaman = 'approve';
            $pinjaman->tgl_pinjam = Carbon::now();
            $pinjaman->alasan_approval = $request->alasan_approval;
            $pinjaman->bunga = $request->bunga;
            $pinjaman->save();

            $anggota = Anggota::find($request->no_kta);
            $anggota->total_pinjaman = (int)$anggota->total_pinjaman + (int)$pinjaman->total_pinjam;
            $anggota->save();

            return redirect()->to('/pengajuan?no_kta=' . $request->no_kta)->with('message', 'Data Berhasil diapprove');;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/pengajuan?no_kta=' . $request->no_kta)->with('error', 'Data gagal diapprove');;
        }
    }

    public function reject_pinjaman(Request $request)
    {
        try {
            $pinjaman = Pinjaman::find($request->no_transaksi);
            $pinjaman->status_pengajuan_pinjaman = 'reject';
            $pinjaman->keterangan = $request->keterangan;
            $pinjaman->save();

            return redirect()->to('/pengajuan?no_kta=' . $request->no_kta)->with('message', 'Data Berhasil diapprove');;
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->to('/pengajuan?no_kta=' . $request->no_kta)->with('error', 'Data gagal diapprove');;
        }
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
            $dataPinjaman->bunga = 0;
            $dataPinjaman->status_pengajuan_pinjaman = 'pending';
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
