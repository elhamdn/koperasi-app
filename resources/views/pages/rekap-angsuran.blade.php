@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Rekap Angsuran')

@section('content-app')
<h2 class="mt-2 mb-5">Rekap Data Angsuran</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">

        </div>
        <div class="card">
            <div class="row">
                <div class="table-responsive">
                    <table id="tableAngsuran" class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>Nomor transaksi</th>
                                <th>Nomor KTA</th>
                                <th>Nama Anggota</th>
                                <th>Tanggal Angsuran</th>
                                <th>Biaya Cicilan</th>
                                <th>Biaya Bunga</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {

        $('#tableAngsuran').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            ajax: "/get_angsuran",
            initComplete: function(settings, json) {
                console.log("pinjaman loaded")
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            // ordering: false,
            columns: [{
                    data: "no_transaksi",
                },
                {
                    data: "no_kta",
                },
                {
                    data: "nama_anggota",
                },
                {
                    data: "tgl_angsuran",
                },
                {
                    data: "biaya_cicilan",
                },
                {
                    data: "biaya_bunga",
                },
            ]
        });
    });
</script>
@endsection