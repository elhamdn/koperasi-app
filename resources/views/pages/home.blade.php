@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.anggota-layout')

@section('page-title', 'Dashboard')

@section('content-app')
<header class="mb-3">
    <div class="row">

        <div class="col-md-12 mb-3 text-right">
            <a href="#" class="d-inline burger-btn d-block d-xl-none float-left mt-3">
                <i class="fas fa-bars fs-3"></i>
            </a>

            <div class="dropdown show">
                <h2 class="d-inline p-2">{{$user->nama_anggota}}</h2>
                <i class="fas fa-user text-white bg-secondary" style="padding: 15px;border-radius: 50px; font-size: 20px" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>

                <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button">
                        <a href="{{ url('member/profile') }}" class="sidebar-link">
                            <i class="fas fa-user mr-2"></i>
                            <span>Profile</span>
                        </a>
                    </button>
                    <button class="dropdown-item" type="button">
                        <a href="{{ url('logout') }}" class="sidebar-link">
                            <i class="fas fa-arrow-right-from-bracket mr-2"></i>
                            <span>Keluar</span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="page-content">
    <h2 class="mt-2 mb-5">Beranda</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-money-bill-wave" style="font-size:45px"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{$Helper->revertMoney($user->total_simpanan)}}</h3>
                                <span>Total Simpanan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fa fa-hand-holding-dollar" style="font-size:45px"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{$Helper->revertMoney($user->total_pinjaman)}}</h3>
                                <span>Total Pinjaman</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">5 History Angsuran</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($angsuran as $data)
                            <div class="col-md-6">
                                <div class="list-group mb-2">
                                    <span class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">No. Transaksi Pinjaman : {{$data->no_transaksi_pinjaman}}</h5>
                                            <small class="text-right">{{$data->tgl_angsuran}}</small>
                                        </div>
                                        <table class="mb-1">
                                            <tr>
                                                <td>Biaya Cicilan</td>
                                                <td>:</td>
                                                <td>{{$Helper->revertMoney($data->biaya_cicilan)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Biaya Cicilan</td>
                                                <td>:</td>
                                                <td>{{$Helper->revertMoney($data->biaya_bunga)}}</td>
                                            </tr>
                                        </table>
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">5 History Simpanan</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($simpanan as $data)
                            <div class="col-md-6">
                                <div class="list-group mb-2">
                                    <span class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">No. Transaksi : {{$data->no_transaksi}}</h5>
                                            <small class="text-right">{{$data->tgl_deposit}}</small>
                                        </div>
                                        <table class="mb-1">
                                            <tr>
                                                <td>Deposit</td>
                                                <td>:</td>
                                                <td>{{$Helper->revertMoney($data->deposit)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Simpanan</td>
                                                <td>:</td>
                                                <td>{{$data->jenis_simpanan}}</td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>:</td>
                                                <td>{{$data->keterangan}}</td>
                                            </tr>
                                        </table>
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()

@section('js')
<script>
    var buttonAjukan = document.getElementById('btn_ajukan');
    var modal = document.getElementById('exampleModal');

    console.log(modal)

    buttonAjukan.addEventListener('click', () => {

        var dengan_rupiah = document.getElementById('dengan-rupiah');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value);
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    })
</script>

@endsection