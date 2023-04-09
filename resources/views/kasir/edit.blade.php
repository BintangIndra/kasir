@extends('welcome')

@section('content')
<style>
    .select2-dropdown{
        color:black;
    }
    .select2,.select2-container{
        width: 100% !important;
    }
</style>

<div class="m-3">
    <div class="d-flex justify-content-between">
        <h3>Daftar Pesanan</h1>
        <a class="btn btn-info mb-1" href="{{ route('kasir.index') }}">Create</a>
    </div>
    <table id="pesananDataTable" class="table table-dark" style="width:100%;">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Atas Nama</th>
                <th>Tanggal Ambil</th>
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

<div id="modaldeletediv">
    <x-alert content="++++" route="////" id="----" size="sm"/>
</div>

<script>
    var modal = $('#modalview').html();
    var modalEdit = $('#modaleditdiv').html();
    var modalDel = $('#modaldeletediv').html();

    getMasterBarang();
    var selectOptionMB = '';

    function getMasterBarang() {
        let dataSelect = '';
        let html =
        '<tr id="setOrder">'+
            '<td colspan="2">'+
            '<select class="form-select w-100" id="selectMasterBarang" aria-label="Default select example">'+
                '++++'+
            '</select>'+
            '</td>'+
            '<td>'+
                '<a class="btn btn-info" href="javascript:void(0);" onclick="addPesanan()">Tambah</a>'+
            '</td>'+
        '</tr>';

        $.ajax({
            url: "{{ route('masterData.index') }}",
            data: {
                jenis_makanan : 'all'
            },
            success:function(data){
                $.each(data, function( index, value ) {
                    dataSelect += '<option value="'+value.id+'">'+value.nama+'</option>';
                });
            },
            complete:function(){
                html = html.replace('++++', dataSelect);
                selectOptionMB = html;
            }
        });

    }
    
    function print(params) {
        w = window.open();
        w.document.write($('#tablePesanan').html())
        w.print();
        w.close();
    }

    function deleteRow(params) {
        $('#'+params).remove();
    }

    function submit(params) {
        $('#'+params).submit();
    }

    function addPesanan(){
        let idBarang = $('#selectMasterBarang').val();
        let data = $('#selectMasterBarang').select2('data')[0];

        let html =
            '<tr id="row'+idBarang+'">'+
                '<td>'+
                    '<p>'+data.text+'</p>'+
                '</td>'+
                '<td class="text-center">'+
                    '<input type="number" placeholder="1" value="1" name="jumlah[]">'+
                    '<input type="hidden" value="new'+idBarang+'" name="id[]">'+
                '</td>'+
                '<td class="text-center">'+
                    '<a class="btn btn-danger" onclick="deleteRow(\'row'+idBarang+'\')">X</a>'+
                '</td>'+
            '</tr>';

        if($('#row'+idBarang).length == 0){
            $('#setOrder').after(html);
        }
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
            '<form action="{{ route('kasir.update','@@@@') }}" id="tablePesananEdit" method="POST">'+
            '{{csrf_field()}}'+
            '<table class="table table-responsive" style="color:white;">'+
                '<tr id="rowheadtablepesanan">'+
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
            success:function(datas){
                $.each(datas, function( index, value ) {
                contentview +=
                    '<tr id="row'+value.masterData+'">'+
                        '<td>'+
                            '<p>'+value.nama+'</p>'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<input type="number" placeholder="'+value.jumlah+'" value="'+value.jumlah+'" name="jumlah[]">'+
                            '<input type="hidden" value="'+value.id+'" name="id[]">'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<a class="btn btn-danger" onclick="deleteRow(\'row'+value.masterData+'\')">X</a>'+
                        '</td>'+
                    '</tr>';
                });
            },
            complete:function(){
                contentview += '</table></form></div>';
                
                var footer = '<div>'+
                        '<button class="btn btn-info" onclick="submit(\'tablePesananEdit\')">Simpan</button>'+
                    '</div>';

                var html = modalEdit.replace('++++', contentview);
                var html = html.replace('////', 'Pesanan '+row.atasNama);
                var html = html.replace('????', footer);
                var html = html.replace('0000', row.idTransaksi);
                var html = html.replace('@@@@', row.idTransaksi);
                
                $('#modaleditdiv').html(html);

                $('#rowheadtablepesanan').after(selectOptionMB);
                $('#selectMasterBarang').select2({
                    dropdownParent: $("#ModalEdit")
                });

                
                $('#ModalEdit').modal('show');
            }
        });
    };

    function showDeleteModal(data){
        var row = table.row(data).data();
        modaldelcontent = 'Yakin mau hapus '+row.idTransaksi+'?';
        modaldelroute = '{{ route('kasir.destroy','+') }}';
        var html = modalDel.replace('++++', modaldelcontent);
        var html = html.replace('----', 'exampleModaldel');
        var html = html.replace('////', modaldelroute.replace('+', row.idTransaksi) );
        $('#modaldeletediv').html(html);

        $('#exampleModaldel').modal('show');
    }
    
    var table = $('#pesananDataTable').DataTable({
        paging: true,
        ajax: {
            url: "{{ route('kasir.show') }}",
            data:function(params) {
                params.status = 1;
            },
            dataSrc: function ( responses ) {
                return responses;
            }
        },
        columns: [
            { data: 'idTransaksi' },
            { data: 'atasNama' },
            { data: 'tanggalAmbil' },
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
    
    <script src="{{ asset('dist/js/select2.min.js') }}"></script>
    <link href="{{ asset('dist/css/select2.min.css') }}" rel="stylesheet" />
@endpush