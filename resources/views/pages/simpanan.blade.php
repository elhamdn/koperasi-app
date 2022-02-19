@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Simpanan')

@section('content-app')
<h2 class="mt-2 mb-5">Simpanan</h2>

<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-md-12">
                @if (\Session::has('error'))
                    <div class="alert alert-light-danger color-danger"><i class="fas fa-circle-exclamation mr-2"></i> {!! \Session::get('error') !!}</div>
                @endif
                @if (\Session::has('message'))
                    <div class="alert alert-light-success color-success"><i class="fas fa-check mr-2"></i> {!! \Session::get('message') !!}</div>
                @endif
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-secondary text-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Anggota
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($anggotas as $anggota)
                        <li><a class="dropdown-item" href="{{ url('/simpanan?no_kta='.$anggota->no_kta) }}">{{ $anggota->nama_anggota }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-control" id="basicInput"><label for="basicInput">Nomor KTA : {{$no_kta}}</label></div>
                </div>
            </div>
            <div class="col-md-3 text-right mb-2">
                @if ($totalSimpanan && $totalSimpanan->total_simpanan > 0)
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalTarikSimpanan">Tarik Dana</button>
                @endif
            </div>

            <div class="modal fade" id="modalTarikSimpanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tarik Dana Simpanan</h5>
                            <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/simpanan/withdraw') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="no_kta" value="{{ $no_kta }}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jumlah Uang</label>
                                    <input type="number" name="total" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Jumlah Uang Diterima">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-right">
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalSimpanan">Tambah Simpanan</button>
            </div>

            <div class="modal fade" id="modalSimpanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Simpanan</h5>
                            <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ url('/simpanan/add') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                            <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">

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

                        @if (count($simpanans) == 0)
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="m-3">
                                        <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                        <span>Data Tidak Ditemukan</span>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        @foreach ($simpanans as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
                            <td class="align-middle"> {{ $data->tgl_deposit}}</td>
                            <td class="align-middle">{{ $Helper->revertMoney($data->deposit_pokok) }}</td>
                            <td class="align-middle">{{ $Helper->revertMoney($data->deposit_wajib) }}</td>
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