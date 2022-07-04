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
    <x-modal content="++++" title="////" id="Modalview"/>
</div>

<script>
    var modal = $('#modalview').html();

    async function showViewModal(data){
        var row = table.row(data).data();
        var contentview = 
        '<table class="table table-responsive" style="color:white;">'+
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
            async :true,
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
                        '</table>';

                var html = modal.replace('++++', contentview);
                var html = html.replace('////', 'Pesanan '+row.atasNama);
                
                $('#modalview').html(html);
                
                $('#Modalview').modal('show');
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
                    '        <li><button type="button" class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#exampleModal'+row.id+'" onclick="showEditModal('+meta.row+')">Edit</button></li>'+
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