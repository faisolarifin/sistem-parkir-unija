@extends('layouts.firstlayout')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col p-5 ibox">
                <div class="d-flex justify-content-between mb-4">
                    <h3>Data Pengguna</h3>
                    <a href="{{ route('admin.user.tambah') }}" class="btn btn-primary">+ Tambah</a>
                </div>
                <table class="table table-hover" id="mytable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Indentitas</th>
                        <th>Plat Nomor</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($no=0)
                    @foreach($users as $row)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->no_identitas }}</td>
                            <td>{{ $row->platnomor }}</td>
                            <td>{{ $row->account->username }}</td>
                            <td>{{ $row->account->role }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', $row->id_user) }}" class="btn btn-info btn-sm">edit</a>
                                <form action="{{ route('admin.user.delete', $row->id_user) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
