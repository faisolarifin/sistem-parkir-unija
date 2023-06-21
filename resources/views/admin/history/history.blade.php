@extends('templates.admin', ['title' => 'History Parkir'])

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h3 class="mt-4">History Parkir</h3>
                <div class="my-3">
                    <form method="get">
                        <div class="row">
                            <div class="col">
                                <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                                <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" placeholder="Tanggal Awal">
                            </div>
                            <div class="col">
                                <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                                <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" placeholder="Tanggal Akhir">
                            </div>
                            <div class="col d-flex align-items-end">
                                <button class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-hover" id="mytable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Gate</th>
                        <th>Kode Space</th>
                        <th>Nama</th>
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
                            <td>{{ $row->gate?->nama_gate }}</td>
                            <td>{{ $row->gatespace?->kode_space }}</td>
                            <td>{{ $row->user?->nama }}</td>
                            <td>{{ $row->user?->platnomor }}</td>
                            <td>{{ $row->tgl_masuk }}</td>
                            <td>{{ $row->tgl_keluar }}</td>
                            <td>{{ $row->lama_parkir }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </section>
@endsection
