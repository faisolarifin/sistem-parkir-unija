@extends('layouts.firstlayout')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col p-5 ibox">
                <div class="d-flex justify-content-between mb-4">
                    <h3>Tambah Pengguna</h3>
                </div>
                <form action="{{ route('admin.user.save') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" name="username" class="form-control" id="username" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label for="no_identitas" class="form-label">No Identitas</label>
                                <input type="text" name="no_identitas" class="form-control" id="no_identitas" placeholder="No Identitas">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="platnomor" class="form-label">Plat Nomor</label>
                                <input type="text" name="platnomor" class="form-control" id="platnomor" placeholder="Plat Nomor">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="passowrd" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="role">
                                    <option value="user">user</option>
                                    <option value="gate">gate</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
    </div>
@endsection
