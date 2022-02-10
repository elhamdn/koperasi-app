<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
