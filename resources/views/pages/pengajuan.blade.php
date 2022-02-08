@extends('layouts.layout')

@section('page-title', 'Pengajuan')

@section('content-app')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="dropdown mx-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Pilih Anggota
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($anggotas as $anggota)
                        <li><a class="dropdown-item" href="{{ url('/pengajuan?no_kta='.$anggota->no_kta) }}">{{ $anggota->nama_anggota }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    Nomor KTA : {{$no_kta}}
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">Nomor transaksi</th>
                            <th>Aksi</th>
                            <th>Status Pengajuan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Total Pinjaman</th>
                            <th>Keterangan</th>
                            <th>Tenor Cicilan</th>
                            <th>Bunga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjamans as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
                            <td class="align-middle">
                                @if ($data->status_pengajuan_pinjaman == 'pending')
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalApprove-{{$data->no_transaksi}}">
                                    Approve
                                </button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal-{{$data->no_transaksi}}">
                                    Reject
                                </button>
                                <div class="modal fade" id="modalApprove-{{$data->no_transaksi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Approve Pengajuan Pinjaman</h5>
                                                <button type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ url('/pengajuan/approve') }}" target="invisible">
                                                    @csrf
                                                    <input type="hidden" name="no_kta" value="{{ $no_kta }}">
                                                    <input type="hidden" name="no_transaksi" value="{{ $data->no_transaksi }}">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Alasan Diapprove</label>
                                                        <textarea class="form-control" name="alasan_approval" id="exampleFormControlTextarea1" rows="3">
                                                            </textarea>
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

                                <div class="modal fade" id="exampleModal-{{$data->no_transaksi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reject Pengajuan Pinjaman </h5>
                                                <button type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ url('/pengajuan/reject') }}" target="invisible">
                                                    @csrf
                                                    <input type="hidden" name="no_kta" value="{{ $no_kta }}">
                                                    <input type="hidden" name="no_transaksi" value="{{ $data->no_transaksi }}">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Alasan Direject</label>
                                                        <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3">
                                                            </textarea>
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
                                @else
                                -
                                @endif

                            </td>
                            <td class="align-middle">{{ $data->status_pengajuan_pinjaman }}</td>
                            <td class="align-middle"> {{ $data->tgl_pengajuan }}</td>
                            <td class="align-middle">Rp. {{ $data->total_pinjam }}</td>
                            <td class="align-middle"> {{ $data->keterangan }}</td>
                            <td class="align-middle">{{ $data->tenor_cicilan }} Bulan</td>
                            <td class="align-middle">{{ $data->bunga }}</td>
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