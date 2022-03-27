@inject('Helper', 'App\Http\Helpers\Helper')

@extends('layouts.layout')

@section('page-title', 'Rekap Pinjaman')

@section('content-app')
<h2 class="mt-2 mb-5">Rekap Data Pinjaman</h2>
<button class="btn btn-primary float-rigth" id="export-excel">Download Excel</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function() {
        var query_value_exercise;
        $('#tablePinjam').on('search.dt', function() {
            var value = $('.dataTables_filter input').val();
            query_value_exercise = value
        });

        $('#tablePinjam').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            ajax: "/get_pinjaman",
            initComplete: function(settings, json) {
                console.log("pinjaman loaded")
            },
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

        // Export to excel

        const EXCEL_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTS-8'
        const EXCEL_EXTENSION = '.xlsx'

        let listData;
        let query_value = localStorage.getItem('key_list_exercise') ? localStorage.getItem('key_list_exercise') : '';

        function downloadAsExcel(data){
            const worksheet = XLSX.utils.json_to_sheet(data)
            const workbook = {
                Sheets: {
                    'data': worksheet
                },
                SheetNames: ['data']
            }
            const excelBuffer = XLSX.write(workbook, {bookType: 'xlsx', type: 'array'})
            console.log(excelBuffer)
            saveAsExcel(excelBuffer, 'pinjaman')
        }

        function saveAsExcel(buffer, filename){
            const data = new Blob([buffer], {type: EXCEL_TYPE})
            saveAs(data, filename+'_export_'+(moment().format('yyyy MM DD hh mm ss')).replace(/\s/g, '')+EXCEL_EXTENSION)
        }

        $('#export-excel').on('click', function() {
            $.ajax({     
            type: "GET",
            data: {
                'search': query_value_exercise
            },
            url: '{!! URL::route("pinjaman.all") !!}',
            success: function (data) {
                downloadAsExcel(data)
            },
            dataType: "json"
            });
        });


    });
</script>
@endsection