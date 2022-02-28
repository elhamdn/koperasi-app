@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Rekap Pinjaman')

@section('content-app')
<h2 class="mt-2 mb-5">Rekap Data Pinjaman</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">

        </div>
        <div class="card">
            <div class="row">
                <div class="table-responsive">
                    <table id="tablePinjam" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nomor transaksi</th>
                                <th>Nomor KTA</th>
                                <th>Nama Anggota</th>
                                <th>Status Pengajuan Pinjaman</th>
                                <th>Tanggal Pengajuan Pinjaman</th>
                                <th>Total Pinjaman</th>
                                <th>Tenor Cicilan</th>
                                <th>Keterangan</th>
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

        $('#tablePinjam').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            ajax: "/get_pinjaman",
            initComplete: function(settings, json) {
                console.log("pinjaman loaded")
            },
            dom: 'Bfrtlip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print',
                {
                    text: 'Alert',
                    action: function(e, dt, node, config) {
                        alert('Activated!');
                        this.disable()
                    }
                }
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
                    data: "status_pengajuan_pinjaman",
                },
                {
                    data: "tgl_pinjam",
                },
                {
                    data: "total_pinjam",
                },
                {
                    data: "tenor_cicilan",
                },
                {
                    data: "keterangan",
                },
            ]
        });
    });
</script>
@endsection