@extends('templates.admin', ['title' => 'Dashboard'])

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">

                <h3>Home</h3>
                <div class="d-flex flex-column justify-content-center text-center align-items-center" style="height:30rem;">
                    <img class="mb-3" src="{{ asset('assets/images/logo-universitas-wiraraja-madura.png') }}" alt="Logo Unija" width="130">
                    <h2>Selamat Datang</h2>
                    <h2>Sistem Parkir Universitas Wiraraja</h2>
                </div>

            </div>
        </div>
    </section>
@endsection
