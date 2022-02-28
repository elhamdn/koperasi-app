@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Pengajuan')

@section('content-app')
<h2 class="mt-2 mb-5">Pengajuan</h2>
<div class="row row-cards">
    <div class="col-12">
        <div class="row mb-3">
            hai
        </div>
        <div class="card">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nomor transaksi</th>
                        <th>Tanggal Deposit</th>
                        <th>Deposit Pokok</th>
                        <th>Deposit Wajib</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>
@endsection

@section('js')
<script>
    window.onload = function() {
        let table = new DataTable('#example', {
            processing: true,
            serverSide: true,
            initComplete: function(settings, json) {
                console.log(settings, json)
            },
            paging: true,
            ajax: "/get_simpanan",
            columns: [{
                    data: "no_transaksi",
                },
                {
                    data: "tgl_deposit",
                },
                {
                    data: "deposit_wajib",
                },
                {
                    data: "deposit_pokok",
                },
                {
                    data: "keterangan",
                },
            ]
        });

    }






    // $(document).ready(function() {
    //     $('#example').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: "/get_simpanan",
    //         columns: [{
    //             data: "deposit_pokok",
    //         }, ]
    //     });
    // });
</script>
@endsection