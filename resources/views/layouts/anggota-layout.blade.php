@extends('layouts.anggotaTemplate')

@section('content')
<div id="app">
    @include('layouts.anggota-sidebar') 
    <div id="main" style="background: #f2f7ff; min-height: 100vh">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-content">
            @yield('content-app')
        </div>
    </div>
</div>

@endsection