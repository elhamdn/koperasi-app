@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Dashboard')

@section('content-app')
<h2 class="mt-2 mb-5">Beranda</h2>
<div class="row">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-8">
            <h5 class="card-title">Total Anggota</h5>
            <p class="card-text">{{$totalAnggota}} Anggota</p>
          </div>
          <div class="col-sm-4 icon_dashboard">
            <i class="fa fa-users icon_dashboard_content" style="font-size: 20px"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-8">
            <h5 class="card-title">Total Simpanan</h5>
            <p class="card-text">{{$totalSimpanan}}</p>
          </div>
          <div class="col-sm-4 icon_dashboard">
            <i class="fa fa-money-bill icon_dashboard_content" style="font-size: 20px"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-8">
            <h5 class="card-title">Total Pinjaman</h5>
            <p class="card-text">{{$totalPinjaman}}</p>
          </div>
          <div class="col-sm-4 icon_dashboard">
            <i class="fa fa-hand-holding-dollar icon_dashboard_content" style="font-size: 20px"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row row-cards">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">5 Mutasi Simpanan Terbaru Hari Ini</h3>
      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr class="text-center">
              <th class="w-1">No. Transaksi</th>
              <th>Nama Anggota</th>
              <th>Tanggal</th>
              <th>Deposit Pokok</th>
              <th>Deposit Wajib</th>
              <th>Keterangan</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($simpanan as $data)
            <tr class="text-center">
              <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
              <td class="align-middle">{{ $data->nama_anggota }}</td>
              <td class="align-middle">{{ $data->tgl_deposit }}</td>
              <td class="align-middle">{{ $Helper->revertMoney($data->deposit) }}</td>
              <td class="align-middle">{{ $Helper->revertMoney($data->jenis_simpanan) }}</td>
              <td class="align-middle">{{ $data->keterangan }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row row-cards">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">5 Mutasi Angsuran Terbaru Hari Ini</h3>
      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr class="text-center">
              <th scope="row">No. transaksi</th>
              <th>Nama Anggota</th>
              <th>Tanggal</th>
              <th>Biaya Cicilan</th>
              <th>Biaya Bunga</th>
              <th>Total Angsuran</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($angsuran as $data)
            <tr class="text-center">
              <th class="align-middle" scope="row">{{ $data->no_transaksi }}</th>
              <td class="align-middle">{{ $data->nama_anggota }}</td>
              <td class="align-middle">{{ $data->tgl_angsuran }}</td>
              <td class="align-middle">{{ $Helper->revertMoney($data->biaya_cicilan) }}</td>
              <td class="align-middle">{{ $Helper->revertMoney($data->biaya_bunga) }}</td>
              <td class="align-middle">{{ $Helper->revertMoney($data->biaya_cicilan+$data->biaya_bunga) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row row-cards">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        Grafik Angsuran
      </div>
      <div class="card-body">
        <canvas id="grafikAngsuran"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row row-cards">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        Grafik Simpanan
      </div>
      <div class="card-body">
        <canvas id="grafikSimpanan"></canvas>
      </div>
    </div>
  </div>
</div>
@endsection

@include('pages.dashboard-css-js')