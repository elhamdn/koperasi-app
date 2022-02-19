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
                <div class="pro-img"><img src="data:image/png;base64,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" alt="user"></div>
                <h3 class="m-b-0">{{$user->nama_anggota}}</h3>
                <p>{{$user->no_kta}}</p> 

                @if (\Session::has('error'))
                    <div class="alert alert-light-danger color-danger"><i class="fas fa-circle-exclamation mr-2"></i> {!! \Session::get('error') !!}</div>
                @endif
                @if (\Session::has('message'))
                    <div class="alert alert-light-success color-success"><i class="fas fa-check mr-2"></i> {!! \Session::get('message') !!}</div>
                @endif

                <button class="m-t-10 waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-toggle="modal" data-target="#modalUbahData">Ubah Data</button>
                <div class="modal fade" id="modalUbahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                </div>

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