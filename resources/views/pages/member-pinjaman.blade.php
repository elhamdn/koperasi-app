@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.anggota-layout')

@section('page-title', 'Pinjaman')

@section('content-app')
<header class="mb-3">
    <div class="row">

        <div class="col-md-12 mb-3 text-right">
            <a href="#" class="d-inline burger-btn d-block d-xl-none float-left mt-3">
                <i class="fas fa-bars fs-3"></i>
            </a>

            <div class="dropdown show">
                <h2 class="d-inline p-2">{{$user->nama_anggota}}</h2>
                <img src="{{ URL::to('/') }}/data_file/{{$user->profile_picture}}" alt="" srcset="" style="border-radius:50px;width: 50px;height: 50px;background-position: center center;background-repeat: no-repeat;"  href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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
    <h2 class="mt-2 mb-5">Pinjaman</h2>
    <div class="row row-cards">
        <div class="col-12">
            <div class="row mb-3" style="padding-right: 10px">
                <div class="col-md-9"></div>
                <div class="col-md-3 text-right">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalPengajuan">Pengajuan</button>
                </div>
                <div class="modal fade" id="modalPengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pengajuan Pinjaman</h5>
                                <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ url('/member/pengajuan-pinjaman') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jumlah Uang</label>
                                        <input type="number" name="total_pinjam" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Jumlah Uang">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tenor Cicilan</label>
                                        <input type="number" name="tenor_cicilan" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Tenor Cicilan">
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
            <div class="col-md-12">
                <div class="row">
                    @foreach ($pinjaman as $data)
                        <div class="col-md-6 pl-2 pr-2">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">No. Transaksi : {{$data->no_transaksi}}</h5>

                                <table>
                                    <tr>
                                        <td><span class="text-secondary">Status</span></td>
                                        <td>: </td>
                                        <td>{{$data->status_pengajuan_pinjaman}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Total Pinjaman</span></td>
                                        <td>: </td>
                                        <td>{{$Helper->revertMoney($data->total_pinjam)}}</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Tenor Cicilan</span></td>
                                        <td>: </td>
                                        <td>{{$data->tenor_cicilan}} Bulan</td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Sisa Cicilan</span></td>
                                        <td>: </td>
                                        <td>
                                            @foreach($angsuran as $a)
                                            @if($a->no_transaksi_pinjaman == $data->no_transaksi)
                                                {{$data->tenor_cicilan - $a->total}} Bulan
                                            @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                                
                                <button class="btn btn-primary mt-2" type="button" data-bs-toggle="modal" data-bs-target="#viewDetail{{$data->no_transaksi}}">Detail</button>

                                <!--scrollbar Modal -->
                                <div class="modal fade" id="viewDetail{{$data->no_transaksi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Detail Pengajuan Pinjaman </h4>
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
                                                        <label>Tgl Pengajuan: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->created_at }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Total Pinjaman: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $Helper->revertMoney($data->total_pinjam) }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tenor Cicilan: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->tenor_cicilan }} Bulan </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Bunga Cicilan: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->bunga }}%</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Sisa Cicilan: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">
                                                            @foreach($angsuran as $a)
                                                            @if($a->no_transaksi_pinjaman == $data->no_transaksi)
                                                                {{$data->tenor_cicilan - $a->total}} Bulan
                                                            @endif
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Keterangan: </label>
                                                        <div class="form-group">
                                                            <div class="form-control" style="min-height: 120px;white-space: initial">{{ $data->keterangan }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Status Pinjaman: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->status_pengajuan_pinjaman }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tanggal Approval: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->tgl_pinjam }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Alasan Approval: </label>
                                                        <div class="form-group">
                                                            <div class="form-control" style="min-height: 120px;white-space: initial">{{ $data->alasan_approval }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Angsuran: </label>
                                                        <table class="table table-hover text-center" style="font-size: 10px">
                                                            <thead>
                                                                <tr>
                                                                    <td scope="col">No.</td>
                                                                    <td scope="col">Bunga</td>
                                                                    <td scope="col">Cicilan</td>
                                                                    <td scope="col">Total</td>
                                                                    <td scope="col">Tanggal</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            @php $i = 1 @endphp
                                                            @foreach($list_angsuran as $a)
                                                            @if($a->no_transaksi_pinjaman == $data->no_transaksi)
                                                                <tr>
                                                                    <td scope="row">{{$i}}</td>
                                                                    <td>{{$a->biaya_bunga}}</td>
                                                                    <td>{{$a->biaya_cicilan}}</td>
                                                                    <td>{{$a->biaya_bunga+$a->biaya_cicilan}}</td>
                                                                    <td>{{$a->tgl_angsuran}}</td>
                                                                </tr>
                                                                @php $i++ @endphp
                                                            @endif
                                                            @endforeach
                                                            </tbody>
                                                        </table>
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
                {!! $pinjaman->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection