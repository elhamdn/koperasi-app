@extends('layouts.template')

@section('content')
<div class="page">
    <div class="flex-fill">
        @include('layouts.header')
        <div class="main__container">
            @include('layouts.sidebar')
            <div class="main__container__content ">
                <div class="container">
                    <div class="page-header">
                        <h1 class="page-title">@yield('page-title')</h1>
                    </div>
                    <div class="main__container__content__inner">
                        @yield('content-app')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection