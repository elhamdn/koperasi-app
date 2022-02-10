@extends('layouts.layout')

@section('page-title', 'Angsuran')

@section('content-app')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex flex-column align-items-start">
                <div class="d-flex justify-content-between w-100">
                    <div class="dropdown mx-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Anggota
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($anggotas as $anggota)
                            <li><a class="dropdown-item" href="{{ url('/angsuran?no_kta='.$anggota->no_kta) }}">{{ $anggota->nama_anggota }}</a></li>
                            @endforeach
                        </ul>
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Pinjaman
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($pinjamans as $pinjaman)
                            <li><a class="dropdown-item" href="{{ url('/angsuran?no_kta='.$no_kta.'&no_transaksi='.$pinjaman->no_transaksi) }}">{{ $pinjaman->no_transaksi }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <div>
                            Nomor KTA : {{$no_kta}}

                        </div>
                        <div>
                            Nomor Transaksi : {{$no_transaksi}}
                        </div>
                    </div>
                </div>
                <div class="m-2 w-100">
                    @if ($isSudahLunas)
                    <b class="text-success">Pinjaman Sudah Lunas</b>
                    @else
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalTambahAngsuran">Tambah Angsuran</button>
                        <div>Sisa {{$jmlCicilan}} Angsuran</div>
                    </div>
                    @endif
                    <div class="modal fade" id="modalTambahAngsuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Menambah Angsuran Pinjaman</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ url('/angsuran/add') }}" target="invisible">
                                        @csrf
                                        <span>Cicilan Yang Harus Dibayar : Rp. {{$cicilan}}</span>
                                        <br>
                                        <span>Simpanan Anda : Rp. {{$anggotaPilihan->total_pinjaman}}</span>
                                        <br>
                                        <div>
                                            <input class="m-2" type="checkbox" name="isChecked" id="flexCheckChecked">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Pakai Uang Simpanan?
                                            </label>
                                        </div>
                                        <input type="hidden" name="no_kta" value="{{ $no_kta }}">
                                        <input type="hidden" name="no_transaksi_pinjaman" value="{{ $no_transaksi }}">
                                        <input type="hidden" name="cicilan" value="{{ $cicilan }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">Nomor transaksi</th>
                            <th>Tanggal Angsuran</th>
                            <th>Total Angsuran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($angsurans as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
                            <td class="align-middle"> {{ $data->tgl_angsuran}}</td>
                            <td class="align-middle">Rp. {{ $data->total_angsuran }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $angsurans->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection