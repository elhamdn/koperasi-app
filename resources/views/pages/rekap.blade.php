@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Rekap Simpanan')

@section('content-app')
<h2 class="mt-2 mb-5">Rekap Data Simpanan</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">

        </div>
        <!-- <div class="card"> -->
        <div class="row" style="background-color: white;">
            <div class="table-responsive">
                <table id="example" class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>Nomor transaksi</th>
                            <th>Nomor KTA</th>
                            <th>Nama Anggota</th>
                            <th>Tanggal Deposit</th>
                            <th>Deposit</th>
                            <th>Jenis Simpanan</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            initComplete: function(settings, json) {
                console.log("simpanan loaded")
            },
            paging: true,
            ajax: "/get_simpanan",
            // ordering: false,
            dom: '<"top"i>rt<"bottom"flp><"clear">',
            buttons: [
                'excel', 'pdf'
            ],
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
                    data: "tgl_deposit",
                },
                {
                    data: "deposit",
                },
                {
                    data: "jenis_simpanan",
                },
                {
                    data: "keterangan",
                }, {
                    data: null,
                    render: function(data, type, row) {
                        // console.log(data, type, row)
                        return `<a class="btn btn-success" target="_blank" href="simpanan/${data.no_transaksi}">Cetak </a>`;
                    }
                }
            ],
            "language": {
                processing: '<div class="fa-3x"><i class="fas fa-spinner fa-spin"></i></div>'
            },
        });

    });
</script>
@endsection