@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Master Anggota')

@section('content-app')
<h2 class="mt-2 mb-5">Anggota</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-md-9"></div>
            <div class="col-md-3 text-right p-0">
                <div class="form-group">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalFormAnggota">Tambah Anggota</button>
                </div>
            </div>

            <div class="modal fade" id="modalFormAnggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ url('/anggota/add') }}" target="invisible">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput0">Nomor KTA</label>
                                <input type="text" name="no_kta" class="form-control" id="exampleFormControlInput0" required placeholder="Nomor KTA">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput">Nama Anggota</label>
                                <input type="text" name="nama_anggota" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" required placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleFormControlInput2" required placeholder="password">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput">Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin" class="form-control" id="exampleFormControlInput" required placeholder="P atau L">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput3">Alamat</label>
                                <input type="text" name="alamat_anggota" class="form-control" id="exampleFormControlInput3" required placeholder="alamat">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput4">Nomor Handphone</label>
                                <input type="text" name="nomor_hp" class="form-control" id="exampleFormControlInput4" required placeholder="Nomor HP">
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
        <div class="card">

            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">Nomor KTA</th>
                            <th>Email</th>
                            <th>Nama Anggota</th>
                            <th>Total Pinjaman</th>
                            <th>Total Simpanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggotas as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->no_kta }}</th>
                            <td class="align-middle"> {{ $data->email}}</td>
                            <td class="align-middle"> {{ $data->nama_anggota }}</td>
                            <td class="align-middle">{{ $Helper->revertMoney($data->total_pinjaman) }}</td>
                            <td class="align-middle">{{ $Helper->revertMoney($data->total_simpanan) }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editAnggotaModal-{{$data->no_kta}}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editAnggotaModal-{{$data->no_kta}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Detail Pengajuan </h4>
                                                <span data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                            </div>
                                            <form method="post" action="{{ url('/anggota/edit') }}" target="invisible">
                                                @csrf
                                                <div class="modal-body text-left">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>No KTA: </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$data->no_kta}}" disabled name="no_kta" class="form-control" id="exampleFormControlInput0" required placeholder="Nomor KTA">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email: </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$data->nama_anggota}}" name="nama_anggota" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Password: </label>
                                                            <div class="form-group">
                                                                <input type="password" name="password" class="form-control" id="exampleFormControlInput2" placeholder="password">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Nama Anggota: </label>
                                                            <div class="form-group">
                                                                <div class="form-control">{{ $data->nama_anggota }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Jenis Kelamin: </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$data->jenis_kelamin}}" name="jenis_kelamin" class="form-control" id="exampleFormControlInput" required placeholder="P atau L">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Nomor Handphone: </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$data->nomor_hp}}" name="nomor_hp" class="form-control" id="exampleFormControlInput4" required placeholder="Nomor HP">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Alamat Anggota: </label>
                                                            <div class="form-group">
                                                                <textarea rows="3" value="{{$data->alamat_anggota}}" name="alamat_anggota" class="form-control" id="exampleFormControlInput3" required placeholder="alamat"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewAnggotaModal-{{$data->no_kta}}">
                                    Detail
                                </button>
                                <div class="modal fade" id="viewAnggotaModal-{{$data->no_kta}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Detail Pengajuan </h4>
                                                <span data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                            </div>
                                            <div class="modal-body text-left">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>No KTA: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->no_kta }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Email: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->email }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Nama Anggota: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->nama_anggota }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Jenis Kelamin: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Alamat Anggota: </label>
                                                        <div class="form-group">
                                                            <div class="form-control" style="min-height: 120px;white-space: initial">{{ $data->alamat_anggota }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Total Pinjaman: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $Helper->revertMoney($data->total_pinjaman) }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Total Simpanan: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $Helper->revertMoney($data->total_simpanan) }}</div>
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $anggotas->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection