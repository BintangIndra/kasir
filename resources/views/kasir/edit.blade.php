@extends('welcome')

@section('content')
<div class="m-3">
    <div class="d-flex justify-content-between">
        <h3>Daftar Pesanan</h1>
        <button type="button" class="btn btn-info mb-1" data-bs-toggle="modal" data-bs-target="#exampleModalcreate">Create</button>
    </div>
    <table id="pesananDataTable" class="table table-dark" style="width:100%;">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Atas Nama</th>
                <th>Nomor Meja</th>
                <th class="text-end">Total</th>
                <th style="max-width: 20px !important;">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="modalview">
    <x-modal content="++++" title="////" id="Modalview" footer="????"/>
</div>

<div id="modaleditdiv">
    <x-modal content="++++" title="////" id="ModalEdit" footer="????"/>
</div>

<script>
    var modal = $('#modalview').html();
    var modalEdit = $('#modaleditdiv').html();
    
    function print(params) {
        w = window.open();
        w.document.write($('#tablePesanan').html())
        w.print();
        w.close();
    }

    function deleteRow(params) {
        $('#row'+params).delete()
    }

    function showViewModal(data){
        let row = table.row(data).data();
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
                        '<button class="btn btn-light me-1" onclick="print()">Print</button>'+
                        '<a href="{{ route("kasir.bayar",'0000') }}" class="btn btn-info">Bayar</a>'+
                    '</div>';

                var html = modal.replace('++++', contentview);
                var html = html.replace('////', 'Pesanan '+row.atasNama);
                var html = html.replace('????', footer);
                var html = html.replace('0000', row.idTransaksi);
                
                $('#modalview').html(html);
                
                $('#Modalview').modal('show');
            }
        });
        
    };
    
    function showEditModal(data){
        let row = table.row(data).data();
        let contentview = 
        '<div id="tablePesanan" class="container-fluid">'+
            '<form action="" method="POST">'+
            '{{csrf_field()}}'+
            '<table class="table table-responsive" style="color:white;">'+
                '<tr>'+
                    '<th>'+
                        '<p>NAMA</p>'+
                    '</th>'+
                    '<th class="text-center">'+
                        '<p>JUMLAH</p>'+
                    '</th>'+
                    '<th class="text-end">'+
                        '<p>ACTION</p>'+
                    '</th>'+
                '</tr>';

        $.ajax({
            url: "{{ route('kasir.show') }}",
            data: {
                idTransaksi : row.idTransaksi,
            },
            success:function(data){
                $.each(data, function( index, value ) {
                contentview +=
                    '<tr id="row'+row.idTransaksi+'">'+
                        '<td>'+
                            '<p>'+value.nama+'</p>'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<input type="number" placeholder="'+value.jumlah+'" name="jumlah[]">'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<a class="btn btn-danger" onclick="deleteRow('+row.idTransaksi+')">X</a>'+
                        '</td>'+
                    '</tr>';
                });
            },
            complete:function(){
                contentview += '</table></form></div>';
                
                var footer = '<div>'+
                        '<a href="{{ route("kasir.bayar",'0000') }}" class="btn btn-info">Simpan</a>'+
                    '</div>';

                var html = modalEdit.replace('++++', contentview);
                var html = html.replace('////', 'Pesanan '+row.atasNama);
                var html = html.replace('????', footer);
                var html = html.replace('0000', row.idTransaksi);
                
                $('#modaleditdiv').html(html);
                
                $('#ModalEdit').modal('show');
            }
        });
        
    };
    
    var table = $('#pesananDataTable').DataTable({
        paging: true,
        ajax: {
            url: "{{ route('kasir.show') }}",
            dataSrc: function ( responses ) {
                return responses;
            }
        },
        columns: [
            { data: 'idTransaksi' },
            { data: 'atasNama' },
            { data: 'nomorMeja' },
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
    });
</script>
@endsection

@push('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}"/>
    
@endpush