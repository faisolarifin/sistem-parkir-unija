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

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-10 col-sm-5 shadow px-5 py-4 rounded bg-white">
            <h5>Login ke Sistem Parkir Universitas Wiraraja</h5>

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible mt-2" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

</body>

</html>
