<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB;

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
        $pinjamans = DB::table('pinjamen')->join('anggotas', 'anggotas.no_kta', '=', 'pinjamen.no_kta')->where('pinjamen.no_kta', $no_kta)->paginate(5)->withQueryString();
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
        $user = Auth::guard('anggota')->user();
        try {
            $latestNomorTransaksi = Pinjaman::select('no_transaksi')->latest()->first();
            $dataPinjaman = new Pinjaman;
            if ($latestNomorTransaksi) {
                $dataPinjaman->no_transaksi = $latestNomorTransaksi->no_transaksi + 1;
            } else {
                $dataPinjaman->no_transaksi = 1;
            }
            $dataPinjaman->no_kta = $user->no_kta;
            $dataPinjaman->tenor_cicilan = $request->tenor_cicilan;
            $dataPinjaman->keterangan = $request->keterangan;
            $dataPinjaman->total_pinjam = str_replace(".", "", $request->total_pinjam);
            $dataPinjaman->tgl_pengajuan = Carbon::now();
            $dataPinjaman->bunga = 0;
            $dataPinjaman->status_pengajuan_pinjaman = 'pending';
            $dataPinjaman->save();
            return redirect()->to('/member/pinjaman')->with('message', 'Data Berhasil Ditambahkan');;
        } catch (\Throwable $th) {
            return redirect()->to('/member/pinjaman')->with('error', 'Data Gagal Ditambahkan');;
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

    public function pinjaman_all(Request $request)
    {
        //
        $data = DB::table('pinjamen')->select('pinjamen.no_transaksi', 'pinjamen.no_kta', 'anggotas.nama_anggota', 'pinjamen.status_pengajuan_pinjaman', 'pinjamen.tgl_pinjam','pinjamen.total_pinjam','pinjamen.tenor_cicilan','pinjamen.keterangan')->join('anggotas', 'anggotas.no_kta', '=', 'pinjamen.no_kta')->orderBy('pinjamen.updated_at', 'desc');
        if($q = $request->search){
            $data = $data->where('pinjamen.no_kta','like','%'.$q.'%')
            ->orWhere('pinjamen.tgl_pinjam','like','%'.$q.'%')
            ->orWhere('pinjamen.total_pinjam','like','%'.$q.'%')
            ->orWhere('anggotas.nama_anggota','like','%'.$q.'%')
            ->orWhere('pinjamen.status_pengajuan_pinjaman','like','%'.$q.'%')
            ->orWhere('pinjamen.total_pinjam','like','%'.$q.'%')
            ->orWhere('pinjamen.tenor_cicilan','like','%'.$q.'%')
            ->orWhere('pinjamen.keterangan','like','%'.$q.'%');
        }

        return $data->get();
    }

}
