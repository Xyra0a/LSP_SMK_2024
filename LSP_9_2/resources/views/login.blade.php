<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <title>Document</title>
</head>
<body>

    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets/images/smkn1cibinong.png') }}" alt="">
        </div>

        <div class="form-container">
            <div class="tab">
                <button class="tablinks active" onclick="openTab(event, 'Student')">Siswa</button>
                <button class="tablinks" onclick="openTab(event, 'Teacher')">Walas</button>
            </div>

            <div class="tabcontent" id="Student" style="display: block">
                <h3>Login Siswa</h3>
                <h4>{{ session('error') }}</h4>

                <form action="/login-siswa" method="POST">
                    @csrf

                    <label for="">NIS</label>
                    <input type="text" name="txt_nis" placeholder="Masukkan NIS" required>

                    <label for="">PASSWORD</label>
                    <input type="password" name="txt_pass" placeholder="Masukkan PASSWORD" required>

                    <button type="submit">Login</button>
                </form>
            </div>

            <div class="tabcontent" id="Teacher" style="display: none">
                <h3>Login Walas</h3>
                <h4>{{ session('error') }}</h4>

                <form action="/login-walas" method="POST">
                    @csrf

                    <label for="">NIG</label>
                    <input type="text" name="txt_nig" placeholder="Masukkan NIG" required>

                    <label for="">PASSWORD</label>
                    <input type="password" name="txt_pass" placeholder="Masukkan PASSWORD" required>

                    <button type="submit">Login</button>
                </form>
            </div>
        </div>

    </div>
</body>
</html>
