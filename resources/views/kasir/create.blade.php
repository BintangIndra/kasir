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
                <th>Name Produk</th>
                <th>Jenis Produk</th>
                <th>Harga</th>
                <th style="max-width: 20px !important;">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    var table = $('#pesananDataTable').DataTable({
        paging: true,
        ajax: {
            url: "{{ route('kasir.show') }}",
            dataSrc: function ( responses ) {
                return responses;
            }
        },
        columns: [
            { data: 'nama' },
            { data: 'jenis' },
            { data: 'harga' },
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
                    '        <button type="button" class="dropdown-item" onclick="showviewModal('+meta.row+')">View</button>'+
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

@endpush