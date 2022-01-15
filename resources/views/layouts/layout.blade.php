@extends('layouts.template')

@section('content')
<style>
    .main__container {
        display: flex;
    }

    .main__container__content {
        flex: 4;
    }
</style>
<div class="page">
    <div class="flex-fill">
        @include('layouts.header')
        <div class="main__container">
            @include('layouts.sidebar')
            <div class="my-3 my-md-5 main__container__content ">
                <div class="container">
                    <!-- <div class="page-header">
                        <h1 class="page-title">@yield('page-title')</h1>
                    </div>
                    @yield('content-app') -->
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia fugit pariatur tenetur architecto ipsum fuga unde nisi quibusdam iure tempore provident dolorem ad, molestiae illo voluptatum culpa cum soluta dolorum!
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam sint laboriosam ipsam eos iusto debitis recusandae quod unde ullam id quia eligendi voluptatum at ratione fuga amet voluptatibus, totam consequatur?
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@endsection