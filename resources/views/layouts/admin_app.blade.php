<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CremHotel админпанель</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="theme-color" content="#ffffff">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset("css/admin/vendor.css") }}">
    <link rel="stylesheet" href="{{ asset("css/admin/elephant.css") }}">
    <link rel="stylesheet" href="{{ asset("css/admin/application.css") }}">
    <link rel="stylesheet" href="{{ asset("css/admin/custom.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://kit.fontawesome.com/fea7d5cbbb.js" crossorigin="anonymous"></script>
    <script src='{{ asset("js/admin/charts/charts.js") }}'></script>
</head>
@routes
<body class="layout layout-header-fixed">
<div class="layout-header">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center" href="{{ route('admin.mainAdminPage') }}">
                Админпанель
            </a>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
                <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
            </button>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="arrow-up"></span>
                <span class="ellipsis ellipsis-vertical">
              <img class="ellipsis-object" width="32" height="32" src="img/0180441436.jpg" alt="Teddy Wilson">
            </span>
            </button>
        </div>
        <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
                </button>
            </nav>
        </div>
    </div>
</div>

<div class="layout-main">
    <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
            <div class="custom-scrollbar">
                <nav id="sidenav" class="sidenav-collapse collapse">
                    <ul class="sidenav">
                        @foreach ($menu as $item)
                            <li class="sidenav-item
                                @if(explode('.', Route::currentRouteName())[1] === explode('.', $item["route"])[0]))
                                    active
                                @endif
                                ">
                                <a href="{{ route($item["route"]) }}" aria-haspopup="true">
                                    <span class="sidenav-icon icon {{ $item["ico"] }}"></span>
                                    <span class="sidenav-label">{{ $item["name"] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="layout-content">
        <div class="layout-content-body">
            @section('content')
                <div class="title-bar">
                    <h1 class="title-bar-title">
                        <span class="d-ib">Админпанель</span>
                    </h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Средняя стоимость номера:</h5>
                        <div class="card-text">
                            <h3 id="result_sum"></h3>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Средняя зарплата:</h5>
                        <div class="card-text">
                            <h3 id="result_salary"></h3>
                        </div>
                    </div>
                </div>
                <hr>
                <script src="/js/admin/charts/highcharts.js"></script>
                <script src="/js/admin/charts/data.js"></script>

                <div id="container2" style="width:100%; height:400px;"></div>
            @show
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

<script src="{{ asset("js/admin/vendor.min.js") }}"></script>
<script src="{{ asset("js/admin/elephant.min.js") }}"></script>
<script src="{{ asset("js/admin/application.min.js") }}"></script>
<script src="{{ asset("js/admin/custom.js") }}"></script>
<script src='{{ asset("js/admin/cropper.js") }}'></script>
<script src='{{ asset("js/custom_modal.js") }}'></script>
</body>
</html>
