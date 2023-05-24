@extends('layouts.firstlayout')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col p-5 ibox">
                <h3 class="mb-4">Daftar GateSpaces</h3>

                <div class="row justify-content-between">
                    <div class="col-sm-5">
                        <form action="{{ $gateSpace->id_gatespace ? route('admin.gatespace.update', $gateSpace->id_gatespace) : route('admin.gatespace.save') }}" method="post">
                            @csrf
                            @if($gateSpace->id_gatespace)
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="gate" class="form-label">Nama Gate</label>
                                <select class="form-select" name="gate">
                                    @foreach($gate as $row)
                                        <option value="{{ $row->id_gate }}" {{ $gateSpace->id_gate == $row->id_gate ? 'selected' : '' }}>{{ $row->nama_gate }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kode_space" class="form-label">Kode Space</label>
                                <input type="text" class="form-control" id="kode_space" name="kode_space" placeholder="Kode Space" value="{{ $gateSpace->kode_space }}">
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
                                <th>Kode GateSpace</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($no=0)
                            @foreach($gateSpaces as $row)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $row->gate->nama_gate }}</td>
                                    <td>{{ $row->kode_space }}</td>
                                    <td>
                                        <a href="{{ route('admin.gatespace.edit', $row->id_gatespace) }}" class="btn btn-info btn-sm">edit</a>
                                        <form action="{{ route('admin.gatespace.delete', $row->id_gatespace) }}" method="post" class="d-inline">
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
