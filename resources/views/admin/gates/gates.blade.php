@extends('layouts.firstlayout')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col p-5 ibox">
                <h3 class="mb-4">Daftar Gates</h3>

                <div class="row justify-content-between">
                    <div class="col-sm-5">
                        <form action="{{ $gate->id_gate ? route('admin.gates.update', $gate->id_gate) : route('admin.gates.save') }}" method="post">
                            @csrf
                            @if($gate->id_gate)
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="nm_gate" class="form-label">Nama Gate</label>
                                <input type="text" class="form-control" id="nm_gate" name="nm_gate" placeholder="Nama Gate" value="{{ $gate->nama_gate }}">
                            </div>
                            <div class="mb-3">
                                <label for="jml_max" class="form-label">Jumlah Maksimal</label>
                                <input type="number" class="form-control" id="jml_max" name="jml_max" placeholder="Jumlah Maksimal" value="{{ $gate->jml_max }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-hover" id="mytable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Gates</th>
                                <th>Jumlah Maksimal</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($no=0)
                            @foreach($gates as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $row->nama_gate }}</td>
                                    <td>{{ $row->jml_max }}</td>
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
    </div>
@endsection
