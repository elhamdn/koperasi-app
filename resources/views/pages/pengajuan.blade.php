@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Pengajuan')

@section('content-app')
<h2 class="mt-2 mb-5">Pengajuan</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-secondary text-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:5px; pading-bottom:5px">
                        Pilih Anggota
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($anggotas as $anggota)
                        <li><a class="dropdown-item" href="{{ url('/pengajuan?no_kta='.$anggota->no_kta) }}">{{ $anggota->nama_anggota }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-control" id="basicInput"><label for="basicInput">Nomor KTA : {{$no_kta}}</label></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">No. Transaksi</th>
                            <th>Status Pengajuan</th>
                            <th>Total Pinjaman</th>
                            <th>Tenor Cicilan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($pinjamans) == 0)
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="m-3">
                                        <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                        <span>Data Tidak Ditemukan</span>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        @foreach ($pinjamans as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
                            <td class="align-middle">{{ $data->status_pengajuan_pinjaman }}</td>
                            <td class="align-middle">{{ $Helper->revertMoney($data->total_pinjam) }}</td>
                            <td class="align-middle">{{ $data->tenor_cicilan }} Bulan</td>

                            <td class="align-middle">
                                <button class="btn btn-secondary text-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:5px; pading-bottom:5px">
                                    <i class="fa fa-gear"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><span class="dropdown-item" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#viewDetail{{$data->no_transaksi}}">View Detail</span></li>

                                    @if ($data->status_pengajuan_pinjaman == 'pending')
                                    
                                    <li><span class="dropdown-item" style="cursor: pointer" data-toggle="modal" data-target="#modalApprove-{{$data->no_transaksi}}">Approve</span></li>
                                    <li><span class="dropdown-item" style="cursor: pointer" data-toggle="modal" data-target="#exampleModal-{{$data->no_transaksi}}">Reject</span></li>
                                    @endif
                                </ul>

                                <!--scrollbar Modal -->
                                <div class="modal fade" id="viewDetail{{$data->no_transaksi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Detail Pengajuan </h4>
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
                                                            <div class="form-control">{{ $data->no_kta }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Nama Anggota: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->nama_anggota }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>No. Handphone Anggota: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->nomor_hp }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Alamat Anggota: </label>
                                                        <div class="form-group">
                                                            <div class="form-control" style="min-height: 120px;white-space: initial">{{ $data->alamat_anggota }}</div>
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
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($data->status_pengajuan_pinjaman == 'pending')
                                <div class="modal fade" id="modalApprove-{{$data->no_transaksi}}" tabindex="-1" role="dialog" aria-labelledby="modalApprove-{{$data->no_transaksi}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Approve Pengajuan Pinjaman</h5>
                                                <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ url('/pengajuan/approve') }}" target="invisible">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="no_kta" value="{{ $no_kta }}">
                                                    <input type="hidden" name="no_transaksi" value="{{ $data->no_transaksi }}">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Bunga</label>
                                                        <input type="number" name="bunga" class="form-control" id="exampleInputEmail1" min="0" max="100" required placeholder="persen bunga">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Alasan Diapprove</label>
                                                        <textarea class="form-control" name="alasan_approval" id="exampleFormControlTextarea1" rows="3">
                                                            </textarea>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="exampleModal-{{$data->no_transaksi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reject Pengajuan Pinjaman </h5>
                                                <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ url('/pengajuan/reject') }}" target="invisible">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="no_kta" value="{{ $no_kta }}">
                                                    <input type="hidden" name="no_transaksi" value="{{ $data->no_transaksi }}">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Alasan Direject</label>
                                                        <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3">
                                                            </textarea>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $pinjamans->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection