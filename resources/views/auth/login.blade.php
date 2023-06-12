<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/login.css") }}">

    <title>Login Sistem Parkir</title>
</head>

<body>

<div class="d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-5 shadow px-5 py-4 rounded bg-white">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/logo-universitas-wiraraja-madura.png') }}" alt="Logo Unija" width="60">
                    <div class="ms-3">
                        <h5 class="mb-1">Login ke Sistem Parkir </h5>
                        <h6 class="mb-0">Universitas Wiraraja</h6>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="post" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ old('username') }}">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Passowrd</label>
                        <input type="password" name="password" class="form-control" id="passowrd" placeholder="Password">
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary d-block">Login</button>
                    </div>
                </form>
                <div class="row mt-3">
                    <div class="col text-center">
                        <p class="mb-0">Belum punya akun? daftar <a href="{{ route('register') }}">disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
