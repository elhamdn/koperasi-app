@extends('layouts.layout')

@section('page-title', 'Simpanan')

@section('content-app')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex flex-column align-items-start">
                <div class="d-flex">
                    <div class="dropdown mx-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Anggota
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($anggotas as $anggota)
                            <li><a class="dropdown-item" href="{{ url('/simpanan?no_kta='.$anggota->no_kta) }}">{{ $anggota->nama_anggota }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        Nomor KTA : {{$no_kta}}
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-success mx-3" type="button" data-toggle="modal" data-target="#modalSimpanan">Tambah Simpanan</button>
                    <div class="modal fade" id="modalSimpanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Deposit Pinjaman</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ url('/simpanan/add') }}" target="invisible">
                                        @csrf
                                        <input type="hidden" name="no_kta" value="{{ $no_kta }}">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Deposit Wajib</label>
                                            <input type="number" name="deposit_wajib" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Deposit Wajib">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Uang Diterima</label>
                                            <input type="number" name="total" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Jumlah Uang Diterima">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
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
                            <th>Tanggal Deposit</th>
                            <th>Deposit Pokok</th>
                            <th>Deposit Wajib</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($simpanans as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
                            <td class="align-middle"> {{ $data->tgl_deposit}}</td>
                            <td class="align-middle">Rp. {{ $data->deposit_pokok }}</td>
                            <td class="align-middle">Rp. {{ $data->deposit_wajib }}</td>
                            <td class="align-middle"> {{ $data->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $simpanans->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection