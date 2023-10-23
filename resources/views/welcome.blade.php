<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="{{ asset('jquery.min.js') }}"></script>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Laravel</title>
        
        @stack('scripts')

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            
            table,th,td{
                border: 0.5px solid;border-color:teal;background-color:black;
            }
    
            .dataTables_length{
                text-align:start !important;
            }
            .dataTables_filter{
                text-align:end !important;
            }

            .nav-link{
                color:white !important;
            }
            .nav-link.active{
                /* background-color: #0dcaf0 !important; */
                color:#0dcaf0 !important;
            }
        </style>
    </head>
    <body style="background-color:#04293A;color:aliceblue;">
    @guest
        <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="row h-25 w-50">
                <div class="col-lg-6 offset-md-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    @endguest

    @auth
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid d-flex justify-content-between">
            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-border-width" viewBox="0 0 16 16">
                    <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>

            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                    <path d="M7.5 1v7h1V1h-1z"/>
                    <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                </svg>
            </button>
        </div>
    </nav>

    <x-alert content="Yakin Mau Keluar?" :route="route('logout')" id="exampleModal" size="sm" />
    
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header" style="background-color:#04293A;">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menus</h5>
            <button type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                  </svg>
            </button>
        </div>
        <div class="offcanvas-body" style="background-color:#04293A;">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" style="color:white;">
                <li class="nav-item">
                  <a class="active nav-link" aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('masterData.index') }}">Master Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kasir.index') }}">Kasir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kasir.edit') }}">Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kasir.laporan') }}">Laporan</a>
                </li>
            </ul>
        </div>
    </div>

    @yield('content')

    @endauth
    
    
    @if(Illuminate\Support\Facades\Route::is('welcome') && auth()->check())
        <div class="d-flex align-items-center">
            <h1 class="ms-3 mt-2">Omset Per Tahun</h1>
            <select class="form-select ms-2" style="width: 10% !important;" name="yearDashboard" id="yearDashboard">
                <option value="2021">2021</option>
                <option value="2022" selected>2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
            </select>
        </div>
        <div id="chart_omsetPertahun" style="margin: 20px !important"></div>
        <h1 class="ms-3 mt-2">Items Terlaris</h1>
        <div id="chart_BarangPalingLaris" style="margin: 20px !important"></div>

        <script>

            $('#yearDashboard').on('change', function() {
                drawTitleSubtitle()
            });
            
            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawTitleSubtitle);

            function drawTitleSubtitle() {

                $.ajax({
                    url: "{{ route('kasir.show') }}",
                    data: {
                        year : $('#yearDashboard').val(),
                    },
                    success:function(datas){
                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'bulan');
                        data.addColumn('number', 'Omset');

                        $.each(datas, function (key, value) {
                            data.addRows([
                                [GetMonthName(parseInt(value.created_at.substring(5,7))),parseInt(value.count)]
                            ])
                        })    
                        
                        var options = {
                            chart: {
                                title: 'Omset bulanan perTahun',
                            },
                            hAxis: {
                                title: 'Time of Day',
                                format: 'h:mm a',
                                viewWindow: {
                                    min: [7, 30, 0],
                                    max: [17, 30, 0]
                                }
                            },
                            vAxis: {
                                title: 'Rating (scale of 1-10)'
                            },
                            width : $(window).width() - 50,
                            height : $(window).height() / 2.5
                        };

                        var materialChart = new google.charts.Bar(document.getElementById('chart_omsetPertahun'));
                        var formatter = new google.visualization.NumberFormat(
                            {
                                fractionDigits:true,
                                prefix: 'Rp.'
                            }
                        );
                        
                        formatter.format(data, 1);
                        materialChart.draw(data, options);
                    }
                });
            }

            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawBarColors);

            function drawBarColors() {
                $.ajax({
                    url: "{{ route('kasir.show') }}",
                    data: {
                        get : 'populer_item',
                    },
                    success:function(datas){
                        var data = [['Item','Jumlah']];

                        $.each(datas, function (key, value) {
                            data.push([value.itemName , parseInt(value.total)])
                        })

                        var dataBar = google.visualization.arrayToDataTable(data);

                        var options = {
                            title: '10 Item dengan penjualan terbanyak',
                            chartArea: {width: '50%'},
                            colors: ['#b0120a'],
                            hAxis: {
                            title: 'Penjualan',
                            minValue: 0
                            },
                            vAxis: {
                            title: 'Item'
                            },
                            width : $(window).width() - 50,
                            height : $(window).height() / 2.5
                        };

                        var chart = new google.visualization.BarChart(document.getElementById('chart_BarangPalingLaris'));
                        chart.draw(dataBar, options);
    
                    }
                });
            }

            function GetMonthName(monthNumber) {
                var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                 'September', 'October', 'November', 'December'];
                return months[monthNumber - 1];
            }
        </script>
    @endif

    </body>
</html>
