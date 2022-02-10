@extends('layouts.layout')

@section('page-title', 'Master Anggota')

@section('content-app')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <button class="btn btn-success mx-3" type="button" data-toggle="modal" data-target="#modalFormAnggota">Tambah Anggota</button>
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
                </div>
            </div>

            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="row">Nomor KTA</th>
                            <th>Aksi</th>
                            <th>Email</th>
                            <th>Nama Anggota</th>
                            <th>Alamat Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor Hp</th>
                            <th>Total Pinjaman</th>
                            <th>Total Simpanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggotas as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->no_kta }}</th>
                            <td class="align-middle">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editAnggotaModal-{{$data->no_kta}}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editAnggotaModal-{{$data->no_kta}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
                                                <button type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ url('/anggota/edit') }}" target="invisible">
                                                    @csrf
                                                    <input type="hidden" name="no_kta" value="{{ $data->no_kta }}">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput0">Nomor KTA</label>
                                                        <input type="text" value="{{$data->no_kta}}" disabled name="no_kta" class="form-control" id="exampleFormControlInput0" required placeholder="Nomor KTA">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput">Nama Anggota</label>
                                                        <input type="text" value="{{$data->nama_anggota}}" name="nama_anggota" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Email</label>
                                                        <input type="email" value="{{$data->email}}" name="email" class="form-control" id="exampleFormControlInput1" required placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput2">Password</label>
                                                        <input type="password" name="password" class="form-control" id="exampleFormControlInput2" placeholder="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput">Jenis Kelamin</label>
                                                        <input type="text" value="{{$data->jenis_kelamin}}" name="jenis_kelamin" class="form-control" id="exampleFormControlInput" required placeholder="P atau L">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput3">Alamat</label>
                                                        <input type="text" value="{{$data->alamat_anggota}}" name="alamat_anggota" class="form-control" id="exampleFormControlInput3" required placeholder="alamat">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput4">Nomor Handphone</label>
                                                        <input type="text" value="{{$data->nomor_hp}}" name="nomor_hp" class="form-control" id="exampleFormControlInput4" required placeholder="Nomor HP">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Edit Data</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle"> {{ $data->email}}</td>
                            <td class="align-middle"> {{ $data->nama_anggota }}</td>
                            <td class="align-middle"> {{ $data->alamat_anggota }}</td>
                            <td class="align-middle"> {{ $data->jenis_kelamin }}</td>
                            <td class="align-middle"> {{ $data->nomor_hp }}</td>
                            <td class="align-middle">Rp. {{ $data->total_pinjaman }}</td>
                            <td class="align-middle">Rp. {{ $data->total_simpanan }}</td>
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