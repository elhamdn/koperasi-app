<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use App\Http\Helpers\Helper;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penguruses = Pengurus::paginate(5);

        return view('pages.pengurus', compact('penguruses'));
    }

    public function rekap_simpanan()
    {
        return view('pages.rekap');
    }

    public function rekap_pinjaman()
    {
        return view('pages.rekap-pinjaman');
    }

    public function get_simpanan()
    {
        $simpanan = Simpanan::join('anggotas', 'anggotas.no_kta', '=', 'simpanans.no_kta');

        return DataTables::of($simpanan->orderBy('simpanans.updated_at', 'asc')->get())->make(true);
    }

    public function cetak_simpanan($no_transaksi)
    {
        $data = Simpanan::select(
            'simpanans.*',
            'anggotas.nama_anggota'
        )->join('anggotas', 'simpanans.no_kta', '=', 'anggotas.no_kta')
            ->where('no_transaksi', $no_transaksi)
            ->first();

        return view('cetak.simpanan', compact('data'));
    }

    public function cetak_angsuran($no_transaksi)
    {
        $data = Angsuran::select(
            'angsurans.*',
            'pinjamen.*',
            'anggotas.nama_anggota'
        )->join('anggotas', 'angsurans.no_kta', '=', 'anggotas.no_kta')
            ->join('pinjamen', 'angsurans.no_transaksi_pinjaman', '=', 'pinjamen.no_transaksi')
            ->where('angsurans.no_transaksi', $no_transaksi)
            ->first();

        return view('cetak.angsuran', compact('data'));
    }

    public function rekap_angsuran()
    {
        return view('pages.rekap-angsuran');
    }

    public function get_pinjaman()
    {
        $Pinjaman = Pinjaman::join('anggotas', 'anggotas.no_kta', '=', 'pinjamen.no_kta');

        return DataTables::of($Pinjaman->orderBy('pinjamen.updated_at', 'asc')->get())->make(true);
    }

    public function get_angsuran()
    {
        $data = Angsuran::join('anggotas', 'anggotas.no_kta', '=', 'angsurans.no_kta');

        return DataTables::of($data->orderBy('angsurans.updated_at', 'asc')->get())->make(true);
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
            $Cek = Pengurus::where('email', $request->email)->orWhere('nip', $request->nip)->first();
            if ($Cek) {
                return redirect()->to('/master/pengurus')->with('error', 'Data sudah ada');;
            }

            $pengurus = new Pengurus();
            $pengurus->nip = $request->nip;
            $pengurus->email = $request->email;
            $pengurus->jenis_kelamin = $request->jenis_kelamin;
            $pengurus->nama_pengurus = $request->nama_pengurus;
            $pengurus->alamat_pengurus = $request->alamat_pengurus;
            $pengurus->jenis_pengurus = $request->jenis_pengurus;
            $pengurus->nomor_hp = $request->nomor_hp;
            $pengurus->password = Hash::make($request->password);
            $pengurus->save();

            return redirect()->to('/master/pengurus')->with('message', 'Data Berhasil');;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/master/pengurus')->with('error', 'Data gagal diapprove');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function show(Pengurus $pengurus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
            $pengurus = Pengurus::find($request->nip);
            $pengurus->email = $request->email;
            $pengurus->jenis_kelamin = $request->jenis_kelamin;
            $pengurus->jenis_pengurus = $request->jenis_pengurus;
            $pengurus->nama_pengurus = $request->nama_pengurus;
            $pengurus->alamat_pengurus = $request->alamat_pengurus;
            $pengurus->nomor_hp = $request->nomor_hp;
            if ($request->password) {
                $pengurus->password = Hash::make($request->password);
            }
            $pengurus->save();

            return redirect()->to('/master/pengurus')->with('message', 'Data Berhasil');;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/master/pengurus')->with('error', 'Data gagal diapprove');;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengurus $pengurus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengurus $pengurus)
    {
        //
    }

    public function dashboard()
    {
        $totalAnggota = Anggota::count();

        $totalSimpanan = Anggota::sum('total_simpanan');
        $totalPinjaman = Anggota::sum('total_pinjaman');
        $totalPinjaman = Helper::revertMoney($totalPinjaman);
        $totalSimpanan = Helper::revertMoney($totalSimpanan);

        // postgre
        // $totalSimpanan = DB::select(DB::raw("SELECT SUM(total_simpanan::decimal) as simpanan FROM anggotas"));
        // $totalPinjaman = DB::select(DB::raw("SELECT SUM(total_pinjaman::decimal) as total_pinjam FROM anggotas"));
        // $totalPinjaman = (new Helper)->revertMoney($totalPinjaman[0]->total_pinjam);
        // $totalSimpanan = (new Helper)->revertMoney($totalSimpanan[0]->simpanan);

        $simpanan = DB::table('simpanans')->join('anggotas', 'anggotas.no_kta', 'simpanans.no_kta')->whereDate('simpanans.created_at', Carbon::today())->limit(5)->get();
        $angsuran = DB::table('angsurans')->join('anggotas', 'anggotas.no_kta', 'angsurans.no_kta')->whereDate('angsurans.created_at', Carbon::today())->limit(5)->get();

        $grafikAngsuran = DB::select(DB::raw("select count(*) as totalMothly, sum(biaya_bunga)+sum(biaya_cicilan) as total_biaya, MONTH(tgl_angsuran) as bulan from angsurans group by month(tgl_angsuran) limit 6;"));
        $grafikSimpanan = DB::select(DB::raw("select count(*) as totalMothly, sum(deposit) as total_biaya, MONTH(tgl_deposit) as bulan from simpanans group by month(tgl_deposit) limit 6;"));

        // postgre
        // $grafikAngsuran = DB::select(DB::raw("select count(*) as totalMothly, sum(biaya_bunga::decimal)+sum(biaya_cicilan::decimal) as total_biaya, EXTRACT(MONTH FROM tgl_angsuran) as bulan from angsurans group by EXTRACT(MONTH FROM tgl_angsuran) limit 6;"));
        // $grafikSimpanan = DB::select(DB::raw("select count(*) as totalMothly, sum(deposit_pokok::decimal)+sum(deposit_wajib::decimal) as total_biaya, EXTRACT(MONTH FROM tgl_deposit) as bulan from simpanans group by EXTRACT(MONTH FROM tgl_deposit) limit 6;"));

        return view('pages.dashboard', compact('totalAnggota', 'totalSimpanan', 'totalPinjaman', 'angsuran', 'simpanan', 'grafikSimpanan', 'grafikAngsuran'));
    }
}
