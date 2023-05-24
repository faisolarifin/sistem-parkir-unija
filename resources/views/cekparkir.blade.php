@extends('layouts.firstlayout')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col p-5 ibox">
                <h3 class="mb-4">Daftar Parkir</h3>
                <select class="form-select" onchange="location = this.value;">
                    @foreach($gate as $row)
                        <option value="?gate={{ $row->id_gate }}" {{ request('gate') == $row->id_gate ? 'selected' : '' }}>{{ $row->nama_gate }}</option>
                    @endforeach
                </select>
                <table class="table table-hover mt-4">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Space</th>
                        <th>Plat Nomor</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($no=0)
                    @foreach($perParkirGate as $row)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $row->kode_space }}</td>
                        <td>{{ $row->user?->platnomor }}</td>
                        <td>{{ $row->trans?->tgl_masuk }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <h3 class="mt-4">History Parkir</h3>
                <table class="table table-hover" id="mytable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Space</th>
                        <th>Plat Nomor</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Lama Parkir</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($no=0)
                    @foreach($transParkirGate as $row)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $row->gatespace?->kode_space }}</td>
                            <td>{{ $row->user?->platnomor }}</td>
                            <td>{{ $row->tgl_masuk }}</td>
                            <td>{{ $row->tgl_keluar }}</td>
                            <td>{{ 0 }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
