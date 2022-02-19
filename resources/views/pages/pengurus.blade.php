@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Master Pengurus')

@section('content-app')
<h2 class="mt-2 mb-5">Pengajuan</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-md-9"></div>
            <div class="col-md-3 text-right">
                <div class="form-group">
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalFormpengurus">Tambah Pengurus</button>
                </div>
            </div>

            <div class="modal fade" id="modalFormpengurus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Edit Pengurus </h4>
                            <span data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                        </div>
                        <form method="post" action="{{ url('/pengurus/add') }}" target="invisible">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="modal-body text-left">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>NIP: </label>
                                        <div class="form-group">
                                            <input type="text" name="nip" class="form-control" id="exampleFormControlInput0" required placeholder="NIP">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama Pengurus: </label>
                                        <div class="form-group">
                                            <input type="text" name="nama_pengurus" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email: </label>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Password: </label>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" id="exampleFormControlInput2" placeholder="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Jenis Kelamin: </label>
                                        <div class="form-group">
                                            <input type="text" name="jenis_kelamin" class="form-control" id="exampleFormControlInput" required placeholder="P atau L">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nomor Handphone: </label>
                                        <div class="form-group">
                                            <input type="text" name="nomor_hp" class="form-control" id="exampleFormControlInput4" required placeholder="Nomor HP">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Jenis Pengurus: </label>
                                        <div class="form-group">
                                            <input type="text" name="jenis_pengurus" class="form-control" id="exampleFormControlInput4" required placeholder="Jenis Pengurus">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Alamat Pengurus: </label>
                                        <div class="form-group">
                                            <textarea rows="3" name="alamat_pengurus" class="form-control" id="exampleFormControlInput3" required placeholder="alamat"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
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
                            <th scope="row">NIP</th>
                            <th>Email</th>
                            <th>Nama pengurus</th>
                            <th>Jenis Pengurus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($penguruses) == 0)
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="m-3">
                                        <i class="fa fa-calendar-xmark mb-2" style="font-size:50px"></i><br>
                                        <span>Data Tidak Ditemukan</span>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($penguruses as $data)
                        <tr class="text-center">
                            <th class="align-middle" scope="row">{{ $data->nip }}</th>
                            <td class="align-middle"> {{ $data->email}}</td>
                            <td class="align-middle"> {{ $data->nama_pengurus }}</td>
                            <td class="align-middle"> {{ $data->jenis_pengurus }}</td>
                            <td class="align-middle">

                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPengurusModal-{{$data->no_kta}}">
                                    Edit
                                </button>
                                <div class="modal fade" id="editPengurusModal-{{$data->no_kta}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Edit Pengurus </h4>
                                                <span data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                            </div>
                                            <form method="post" action="{{ url('/pengurus/edit') }}" target="invisible">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-body text-left">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>NIP: </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$data->nip}}" disabled class="form-control" id="exampleFormControlInput0" required placeholder="NIP">
                                                                <input type="hidden" value="{{$data->nip}}" name="nip" class="form-control" placeholder="NIP">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Nama Pengurus: </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$data->nama_pengurus}}" name="nama_pengurus" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email: </label>
                                                            <div class="form-group">
                                                                <input type="email" value="{{$data->email}}" name="email" class="form-control" id="exampleFormControlInput" required placeholder="Nama">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Password: </label>
                                                            <div class="form-group">
                                                                <input type="password" name="password" class="form-control" id="exampleFormControlInput2" placeholder="password">
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
                                                        <div class="col-md-6">
                                                            <label>Jenis Pengurus: </label>
                                                            <div class="form-group">
                                                                <input type="text" value="{{$data->jenis_pengurus}}" name="jenis_pengurus" class="form-control" id="exampleFormControlInput4" required placeholder="Jenis Pengurus">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Alamat Pengurus: </label>
                                                            <div class="form-group">
                                                                <textarea rows="3" name="alamat_pengurus" class="form-control" id="exampleFormControlInput3" required placeholder="alamat">{{$data->alamat_pengurus}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewPengurusModal-{{$data->no_kta}}">
                                    Detail
                                </button>
                                <div class="modal fade" id="viewPengurusModal-{{$data->no_kta}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Detail Pengurus </h4>
                                                <span data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                                            </div>
                                            <div class="modal-body text-left">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>NIP: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->nip }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Email: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->email }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Nama Pengurus: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->nama_pengurus }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Jenis Kelamin: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Jenis Pengurus: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->jenis_pengurus }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Nomor Handphone: </label>
                                                        <div class="form-group">
                                                            <div class="form-control">{{ $data->nomor_hp }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Alamat Pengurus: </label>
                                                        <div class="form-group">
                                                            <div class="form-control" style="min-height: 120px;white-space: initial">{{ $data->alamat_pengurus }}</div>
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
            {!! $penguruses->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
@endsection