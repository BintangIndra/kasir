@extends('welcome')

@section('content')
    <style>
        .nav-link{
            color:white !important;
        }
        .nav-link.active{
            color:#0dcaf0 !important;
        }
    </style>

    <div class="m-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" onclick="renderDataPenjualan()">Data Penjualan</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Laporan Penjualan</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
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

            </div>

            
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
        </div>
        
    </div>

    
    <script>
        $( document ).ready(function() {
            renderDataPenjualan();
        });

        var tableDataPenjualan;
        var totalDataPenjualan = 0;


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

        function renderDataPenjualan() {
            if (isInstanceDatatableCL('#dataPenjualan')) {
                tableDataPenjualan.destroy();
                totalDataPenjualan = 0;
                drawTable();
            } else {
                totalDataPenjualan = 0;
                drawTable();
            }
        }

        function drawTable() {
            tableDataPenjualan = $('#dataPenjualan').DataTable({
            paging: true,
            ajax: {
                url: "{{ route('kasir.show') }}",
                data:function(params) {
                    params.status = 0;
                },
                dataSrc: function ( responses ) {
                    return responses;
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
                        '        <button type="button" class="dropdown-item" onclick="showViewModal('+meta.row+')">View</button>'+
                        '    </li>'+
                        '        <li><button type="button" class="dropdown-item text-success" onclick="showEditModal('+meta.row+')">Edit</button></li>'+
                        '        <li>'+
                        '            <hr class="dropdown-divider">'+
                        '        </li>'+
                        '        <li><button type="button" class="dropdown-item text-danger" onclick="showDeleteModal('+meta.row+')">Delete</button></li>'+
                        '        </ul>'+
                        '    </li>'+
                        '</ul>'
                        ;

                        return action;
                    }
                },
            ],
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                totalDataPenjualan += parseInt(aData.count);
            },
        });
        $( tableDataPenjualan.column( 3 ).footer() ).html(
            totalDataPenjualan
        );
        }

    </script>
@endsection

@push('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}"/>
    
@endpush