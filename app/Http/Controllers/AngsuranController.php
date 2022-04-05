<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Helpers\Helper;
use DB;


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
        $pinjamans = Pinjaman::where('no_kta', $request->no_kta)->where('status_pengajuan_pinjaman', 'approve')->get();
        $angsurans = Angsuran::where('no_transaksi_pinjaman', $no_transaksi);
        if($request->order){
            $angsurans = $angsurans->orderBy('created_at',$request->order);
        }
        $angsurans = $angsurans->paginate(5)->withQueryString();
        $pinjamanPilihan = Pinjaman::find($no_transaksi);
        $anggotaPilihan = Anggota::find($request->no_kta);
        try {
            $isSudahLunas = Angsuran::where('no_transaksi_pinjaman', $no_transaksi)->count() == $pinjamanPilihan->tenor_cicilan ? true : false;
            $Pokokpinjamanperbulan = round((int)$pinjamanPilihan->total_pinjam / (int)$pinjamanPilihan->tenor_cicilan);
            $Bungaperbulan = round(((int)$pinjamanPilihan->total_pinjam * ((int)$pinjamanPilihan->bunga / 100) / 12), 0);
            $cicilan = round($Pokokpinjamanperbulan + $Bungaperbulan, 0);
            if ($isSudahLunas) {
                $jmlCicilan = 0;
            } else {
                $jmlCicilan = (int)$pinjamanPilihan->tenor_cicilan - Angsuran::where('no_transaksi_pinjaman', $no_transaksi)->count();
            }
        } catch (\Throwable $th) {
            $isSudahLunas = false;
            $Pokokpinjamanperbulan = 0;
            $Bungaperbulan = 0;
            $jmlCicilan = 0;
            $cicilan = 0;
        }
        // $cicilan = Helper::revertMoney($cicilan);
        // $Bungaperbulan = Helper::revertMoney($Bungaperbulan);
        $totalSimpanan = $anggotaPilihan ? $anggotaPilihan->total_simpanan : 0;
        return view('pages.angsuran', compact('jmlCicilan', 'anggotaPilihan', 'isSudahLunas', 'cicilan', 'anggotas', 'no_transaksi', 'no_kta', 'pinjamans', 'angsurans', 'Pokokpinjamanperbulan', 'Bungaperbulan', 'totalSimpanan'));
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
        if($request->no_transaksi_pinjaman && $request->no_kta){
            $tenor_cicilan_dibayar = Angsuran::where('no_transaksi_pinjaman', $request->no_transaksi_pinjaman)->count();
            $pinjaman = Pinjaman::where('no_transaksi', $request->no_transaksi_pinjaman)->first();
            if ($tenor_cicilan_dibayar == $pinjaman->tenor_cicilan) {
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
                $angsuran->biaya_cicilan = $request->biaya_cicilan;
                $angsuran->biaya_bunga = $request->biaya_bunga;
                $angsuran->save();

                if ($request->isChecked) {
                    $anggota2 = Anggota::find($request->no_kta);
                    $hasil = (int)$anggota2->total_simpanan - ((int)$request->biaya_cicilan+(int)$request->biaya_bunga);
                    $anggota2->update(['total_simpanan' => $hasil]);
                }

                $pinjamanPilihan = Pinjaman::select('tenor_cicilan', 'total_pinjam')->where('no_transaksi', $request->no_transaksi_pinjaman)->first();
                $tenor_cicilan = $pinjamanPilihan->tenor_cicilan ? $pinjamanPilihan->tenor_cicilan : 0;
                $isSudahLunas = Angsuran::where('no_transaksi_pinjaman', $request->no_transaksi_pinjaman)->count() == $tenor_cicilan ? true : false;

                if ($isSudahLunas) {
                    // change user total pinjaman
                    $anggota = Anggota::find($request->no_kta);
                    $hasil = (int)$anggota->total_pinjaman - (int)$pinjamanPilihan->total_pinjam;
                    $anggota->update(['total_pinjaman' => $hasil]);
                }

                $getLatest = Angsuran::select('no_transaksi')->latest()->first();
                $getLatest = $getLatest->no_transaksi;

                return redirect()->to('/angsuran?no_kta=' . $request->no_kta . '&no_transaksi=' . $request->no_transaksi_pinjaman)->with('message', json_encode(['pesan' => 'Data Berhasil Diangsur', 'no_transaksi' => $getLatest]));;
            } catch (\Throwable $th) {
                //throw $th;
                dd($th);
                return redirect()->to('/angsuran?no_kta=' . $request->no_kta . '&no_transaksi=' . $request->no_transaksi_pinjaman)->with('error', 'Data gagal diapprove');;
            }
        }else{
            return redirect()->to('/angsuran')->with('error', 'Gagal angsur cicilan, cek nomor KTA dan nomor transaksi');;
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

    public function angsuran_all(Request $request)
    {
        //
        $data = DB::table('angsurans')->select('angsurans.no_transaksi', 'angsurans.no_kta', 'anggotas.nama_anggota', 'angsurans.tgl_angsuran', 'angsurans.biaya_cicilan', 'angsurans.biaya_bunga')->join('anggotas', 'anggotas.no_kta', '=', 'angsurans.no_kta')->orderBy('angsurans.updated_at', 'desc');
        if($q = $request->search){
            $data = $data->where('angsurans.no_kta','like','%'.$q.'%')
            ->orWhere('anggotas.nama_anggota','like','%'.$q.'%')
            ->orWhere('angsurans.tgl_angsuran','like','%'.$q.'%')
            ->orWhere('angsurans.biaya_cicilan','like','%'.$q.'%')
            ->orWhere('angsurans.biaya_bunga','like','%'.$q.'%');
        }

        return $data->get();
    }
}
