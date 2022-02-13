@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.anggota-layout')

@section('page-title', 'Simpanan')

@section('content-app')
<h2 class="mt-2 mb-5">Simpanan</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3"></div>
        <div class="col-md-12">
            <div class="row">
                @foreach ($simpanan as $data)
                    <div class="col-md-6 pl-2 pr-2">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">No. Transaksi : {{$data->no_transaksi}}</h5>

                            <table>
                                <tr>
                                    <td>Deposit Pokok </td>
                                    <td>: </td>
                                    <td>{{$Helper->revertMoney($data->deposit_pokok)}}</td>
                                </tr>
                                <tr>
                                    <td>Deposit Wajib</td>
                                    <td>: </td>
                                    <td>{{$Helper->revertMoney($data->deposit_wajib)}}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: </td>
                                    <td>{{$data->keterangan}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Deposit</td>
                                    <td>: </td>
                                    <td>{{$data->tgl_deposit}}</td>
                                </tr>
                            </table>
                            
                            <button class="btn btn-primary mt-2" type="button" data-bs-toggle="modal" data-bs-target="#viewDetail{{$data->no_transaksi}}">Detail</button>

                            <!--scrollbar Modal -->
                            <div class="modal fade" id="viewDetail{{$data->no_transaksi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Detail Simpanan </h4>
                                            <span data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                        </div>
                                        <div class="modal-body text-left">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>No Transaksi: </label>
                                                    <div class="form-group">
                                                        <div class="form-control">{{ $data->no_transaksi }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>No. KTA: </label>
                                                    <div class="form-group">
                                                        <div class="form-control">{{ $user->no_kta }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nama Anggota: </label>
                                                    <div class="form-group">
                                                        <div class="form-control">{{ $user->nama_anggota }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Deposit Pokok: </label>
                                                    <div class="form-group">
                                                        <div class="form-control">{{ $Helper->revertMoney($data->deposit_pokok) }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Deposit Wajib: </label>
                                                    <div class="form-group">
                                                        <div class="form-control">{{ $Helper->revertMoney($data->deposit_wajib) }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tanggal Deposit: </label>
                                                    <div class="form-group">
                                                        <div class="form-control">{{ $data->tgl_deposit }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Keterangan: </label>
                                                    <div class="form-group">
                                                        <div class="form-control" style="min-height: 120px;white-space: initial">{{ $data->keterangan }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary"data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $simpanan->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection