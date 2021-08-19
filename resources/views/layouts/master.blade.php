<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
            integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <title>iCrawler - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

</head>
<body>
@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" class="btn position-relative" onclick="window.location={{ url("/") }}">
                iCrawler Monitor
                <span class="badge rounded-pill bg-danger">Alpha 1.0</span>
            </button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Monitor
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="#">Pivot Table</a></li>
                            <li><a class="dropdown-item" href="#">Warning Report</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url("crawler") }}">Crawler Tools</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Config Site</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Revisit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url("redis") }}">Redis View</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-expanded="false">
                            KHUNANON.C
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li>
                                <button class="dropdown-item" type="button">Manage Users</button>
                            </li>
                            <li>
                                <button class="dropdown-item" type="button">Manage Groups</button>
                            </li>
                            <li>
                                <button class="dropdown-item" type="button">Log Out</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

@show
<div class="wrapper">
    <div class="container-fluid" style="margin-top:10px; height: 100%">
        @yield('content')
    </div>
</div>
@section('script')

@show
</body>
</html>
