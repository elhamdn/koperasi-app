@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.anggota-layout')

@section('page-title', 'Angsuran')

@section('content-app')
<header class="mb-3">
    <div class="row">

    <div class="col-md-12 mb-3 text-right">
        <a href="#" class="d-inline burger-btn d-block d-xl-none float-left mt-3">
            <i class="fas fa-bars fs-3"></i>
        </a>

        <div class="dropdown show">
            <h2 class="d-inline p-2">{{$user->nama_anggota}}</h2>
            <i class="fas fa-user text-white bg-secondary" style="padding: 15px;border-radius: 50px; font-size: 20px" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>

            <div class="dropdown-menu dropdown-menu-right">
                <button class="dropdown-item" type="button">
                    <a href="{{ url('member/profile') }}" class="sidebar-link">
                        <i class="fas fa-user mr-2"></i>
                        <span>Profile</span>
                    </a>
                </button>
                <button class="dropdown-item" type="button">
                    <a href="{{ url('logout') }}" class="sidebar-link">
                        <i class="fas fa-arrow-right-from-bracket mr-2"></i>
                        <span>Keluar</span>
                    </a>
                </button>
            </div>
        </div>
    </div>
    </div>
</header>
<div class="page-content">
    <h2 class="mt-2 mb-5">Angsuran</h2>
    <div class="row row-cards">
        <div class="col-12">
            <div class="row mb-3"></div>
            <div class="col-md-12">
                <div class="row">
                    @foreach ($angsuran as $data)
                        <div class="col-md-6 pl-2 pr-2">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No. Transaksi Pinjaman : {{$data->no_transaksi_pinjaman}}</h5>

                                <table>
                                    <tr>
                                        <td><span class="text-secondary">Biaya Bunga</span></td>
                                        <td>: </td>
                                        <td>{{$Helper->revertMoney($data->biaya_bunga)}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Biaya Cicilan</span></td>
                                        <td>: </td>
                                        <td>{{$Helper->revertMoney($data->biaya_cicilan)}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Total Biaya</span></td>
                                        <td>: </td>
                                        <td>{{$Helper->revertMoney($data->biaya_cicilan+$data->biaya_bunga)}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Tanggal Angsuran</span></td>
                                        <td>: </td>
                                        <td>{{$data->tgl_angsuran}}</td>
                                    </tr>
                                </table>
                                
                                <button class="btn btn-primary mt-2" type="button" data-bs-toggle="modal" data-bs-target="#viewDetail{{$data->no_transaksi}}">Detail</button>

                                <!--scrollbar Modal -->
                                <div class="modal fade" id="viewDetail{{$data->no_transaksi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Detail Angsuran </h4>
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
                                                        <label>Biaya Bunga: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $Helper->revertMoney($data->biaya_bunga) }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Biaya Cicilan: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $Helper->revertMoney($data->biaya_cicilan) }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tanggal Angsuran: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->tgl_angsuran }}</div>
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
                {!! $angsuran->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection