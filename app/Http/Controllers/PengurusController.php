<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;

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
            dd($th);
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
            dd($th);
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
        $totalSimpanan = DB::table('anggotas')->sum('total_simpanan');
        $totalPinjaman = DB::table('anggotas')->sum('total_pinjaman');
        $totalPinjaman = Helper::revertMoney($totalPinjaman);
        $totalSimpanan = Helper::revertMoney($totalSimpanan);

        $simpanan = DB::table('simpanans')->join('anggotas','anggotas.no_kta','simpanans.no_kta')->whereDate('simpanans.created_at', Carbon::today())->limit(5)->get();
        $angsuran = DB::table('angsurans')->join('anggotas','anggotas.no_kta','angsurans.no_kta')->whereDate('angsurans.created_at', Carbon::today())->limit(5)->get();

        $grafikAngsuran = DB::select(DB::raw("select count(*) as totalMothly, sum(biaya_bunga)+sum(biaya_cicilan) as total_biaya, MONTH(tgl_angsuran) as bulan from angsurans group by month(tgl_angsuran) limit 6;"));
        $grafikSimpanan = DB::select(DB::raw("select count(*) as totalMothly, sum(deposit_pokok)+sum(deposit_wajib) as total_biaya, MONTH(tgl_deposit) as bulan from simpanans group by month(tgl_deposit) limit 6;"));

        return view('pages.dashboard', compact('totalAnggota', 'totalSimpanan', 'totalPinjaman', 'angsuran', 'simpanan', 'grafikSimpanan', 'grafikAngsuran'));
    }
}
