<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <title>Document</title>
</head>
<body>

    <div class="header">
        <img src="{{ asset('assets/images/smkn1cibinong.png') }}" alt="" class="badge">
        <img src="{{ asset('assets/images/smkhebat.jpg') }}" alt="" class="banner">
    </div>


    <div class="sidebar">
        @if (session('role') == 'Walas')
            <a href="/nilai-raport/create">INPUT NILAI</a>
            <a href="/nilai-raport/index">REKAP NILAI</a>
        @else
            <a href="/nilai-raport/show">REKAP NILAI</a>
        @endif
            <a href="/logout">LOGOUT</a>
    </div>
    <div class="container">
        @yield('name')
        <div class="greet">
            <h4>Hallo, {{ session('nama') }}</h4>
        </div>
    </div>

    <div style="text-align: center">
        @yield('content')
    </div>

    <footer>
        <div class="footer">
            <p>GACOR</p>
        </div>
    </footer>

</body>
</html>
