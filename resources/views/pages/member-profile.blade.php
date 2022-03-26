@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.anggota-layout')

@section('page-title', 'Profile')

@section('css')
<style>
body {
    background-color: #000000
}

.padding {
    padding: 3rem !important;
    margin-left: 200px
}

.card-img-top {
    height: 300px
}

.card-no-border .card {
    border-color: #d7dfe3;
    border-radius: 4px;
    margin-bottom: 30px;
    -webkit-box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05);
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.05)
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem
}

.pro-img {
    margin-top: -80px;
    margin-bottom: 20px
}

.little-profile .pro-img img {
    width: 128px;
    height: 128px;
    -webkit-box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    border-radius: 100%
}

html body .m-b-0 {
    margin-bottom: 0px
}

h3 {
    line-height: 30px;
    font-size: 21px
}

.btn-rounded.btn-md {
    padding: 12px 35px;
    font-size: 16px
}

html body .m-t-10 {
    margin-top: 10px
}

.btn-primary,
.btn-primary.disabled {
    background: #7460ee;
    border: 1px solid #7460ee;
    -webkit-box-shadow: 0 2px 2px 0 rgba(116, 96, 238, 0.14), 0 3px 1px -2px rgba(116, 96, 238, 0.2), 0 1px 5px 0 rgba(116, 96, 238, 0.12);
    box-shadow: 0 2px 2px 0 rgba(116, 96, 238, 0.14), 0 3px 1px -2px rgba(116, 96, 238, 0.2), 0 1px 5px 0 rgba(116, 96, 238, 0.12);
    -webkit-transition: 0.2s ease-in;
    -o-transition: 0.2s ease-in;
    transition: 0.2s ease-in
}

.btn-rounded {
    border-radius: 60px;
    padding: 7px 18px
}

.m-t-20 {
    margin-top: 20px
}

.text-center {
    text-align: center !important
}

h1,
h2,
h3,
h4,
h5,
h6 {
    color: #455a64;
    font-family: "Poppins", sans-serif;
    font-weight: 400
}

p {
    margin-top: 0;
    margin-bottom: 1rem
}
</style>
@endsection

@section('content-app')
<div class="row">
    <div class="col-md-12">
        <!-- Column -->
        <div class="card"> <img class="card-img-top" src="https://images.unsplash.com/photo-1584117756263-bc482c509c49?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="Card image cap">
            <div class="card-body little-profile text-center">
                <div class="pro-img"><img src="{{ URL::to('/') }}/data_file/{{$user->profile_picture}}" alt="user"></div>
                <h3 class="m-b-0">{{$user->nama_anggota}}</h3>
                <p>{{$user->no_kta}}</p> 

                @if (\Session::has('error'))
                    <div class="alert alert-light-danger color-danger"><i class="fas fa-circle-exclamation mr-2"></i> {!! \Session::get('error') !!}</div>
                @endif
                @if (\Session::has('message'))
                    <div class="alert alert-light-success color-success"><i class="fas fa-check mr-2"></i> {!! \Session::get('message') !!}</div>
                @endif

                <!-- <button class="m-t-10 waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-toggle="modal" data-target="#modalUbahData">Ubah Data</button> -->
                <!-- <div class="modal fade" id="modalUbahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                                <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ url('/member/ubah_profile') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" value="{{$user->email}}"  name="email" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Anggota</label>
                                        <input type="text" value="{{$user->nama_anggota}}"  name="nama_anggota" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Nama Anggota">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                                        <input type="text" value="{{$user->jenis_kelamin}}"  name="jenis_kelamin" class="form-control" id="exampleInputEmail1" min="0" required placeholder="L atau P">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor Telepon</label>
                                        <input type="number" value="{{$user->nomor_hp}}"  name="nomor_hp" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Nomor Telepon">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Alamat</label>
                                        <textarea class="form-control" name="alamat_anggota" id="exampleFormControlTextarea1" rows="3">{{$user->alamat_anggota}}</textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->

                <button class="m-t-10 waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-toggle="modal" data-target="#modalUbahPassword">Ubah Sandi</button>
                <div class="modal fade" id="modalUbahPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ubah Sandi</h5>
                                <span data-dismiss="modal" aria-label="Close"><i class="fa fa-circle-xmark" style="font-size:18px; cursor:pointer"></i></span>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ url('/member/ubah_password') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password Lama</label>
                                        <input type="password" name="password_lama" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Password Lama">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password Baru</label>
                                        <input type="password" name="password_baru" class="form-control" id="exampleInputEmail1" min="0" required placeholder="Password Baru">
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

                <div class="row text-left m-t-20">
                    <div class="col-lg-4 col-md-6 m-t-20">
                        <small>Email</small><br><span class="m-b-0 font-light">{{$user->email}}</span>
                    </div>
                    <div class="col-lg-4 col-md-6 m-t-20">
                        <small>Jenis Kelamin</small><br><span class="m-b-0 font-light">{{$user->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan'}}</span>
                    </div>
                    <div class="col-lg-4 col-md-12 m-t-20">
                        <small>Alamat</small><br><span class="m-b-0 font-light">{{$user->alamat_anggota}}</span>
                    </div>
                    <div class="col-lg-4 col-md-6 m-t-20">
                        <small>Total Simpanan</small><br><span class="m-b-0 font-light">{{$Helper->revertMoney($user->total_simpanan)}}</span>
                    </div>
                    <div class="col-lg-4 col-md-6 m-t-20">
                        <small>Total Pinjaman</small><br><span class="m-b-0 font-light">{{$Helper->revertMoney($user->total_pinjaman)}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection