@extends('templates.admin', ['title' => 'Cek Parkir'])

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">

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
                <div class="text-center">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($selectedGate->denah) }}" alt="..." width="70%">
                </div>

            </div>
        </div>
    </section>
@endsection
