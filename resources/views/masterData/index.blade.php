@extends('welcome')

@section('content')
    <style>
        table,th,td{
            border: 0.5px solid;border-color:teal;background-color:black;
        }
    </style>

    <div class="m-3">
        <table id="masterDataTable" class="table table-dark" style="width:100%;">
            <thead>
                <tr>
                    <th>Name Produk</th>
                    <th>Jenis Produk</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#masterDataTable').DataTable({
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
                        render: function ( data, type, row, meta ) {
                
                            // HERE I WANT TO SET THE VALUE OF NEXT COLUMN!!!
                
                        }
                    },
                ],
            });
        } );
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}"/>
    
@endpush