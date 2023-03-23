@extends('welcome')

@section('content')
    <style>
        .nav-link{
            color:white !important;
        }
        .nav-link.active{
            color:#0dcaf0 !important;
        }
        .card-body{
            padding: 0px !important;
        }
    </style>

    <div class="m-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" onclick="renderDataPenjualan()">Data Penjualan</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false" onclick="renderLaporanPenjualan()">Laporan Penjualan</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false" onclick="renderLaporanBulanan()">Laporan Bulanan</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                <div class="d-flex justify-content-start mb-2 mt-2">
                    <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Advanced Search
                    </button>
                </div>
                <div class="collapse mb-2" id="collapseExample">
                    <div class="card card-body" style="background-color: #04293A;">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="dateTransAS">Tanggal Transaksi</label>
                                <input type="date" id="dateTransAS" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label for="atasNamaAS">Atas Nama</label>
                                <input type="text" id="atasNamaAS" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label for="totalAS">Total</label>
                                <input type="number" id="totalAS" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <table id="dataPenjualan" class="table table-dark" style="width:100%;">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Atas Nama</th>
                            <th>Tanggal transaksi</th>
                            <th>Total</th>
                            <th style="max-width: 20px !important;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr id="tfootDetailEvent">
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

            </div>


            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                
                <div class="d-flex justify-content-start mb-2 mt-2">
                    <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#advancedSearchLaporanPenjualan" aria-expanded="false" aria-controls="advancedSearchLaporanPenjualan">
                        Advanced Search
                    </button>
                </div>
                <div class="collapse mb-2" id="advancedSearchLaporanPenjualan">
                    <div class="card card-body" style="background-color: #04293A;">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="dateTransAS">Mulai Tanggal</label>
                                <input type="date" id="dateTransASLPS" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label for="dateTransAS">Sampai Tanggal</label>
                                <input type="date" id="dateTransASLPE" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label for="filterby">Filter By</label>
                                <select id="filterby" class="form-select">
                                    <option value="1">Jenis Barang</option>
                                    <option value="2">Master Data</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label for="dataFilter">Data</label>
                                <input type="text" id="dataFilter" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label for="dataFilter"></label>
                                <button id="dataFilter" class="form-control btn btn-info" onclick="renderLaporanPenjualan()">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="laporanPenjualan" class="table table-dark" style="width:100%;">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Atas Nama</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Tanggal transaksi</th>
                            <th style="max-width: 20px !important;">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr id="tfootLaporanPenjualan">
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

            </div>

            
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class="d-flex justify-content-start mb-2 mt-2">
                    <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#advancedSearchLaporanBulanan" aria-expanded="false" aria-controls="advancedSearchLaporanBulanan">
                        Advanced Search
                    </button>
                </div>
                <div class="collapse mb-2" id="advancedSearchLaporanBulanan">
                    <div class="card card-body" style="background-color: #04293A;">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="dateTransASLBS">Bulan</label>
                                <input type="month" id="monthLB" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label for="dataFilterLB"></label>
                                <button id="dataFilterLB" class="form-control btn btn-info" onclick="renderLaporanBulanan()">Search</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid row">
                    <div class="col-lg-12">
                        <h3>Pendapatan</h3>
                    </div>
                    <div class="col-lg-12">
                        <h4>Penjualan</h4>
                    </div>
                    <div class="col-lg-6">
                        <p>Total</p>
                    </div>
                    <div class="col-lg-6">
                        <p id="totalPenjualan"></p>
                    </div>


                    <div class="col-lg-12">
                        <h3>Pajak</h3>
                    </div>
                    <div class="col-lg-12">
                        <h4>Penjualan</h4>
                    </div>
                    <div class="col-lg-6">
                        <p>Total</p>
                    </div>
                    <div class="col-lg-6">
                        <p id="totalPajak"></p>
                    </div>
                </div>

            </div>
            
        </div>
        
        <div id="modalview">
            <x-modal content="++++" title="////" id="Modalview" footer="????"/>
        </div>

    </div>

    
    <script>
        $( document ).ready(function() {
            renderDataPenjualan();
        });

        var tableDataPenjualan;
        var totalDataPenjualan = 0;
        var totalLaporanPenjualan = 0;

        var tableLaporanPenjualan;

        var modal = $('#modalview').html();

        $('#atasNamaAS').on( 'keyup', function () {
            tableDataPenjualan
                .columns( 1 )
                .search( this.value )
                .draw();
        } );

        $('#dateTransAS').on( 'change', function () {
            tableDataPenjualan
                .columns( 2 )
                .search( this.value )
                .draw();
        } );

        $('#totalAS').on( 'keyup', function () {
            tableDataPenjualan
                .columns( 3 )
                .search( this.value )
                .draw();
        } );


        function isInstanceDatatableCL(id) {
            return $
                .fn
                .DataTable
                .isDataTable(id);
        }

        function print(params) {
            w = window.open();
            w.document.write($('#'+params).html())
            w.print();
            w.close();
        }

        function renderDataPenjualan() {
            if (isInstanceDatatableCL('#dataPenjualan')) {
                tableDataPenjualan.destroy();
                drawTableDataPenjualan();
            } else {
                drawTableDataPenjualan();
            }
        }

        function drawTableDataPenjualan() {
            tableDataPenjualan = $('#dataPenjualan').DataTable({
                paging: true,
                ajax: {
                    url: "{{ route('kasir.show') }}",
                    data:function(params) {
                        params.status = 0;
                    },
                    dataSrc: function ( responses ) {
                        return responses;
                    },
                    complete:function(){
                        $( tableDataPenjualan.column( 3 ).footer() ).html(
                            totalDataPenjualan
                        );
                    }
                },
                columns: [
                    { data: 'idTransaksi' },
                    { data: 'atasNama' },
                    { data: 'created_at' },
                    { data: 'count',class: "text-end"},
                    {
                        data: "id",
                        class: "text-end",
                        render: function ( data, type, row, meta ) {
                            let action =
                            '<ul class="navbar-nav">'+
                            '    <li class="nav-item dropdown">'+
                            '        <a class="btn btn-info dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">'+
                            '        </a>'+
                            '        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">'+
                            '        <button type="button" class="dropdown-item" onclick="detailDataPenjualan('+meta.row+')">View</button>'+
                            '    </li>'+
                            '</ul>'
                            ;

                        return action;
                    }
                },
            ],
            
            "preDrawCallback": function( settings ) {
                totalDataPenjualan = 0;
            },

            "drawCallback": function( settings ) {
                var api = new $.fn.dataTable.Api( settings );
                $(api.columns(3).footer()).html(
                    totalDataPenjualan
                );
            },

            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ){
                totalDataPenjualan += parseInt(aData.count);
            }

        });
        }

        function detailDataPenjualan(data){
            let row = tableDataPenjualan.row(data).data();
            let contentview = 
            '<div id="tablePesanan" class="container-fluid"><table class="table table-responsive" style="color:white;">'+
                '<tr>'+
                    '<th>'+
                        '<p>NAMA</p>'+
                    '</th>'+
                    '<th class="text-center">'+
                        '<p>JUMLAH</p>'+
                    '</th>'+
                    '<th class="text-end">'+
                        '<p>HARGA</p>'+
                    '</th>'+
                '</tr>';

            $.ajax({
                url: "{{ route('kasir.show') }}",
                data: {
                    idTransaksi : row.idTransaksi,
                    status : 0
                },
                success:function(data){
                    $.each(data, function( index, value ) {
                    contentview +=
                        '<tr>'+
                            '<td>'+
                                '<p>'+value.nama+'</p>'+
                            '</td>'+
                            '<td class="text-center">'+
                                '<p>'+value.jumlah+'</p>'+
                            '</td>'+
                            '<td class="text-end">'+
                                '<p>Rp.'+value.jumlah * value.harga+'</p>'+
                            '</td>'+
                        '</tr>';
                    });
                },
                complete:function(){
                    contentview += 
                                '<tr>'+
                                    '<td>'+
                                    '</td>'+
                                    '<td class="text-center">TOTAL'+
                                    '</td>'+
                                    '<td class="text-end">Rp.'+
                                        row.count+
                                    '</td>'+
                                '</tr>'+
                            '</table></div>';
                    
                    var footer = '<div>'+
                            '<button class="btn btn-light me-1" onclick="print(\'tablePesanan\')">Print</button>'+
                        '</div>';

                    var html = modal.replace('++++', contentview);
                    var html = html.replace('////', 'Pesanan '+row.atasNama);
                    var html = html.replace('????', footer);
                    var html = html.replace('0000', row.idTransaksi);
                    
                    $('#modalview').html(html);
                    
                    $('#Modalview').modal('show');
                }
            });
        }

        function renderLaporanPenjualan() {
            if (isInstanceDatatableCL('#laporanPenjualan')) {
                tableLaporanPenjualan.destroy();
                drawTableLaporanPenjualan();
            } else {
                drawTableLaporanPenjualan();
            }
        }

        function drawTableLaporanPenjualan() {
            totalLaporanPenjualan = 0;
            tableLaporanPenjualan = $('#laporanPenjualan').DataTable({
            paging: true,
            ajax: {
                url: "{{ route('kasir.show') }}",
                data: function(params) {
                    params.laporanPenjualan = true;
                    params.getBy = $('#filterby').val();
                    params.data = $('#dataFilter').val();
                    params.date = $('#dateTransASLPS').val();
                    params.date1 = $('#dateTransASLPE').val();

                },
                dataSrc: function ( responses ) {
                    $.each(responses,function( index, value ){
                        totalLaporanPenjualan += parseInt(value.harga * value.jumlah);
                    });
                    return responses;
                },
                complete:function(){
                    $( tableLaporanPenjualan.column( 3 ).footer() ).html(
                        totalLaporanPenjualan
                    );
                }
            },
            columns: [ 
                { data: 'idTransaksi' },
                { data: 'atasNama' },
                { data: 'nama'},
                { data: 'harga',
                  render : function(data, type, row, meta) {
                        var harga = parseFloat(data);
                        var jumlah = parseFloat(row.jumlah);
                        var total = harga * jumlah;
                        return total;
                    }
                },
                { data: 'created_at' },
                {
                    data: "id",
                    class: "text-end",
                    render: function ( data, type, row, meta ) {
                        let action =
                        '<ul class="navbar-nav">'+
                        '    <li class="nav-item dropdown">'+
                        '        <a class="btn btn-info dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">'+
                        '        </a>'+
                        '        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">'+
                        '        <button type="button" class="dropdown-item" onclick="detailLaporanPenjualan('+meta.row+')">View</button>'+
                        '    </li>'+
                        '</ul>'
                        ;

                        return action;
                    }
                },
            ],
        });
        }

        function detailLaporanPenjualan(data){
            let row = tableLaporanPenjualan.row(data).data();
            let contentview = 
            '<div id="tablePesanan" class="container-fluid"><table class="table table-responsive" style="color:white;">'+
                '<tr>'+
                    '<th>'+
                        '<p>NAMA</p>'+
                    '</th>'+
                    '<th class="text-center">'+
                        '<p>JUMLAH</p>'+
                    '</th>'+
                    '<th class="text-end">'+
                        '<p>HARGA</p>'+
                    '</th>'+
                '</tr>';

            $.ajax({
                url: "{{ route('kasir.show') }}",
                data: {
                    idTransaksi : row.idTransaksi,
                    status : 0
                },
                success:function(data){
                    $.each(data, function( index, value ) {
                    contentview +=
                        '<tr>'+
                            '<td>'+
                                '<p>'+value.nama+'</p>'+
                            '</td>'+
                            '<td class="text-center">'+
                                '<p>'+value.jumlah+'</p>'+
                            '</td>'+
                            '<td class="text-end">'+
                                '<p>Rp.'+value.jumlah * value.harga+'</p>'+
                            '</td>'+
                        '</tr>';
                    });
                },
                complete:function(){
                    contentview += 
                            '</table></div>';
                    
                    var footer = '<div>'+
                            '<button class="btn btn-light me-1" onclick="print(\'tablePesanan\')">Print</button>'+
                        '</div>';

                    var html = modal.replace('++++', contentview);
                    var html = html.replace('////', 'Pesanan '+row.atasNama);
                    var html = html.replace('????', footer);
                    var html = html.replace('0000', row.idTransaksi);
                    
                    $('#modalview').html(html);
                    
                    $('#Modalview').modal('show');
                }
            });
        }

        function renderLaporanBulanan() {
            $.ajax({
                url: "{{ route('kasir.show') }}",
                data: {
                    month : $('#monthLB').val() ? $('#monthLB').val() : '{{ date("Y-m") }}',
                },
                success:function(data){
                    $('#totalPenjualan').html(data.pendapatan);
                    $('#totalPajak').html(data.pajak.toFixed(2));
                },
                complete:function(){
                    
                }
            });
        }

    </script>
@endsection

@push('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}"/>
    
@endpush