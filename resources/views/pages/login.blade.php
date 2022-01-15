@extends('layouts.template')

@section('content')
<div class="page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <div class="display-4 font-weight-bold">E-Koperasi</div>
                    </div>
                    <form class="card" method="post" action="{{ route('login') }}">
                        @csrf

                        <div class="card-body p-6">
                            <div class="form-group">
                                <label class="form-label">Email address</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    Password
                                </label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="custom-control-label">Remember me</span>
                                </label>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </div>
                        <br>
                        <center>
                            <p>Repost by <a href="https://stokcoding.com/" title="StokCoding.com" target="_blank">StokCoding.com</a></p>
                        </center>
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection