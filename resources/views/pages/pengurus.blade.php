@extends('layouts.layout')

@section('page-title', 'Master Pengurus')

@section('content-app')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <button class="btn btn-success mx-3" type="button" data-toggle="modal" data-target="#modalFormpengurus">Tambah Pengurus</button>
                    <div class="modal fade" id="modalFormpengurus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengurus</h5>
                                    <button type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ url('/pengurus/add') }}" target="invisible">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlInput0">NIP</label>
                                            <input type="text" name="nip" class="form-control" id="exampleFormControlInput0" required placeholder="Nomor KTA">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput">Nama pengurus</label>
                                            <input type="text" name="nama_pengurus" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
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
                                            <input type="text" name="alamat_pengurus" class="form-control" id="exampleFormControlInput3" required placeholder="alamat">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput4">Nomor Handphone</label>
                                            <input type="text" name="nomor_hp" class="form-control" id="exampleFormControlInput4" required placeholder="Nomor HP">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlInput4">Jenis Pengurus</label>
                                            <input type="text" name="jenis_pengurus" class="form-control" id="exampleFormControlInput4" required placeholder="Jenis Pengurus">
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
                            <th scope="row">NIP</th>
                            <th>Aksi</th>
                            <th>Email</th>
                            <th>Nama pengurus</th>
                            <th>Alamat pengurus</th>
                            <th>Jenis Kelamin</th>
                            <th>Nomor Hp</th>
                            <th>Jenis Pengurus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penguruses as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->nip }}</th>
                            <td class="align-middle">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPengurusModal-{{$data->nip}}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editPengurusModal-{{$data->nip}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit pengurus</h5>
                                                <button type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ url('/pengurus/edit') }}" target="invisible">
                                                    @csrf
                                                    <input type="hidden" name="nip" value="{{ $data->nip }}">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput0">NIP</label>
                                                        <input type="text" value="{{$data->nip}}" disabled name="nip" class="form-control" id="exampleFormControlInput0" required placeholder="Nomor KTA">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput">Nama pengurus</label>
                                                        <input type="text" value="{{$data->nama_pengurus}}" name="nama_pengurus" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
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
                                                        <input type="text" value="{{$data->alamat_pengurus}}" name="alamat_pengurus" class="form-control" id="exampleFormControlInput3" required placeholder="alamat">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput4">Nomor Handphone</label>
                                                        <input type="text" value="{{$data->nomor_hp}}" name="nomor_hp" class="form-control" id="exampleFormControlInput4" required placeholder="Nomor HP">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput5">Jenis Pengurus</label>
                                                        <input type="text" value="{{$data->jenis_pengurus}}" name="jenis_pengurus" class="form-control" id="exampleFormControlInput5" required placeholder="Jenis Pengurus">
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
                            <td class="align-middle"> {{ $data->nama_pengurus }}</td>
                            <td class="align-middle"> {{ $data->alamat_pengurus }}</td>
                            <td class="align-middle"> {{ $data->jenis_kelamin }}</td>
                            <td class="align-middle"> {{ $data->nomor_hp }}</td>
                            <td class="align-middle"> {{ $data->jenis_pengurus }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="d-flex justify-content-center mt-3">
            {!! $penguruses->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection