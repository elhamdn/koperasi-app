@extends('layouts.anggotaTemplate')

@section('css')
<style>
    body {
        margin: 0;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        background-color: white;
    }

    .header-container li {
        list-style-type: none;
        margin: 0 14px;
    }

    .header-container li a {
        color: black;
        text-decoration: none;
    }

    .header-content {
        display: flex;
        flex: 2;
        justify-content: center;
    }

    .header-logout {}

    .container {
        background-color: lightgray;
        max-width: 100%;
        display: flex;
        justify-content: center;
        min-height: calc(100vh - 50px);
    }

    main {
        background-color: white;
        width: 70%;
        padding: 20px;
    }

    main section span {
        display: block;
        font-weight: 500;
    }

    main>h4 {
        color: black;
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<header class="header-container">
    <div class="header-content">
        <li>
            <a href="#Pinjaman">Pinjaman</a>
        </li>
        <li>
            <a href="#Profile">Profile</a>
        </li>
    </div>
    <div class="header-logout">
        <li>
            <a href="{{ url('logout') }}">Logout</a>
        </li>
    </div>
</header>
<div class="container">
    <main>
        <section id="Pinjaman">
            <h5>Pinjaman yang berlangsung</h5>
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Nomor Transaksi</th>
                        <th scope="col">Status Pengajuan</th>
                        <th scope="col">Total Pinjaman</th>
                        <th scope="col">Tenor Cicilan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjaman as $data)
                    <tr class="text-center">
                        <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
                        <td class="align-middle">{{ $data->status_pengajuan_pinjaman }}</td>
                        <td class="align-middle">Rp. {{ $data->total_pinjam }}</td>
                        <td class="align-middle">{{ $data->tenor_cicilan }} Bulan</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span>Total Pinjaman : Rp. {{$user->total_pinjaman}}</span>
            <span>Total Simpanan : Rp. {{$user->total_simpanan}}</span>

            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#exampleModal">
                Ajukan Pinjaman
            </button>


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pengajuan Peminjaman</h5>
                            <button type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/pengajuan-pinjaman') }}" target="invisible">
                                @csrf
                                <input type="hidden" name="no_kta" value="{{ $user->no_kta }}">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Total Pinjam</label>
                                    <input type="number" name="total_pinjam" class="form-control mr-3" id="exampleFormControlInput1" placeholder="0" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Tenor Cicilan</label>
                                    <input type="number" name="tenor_cicilan" class="form-control" id="exampleFormControlInput2" placeholder="0" min="0" max="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Keterangan Peminjaman</label>
                                    <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section id="Profile">
            <h5>Biodata</h5>
            data diri sendiri
        </section>
    </main>
</div>
@endsection