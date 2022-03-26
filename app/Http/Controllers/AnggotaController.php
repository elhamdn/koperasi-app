<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use DB;
use Validator;
use Illuminate\Support\Facades\Storage;

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

    public function index_master(Request $request)
    {
        $anggotas = Anggota::paginate(5);

        return view('pages.anggota', compact('anggotas'));
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
            $anggotaCek = Anggota::where('email', $request->email)->orWhere('no_kta', $request->no_kta)->first();
            if ($anggotaCek) {
                return redirect()->to('/master/anggota')->with('error', 'Data sudah ada');;
            }

            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');

            $nama_file = time()."_".$file->getClientOriginalName();
        
                // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'data_file';
            $file->move($tujuan_upload,$nama_file);

            $anggota = new Anggota();
            $anggota->no_kta = $request->no_kta;
            $anggota->email = $request->email;
            $anggota->jenis_kelamin = $request->jenis_kelamin;
            $anggota->nama_anggota = $request->nama_anggota;
            $anggota->alamat_anggota = "'" . $request->alamat_anggota . "'";
            $anggota->nomor_hp = $request->nomor_hp;
            $anggota->password = Hash::make($request->password);
            $anggota->total_pinjaman = 0;
            $anggota->total_simpanan = 0;
            $anggota->profile_picture = $nama_file;

            $anggota->save();

            return redirect()->to('/master/anggota')->with('message', 'Data Berhasil');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->to('/master/anggota')->with('error', 'Gagal Membuat Data Baru, Periksa kembali Inputan Anda');
        }

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
    public function edit(Request $request)
    {
        try {
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('file');

            $nama_file = time()."_".$file->getClientOriginalName();
        
                // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'data_file';
            $file->move($tujuan_upload,$nama_file);

            $anggota = Anggota::find($request->no_kta);
            $anggota->email = $request->email;
            $anggota->jenis_kelamin = $request->jenis_kelamin;
            $anggota->nama_anggota = $request->nama_anggota;
            $anggota->alamat_anggota = $request->alamat_anggota;
            $anggota->nomor_hp = $request->nomor_hp;
            $anggota->profile_picture = $nama_file;
            if ($request->password) {
                $anggota->password = Hash::make($request->password);
            }
            $anggota->save();

            return redirect()->to('/master/anggota')->with('message', 'Data Berhasil');;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/master/anggota')->with('error', 'Data gagal diapprove');;
        }
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

    public function indexMember(Request $request)
    {
        $user = Auth::guard('anggota')->user();
        $pinjaman = Pinjaman::where('no_kta', $user->no_kta)->get();

        $angsuran = Angsuran::where('no_kta', $user->no_kta)->latest('tgl_angsuran')->limit(5)->get();
        $simpanan = Simpanan::where('no_kta', $user->no_kta)->latest('tgl_deposit')->limit(5)->get();

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
        return view('pages.home', compact('isSudahLunas', 'user', 'pinjaman', 'angsurans', 'no_transaksi_pilihan', 'angsuran', 'simpanan'));
    }

    public function pinjamanMember(Request $request)
    {
        $user = Auth::guard('anggota')->user();

        try {

            $pinjaman = Pinjaman::where('no_kta', $user->no_kta)->latest('created_at')->paginate(5)->withQueryString();
            $angsuran = DB::select(DB::raw("select count(*) as total, no_transaksi_pinjaman from angsurans WHERE no_kta = '" . $user->no_kta . "' group by no_transaksi_pinjaman;"));
            $list_angsuran = Angsuran::where('no_kta', $user->no_kta)->latest('created_at')->get();
        } catch (\Throwable $th) {
            dd($th);
        }
        return view('pages.member-pinjaman', compact('pinjaman', 'user', 'angsuran', 'list_angsuran'));
    }

    public function simpananMember(Request $request)
    {
        $user = Auth::guard('anggota')->user();

        try {
            $simpanan = Simpanan::where('no_kta', $user->no_kta)->latest('created_at')->paginate(5)->withQueryString();
        } catch (\Throwable $th) {
            dd($th);
        }
        return view('pages.member-simpanan', compact('simpanan', 'user'));
    }

    public function angsuranMember(Request $request)
    {
        $user = Auth::guard('anggota')->user();

        try {
            $angsuran = Angsuran::where('no_kta', $user->no_kta)->latest('created_at')->paginate(5)->withQueryString();
        } catch (\Throwable $th) {
            dd($th);
        }
        return view('pages.member-angsuran', compact('angsuran', 'user'));
    }

    public function profileMember(Request $request)
    {
        $user = Auth::guard('anggota')->user();
        return view('pages.member-profile', compact('user'));
    }

    public function ubahProfileMember(Request $request)
    {
        try {
            $user = Auth::guard('anggota')->user();

            $anggota = Anggota::find($user->no_kta);

            $anggota->email = $request->email;
            $anggota->jenis_kelamin = $request->jenis_kelamin;
            $anggota->nama_anggota = $request->nama_anggota;
            $anggota->alamat_anggota = $request->alamat_anggota;
            $anggota->nomor_hp = $request->nomor_hp;
            $anggota->save();

            return redirect()->to('/member/profile')->with('message', 'Data Berhasil Terubah');;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/member/profile')->with('error', 'Data gagal Terubah');;
        }
    }

    public function ubahPasswordMember(Request $request)
    {
        try {
            $user = Auth::guard('anggota')->user();

            if (Hash::check($request->password_lama, $user->password)) {
                $anggota = Anggota::find($user->no_kta);

                $anggota->password = Hash::make($request->password_baru);
                $anggota->save();
                return redirect()->to('/member/profile')->with('message', 'Password Berhasil Terubah');
            }

            return redirect()->to('/member/profile')->with('error', 'Password Lama Tidak Sesuai');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/member/profile')->with('error', 'Password gagal Terubah');;
        }
    }
}
