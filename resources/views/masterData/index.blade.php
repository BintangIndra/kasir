@extends('welcome')

@section('content')
    <div class="m-3">
        <div class="d-flex justify-content-between">
            <h3>Daftar Master Data</h1>
            <button type="button" class="btn btn-info mb-1" data-bs-toggle="modal" data-bs-target="#exampleModalcreate">Create</button>
        </div>
        <table id="masterDataTable" class="table table-dark" style="width:100%;">
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

    @php
        $contentcreate = 
            '<form method="POST" action="'.route("masterData.store").'" enctype="multipart/form-data">
                '.csrf_field().'
                <div class="form-group">
                    <label for="name">Name Produk</label>
                    <input type="text" class="form-control" name="name" placeholder="Name Produk">
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis Produk</label>
                    <input type="text" class="form-control" name="jenis" placeholder="Jenis Produk">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" placeholder="Harga">
                </div>
                <div class="form-group mb-2">
                    <label for="Upload File">Upload File</label><br>
                    <input type="file" name="file" placeholder="Choose file" id="file">
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>';
    @endphp
    
    @if ($errors->any())
        @php
            $errorItem='';
            foreach ($errors->all() as $error) {
                $errorItem .= '<li>'.$error.'</li>';
            }

            $content = 
                '<div>
                    Gagal Membuat Master Barang
                    <ul>'.$errorItem.'</ul>
                </div>';
        @endphp
        <x-alert :content="$content" :route=null id="error"/>
    @endif 
    
    <x-modal :content="$contentcreate" id="exampleModalcreate" title="Create Master Data"/>

    <div id="modalview">
        <x-alert content="++++" :route=null id="----"/>
    </div>

    <div id="modaledit">
        <x-modal content="++++" id="exampleModaledit" title="Edit Master Data"/>
    </div>

    <div id="modaldelete">
        <x-alert content="++++" route="////" id="----"/>
    </div>
    
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                $('#error').modal('show');
            @endif
        });

        var modal = $('#modalview').html();
        var modaledit = $('#modaledit').html();
        var modaldel = $('#modaldelete').html();

        function showviewModal(data){
            var row = table.row(data).data();
            var contentview = 
            '<div><h4>'+row.nama+'</h4></br>'+
            '<img src="{{asset('images')}}/'+row.imageUrl+'" class="img-fluid" alt="Responsive image"></div>';

            var html = modal.replace('++++', contentview);
            var html = html.replace('----', 'Modalview');
            $('#modalview').html(html);
            
            $('#Modalview').modal('show');
        };
        
        function showEditModal(data){
            var row = table.row(data).data();
            var contentedit =
                '<form method="POST" action="{{ route("masterData.update", ":id")}}" enctype="multipart/form-data">'+
                    row.nama+
                    '{{csrf_field()}}'+
                '    <div class="form-group">'+
                '        <label for="name">Name Produk</label>'+
                '        <input type="text" class="form-control" name="name" value="'+row.nama+'">'+
                '    </div>'+
                '    <div class="form-group">'+
                '        <label for="jenis">Jenis Produk</label>'+
                '        <input type="text" class="form-control" name="jenis" value="'+row.jenis+'">'+
                '    </div>'+
                '    <div class="form-group">'+
                '        <label for="harga">Harga</label>'+
                '        <input type="number" class="form-control" name="harga" value="'+row.harga+'">'+
                '    </div>'+
                '    <div class="form-group mb-2">'+
                '        <label for="Upload File">Upload File</label><br>'+
                '           <img src="{{asset('images')}}/'+row.imageUrl+'" class="img-fluid" alt="Responsive image">'+
                '        <input type="file" name="file" valu placeholder="Choose file" id="file">'+
                '    </div>'+
                '    <button type="submit" class="btn btn-info">Submit</button>'+
                '</form>' 
            ;
            var html = modaledit.replace('++++', contentedit);
            var html = html.replace(':id', row.id);
            $('#modaledit').html(html);

            $('#exampleModaledit').modal('show');
        };      

        function showDeleteModal(data){
            var row = table.row(data).data();
            modaldelcontent = 'Yakin mau hapus '+row.nama+'?';
            modaldelroute = '{{ route('masterData.destroy','+') }}';
            var html = modaldel.replace('++++', modaldelcontent);
            var html = html.replace('----', 'exampleModaldel');
            var html = html.replace('////', modaldelroute.replace('+', row.id) );
            $('#modaldelete').html(html);
 
            $('#exampleModaldel').modal('show');
        }

        var table = $('#masterDataTable').DataTable({
            paging: true,
            ajax: {
                url: "{{ route('masterData.index') }}",
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
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}"/>
    
@endpush