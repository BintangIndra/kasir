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
                    <p style="margin:0 !important">Total :</p>
                    <p id="totalBayar" data-total="0" style="margin:0 !important">0</p>
                    <p>Diskon :</p>
                    <input type="number" class="form-control">
                </div>
                <button type="submit" class="btn btn-info" onclick="">Simpan</button>
            </div>

        </div>
    </div>

    <script>
        dataCategory(true);
        dataCard('all');
        
        var content = '<div class="col-sm-12"><button class="btn btn-info m-1" onclick="dataCard(\'all\')">Semua</button>';

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
                        "<div class='card col-sm-2 m-2' style='height:20% !important;' onclick='addMenu("+JSON.stringify(value)+")'>"+
                        "    <img src='{{asset("images")}}/"+value.imageUrl+"' class='card-img-top img-fluid'>"+
                        "    <div class='card-body' style='padding:0px !important;'>"+
                        "       <p class='card-text text-truncate'>"+value.nama+"</p>"+
                        "    </div>"+
                        "</div>";
                    });

                    $('#dataCard').html(content + cardcontent);
                }
            });
        };

        var menu=[];
        function addMenu(value){
            var jumlah = 1;
            if($('#idmenu'+value.id).length != 0){
                jumlah = $('#idmenu'+value.id).data("jumlah") + 1;
                $('#idmenu'+value.id).remove();
                
                var indx=menu.findIndex(x => x.id === value.id);
                menu[indx] ={id: value.id,nama : value.nama,harga : value.harga,jumlah : jumlah};
            }else{
                menu.push({id: value.id,nama : value.nama,harga : value.harga,jumlah : jumlah});
            }

            drawmenu();
            $('#totalBayar').html($('#totalBayar').data("total") + value.harga);
            $('#totalBayar').data("total",$('#totalBayar').data("total") + value.harga);
        }

        function removeMenu(value){
            var jumlah = 1;
            if($('#idmenu'+value.id).data("jumlah") > 1){
                jumlah = $('#idmenu'+value.id).data("jumlah") - 1;
                $('#idmenu'+value.id).remove();
                
                var indx=menu.findIndex(x => x.id === value.id);
                menu[indx] ={id: value.id,nama : value.nama,harga : value.harga,jumlah : jumlah};
            }else{
                menu.splice(menu.findIndex(x => x.id === value.id), 1);
                $('#idmenu'+value.id).remove();
            }

            drawmenu();
            $('#totalBayar').html($('#totalBayar').data("total") - value.harga);
            $('#totalBayar').data("total",$('#totalBayar').data("total") - value.harga);
        }

        function drawmenu(){
            var listMenu = '';
            $.each(menu, function( index, value ) {
                listMenu += "<li class='list-group-item' id='idmenu"+value.id+"' data-jumlah='"+value.jumlah+"' onclick='removeMenu("+JSON.stringify(value)+")'><p>"+value.nama+" = "+value.jumlah+" X "+value.harga+"</p></li>";
            });
            $('#datalist').html(listMenu);
        }

    </script>
@endsection

@push('scripts')

@endpush