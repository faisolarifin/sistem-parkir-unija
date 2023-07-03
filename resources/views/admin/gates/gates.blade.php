@extends('templates.admin', ['title' => 'Gates'])

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h3 class="mb-4">Daftar Gates</h3>

                <div class="row justify-content-between">
                    <div class="col-sm-4 px-3">
                        <form action="{{ $gate->id_gate ? route('admin.gates.update', $gate->id_gate) : route('admin.gates.save') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if($gate->id_gate)
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="nm_gate" class="form-label">Nama Gate</label>
                                <input type="text" class="form-control" id="nm_gate" name="nm_gate" placeholder="Nama Gate" value="{{ $gate->nama_gate }}">
                            </div>
                            <div class="mb-3">
                                <label for="nm_gate" class="form-label">Username Gate</label>
                                <select class="form-select" name="id_akun">
                                    @foreach($akun as $row)
                                        <option value="{{ $row->id_akun }}" {{ $row->id_akun == $gate->id_akun ? 'selected' : '' }}>
                                            {{ $row->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jml_max" class="form-label">Jumlah Maksimal</label>
                                <input type="number" class="form-control" id="jml_max" name="jml_max" placeholder="Jumlah Maksimal" value="{{ $gate->jml_max }}">
                            </div>
                            <div class="mb-3">
                                <label for="denah" class="form-label">Denah Parkir</label>
                                <input type="file" class="form-control" id="denah" name="denah" placeholder="Denah Parkir">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="col-sm-8 px-4">
                        <table class="table table-hover" id="mytable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Gates</th>
                                <th>Username Gate</th>
                                <th>Jumlah Maksimal</th>
                                <th>Denah Parkir</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($no=0)
                            @foreach($gates as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $row->nama_gate }}</td>
                                    <td>{{ $row->akun->username }}</td>
                                    <td>{{ $row->jml_max }}</td>
                                    <td><a href="uploads/{{ $row->denah }}" target="_blank">
                                            <img src="uploads/{{ $row->denah }}" alt=".." width="100">
                                        </a></td>
                                    <td>
                                        <a href="{{ route('admin.gates.edit', $row->id_gate) }}" class="btn btn-info btn-sm">edit</a>
                                        <form action="{{ route('admin.gates.delete', $row->id_gate) }}" method="post" class="d-inline">
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
        </div>
    </section>
@endsection
