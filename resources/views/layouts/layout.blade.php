@extends('layouts.template')

@section('content')
<div id="app">
    @include('layouts.sidebar') 
    <div id="main" style="background: #f2f7ff; min-height: 100vh">
        @yield('content-app')
        <!-- <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="fas fa-bars fs-3"></i>
            </a>
        </header>
        <div class="page-content">
        </div> -->
    </div>
</div>

@endsection