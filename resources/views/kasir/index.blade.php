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
        </div>
        <div class="col-sm-4" style="height: 100% !important;">
            <div class="container-fluid mb-1" style="height: 75% !important;padding:0px !important;">
                <ul class="list-group overflow-auto border border-info" id="datalist" style="height: 100% !important;">
                    
                <ul>
            </div>

            <div class="border border-info col-sm-12 d-flex justify-content-between" style="height: 25% !important;">
                <div class="ms-1">
                    <p>Total :</p>
                    <p id="totalBayar" data-total="0">0</p>
                    <p>Diskon :</p>
                </div>
                <button type="submit" class="btn btn-info">Simpan</button>
            </div>

        </div>
    </div>

    <script>
        dataCategory(true);
        dataCard('makanan');
        
        var content = '<div><button class="btn btn-info m-1" onclick="dataCard(\'all\')">Semua</button>';

        function dataCategory(data){
            $.ajax({
                url: "{{ route('masterData.index') }}",
                data: {
                    getjenis : data
                },
                success:function(data){        
                    $.each(data, function( index, value ) {
                        content +=
                        '<button class="btn btn-info m-1" onclick="dataCard(\''+value.jenis+'\')">'+value.jenis+'</button>';
                    });

                    content += '</div>';
                }
            });
        };

        function dataCard(data){
            $.ajax({
                url: "{{ route('masterData.index') }}",
                data: {
                    jenis_makanan : data
                },
                success:function(data){
                    var cardcontent = '';
                    $.each(data, function( index, value ) {
                        cardcontent +=
                        "<div class='card col-sm-2 m-2' onclick='addMenu("+JSON.stringify(value)+")'>"+
                        "    <img src='{{asset("images")}}/"+value.imageUrl+"' class='card-img-top' alt='"+value.nama+"'>"+
                        "    <div class='card-body'>"+
                        "       <p class='card-text'>"+value.nama+"</p>"+
                        "    </div>"+
                        "</div>";
                    });

                    $('#dataCard').html(content + cardcontent);
                }
            });
        };

        function addMenu(value){
            var jumlah = 1;
            if($('#idmenu'+value.id).length != 0){
                jumlah = $('#idmenu'+value.id).data("jumlah") + 1;
                $('#idmenu'+value.id).remove();
                $('#datalist').append("<li class='list-group-item' id='idmenu"+value.id+"' data-jumlah='"+jumlah+"' onclick='removeMenu("+JSON.stringify(value)+")'><p>"+value.nama+" = "+jumlah+" X "+value.harga+"</p></li>");
            }else{
                $('#datalist').append("<li class='list-group-item' id='idmenu"+value.id+"' data-jumlah='1' onclick='removeMenu("+JSON.stringify(value)+")'><p>"+value.nama+" = "+jumlah+" X "+value.harga+"</p></li>");
            }

            $('#totalBayar').html($('#totalBayar').data("total") + value.harga);
            $('#totalBayar').data("total",$('#totalBayar').data("total") + value.harga);
        }

        function removeMenu(value){
            var jumlah = 1;
            if($('#idmenu'+value.id).data("jumlah") > 1){
                jumlah = $('#idmenu'+value.id).data("jumlah") - 1;
                $('#idmenu'+value.id).remove();
                $('#datalist').append("<li class='list-group-item' id='idmenu"+value.id+"' data-jumlah='"+jumlah+"' onclick='removeMenu("+JSON.stringify(value)+")'><p>"+value.nama+" = "+jumlah+" X "+value.harga+"</p></li>");
            }else{
                $('#idmenu'+value.id).remove();
            }

            $('#totalBayar').html($('#totalBayar').data("total") - value.harga);
            $('#totalBayar').data("total",$('#totalBayar').data("total") - value.harga);
        }

    </script>
@endsection

@push('scripts')

@endpush