@extends('welcome')

@section('content')
    <style>
        .list-group-item,.card{
            background-color: #04293A !important;
            color: white;
            border-color: aqua;
        }
    </style>

    <div class="row container-fluid mt-1 ms-1" style="width:99vw !important;height:85vh !important;">
        <div class="row col-sm-8 border border-info overflow-auto" style="height: 100% !important" id="dataCard">
            <div class="col-sm-12 ms-1">
                <button class="btn btn-info">Jenis Makanan</button>
                <button class="btn btn-info">Jenis Makanan</button>
                <button class="btn btn-info">Jenis Makanan</button>
                <button class="btn btn-info">Jenis Makanan</button>
            </div>
        </div>
        <div class="col-sm-4" style="height: 100% !important;">
            <div class="container-fluid mb-1" style="height: 75% !important;padding:0px !important;">
                <ul class="list-group overflow-auto border border-info" style="height: 100% !important;">
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                    <li class="list-group-item"><p>Nama Makanan X 2 = 20000</p> </li>
                <ul>
            </div>

            <div class="border border-info col-sm-12 d-flex justify-content-between" style="height: 25% !important;">
                <div class="ms-1">
                    <p>Total :</p>
                    <p>Diskon :</p>
                </div>
                <button type="submit" class="btn btn-info">Simpan</button>
            </div>

        </div>
    </div>

    <script>
        dataCard('makanan');

        function dataCard(data){
            $.ajax({
                url: "{{ route('masterData.index') }}",
                data: {
                    jenis_makanan : data
                },
                success:function(data){
                    $.each(data, function( index, value ) {
                        content = 
                        '<div class="card col-sm-2 m-2">'+
                        '    <img src="{{asset('images')}}/'+value.imageUrl+'" class="card-img-top" alt="...">'+
                        '    <div class="card-body">'+
                        '       <p class="card-text">'+value.nama+'</p>'+
                        '    </div>'+
                        '</div>'
                        ;
                        $('#dataCard').append(content);
                    });
                }
            });
        };
    </script>
@endsection

@push('scripts')

@endpush