@extends('layouts.firstlayout')

@section('content')
    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-10 col-sm-8 px-5 py-4 ibox">
                <h3>My QR</h3>
                @if(!$qr->id_trans)
                <div class="row mt-3 justify-content-center">
                    <div class="col-sm-6 text-center">
                        <h3 class="mb-3">QR Masuk</h3>
                        {!! QrCode::size(300)->generate($enterQr) !!}
                        <div class="mt-3">
                            <p class="mb-0 text-uppercase">{{ $qr?->user?->nama }}</p>
                            <p>{{ $qr?->user?->no_identitas }}</p>
                        </div>
                        <div class="text-start">
                            <small>*) Scan qr code masuk pada gate parkir untuk registrasi dan masuk area parkir. Setelah scan qr berhasil, parkir kendaraan anda sesuai space yang ditentukan di bawah qr keluar.</small>
                        </div>
                    </div>
                </div>
                @else
                <div class="row mt-3 justify-content-center">
                    <div class="col-sm-6 text-center">
                        <h3 class="mb-3">QR Keluar</h3>
                        {!! QrCode::size(300)->generate($exitQr) !!}
                        <div class="mt-3">
                            <p class="mb-0">Tempatkan kendaraan anda pada space</p>
                            <p><strong>{{ $qr?->trans?->gatespace?->kode_space }}</strong></p>
                        </div>
                        <div class="text-start">
                            <small>*) Scan qr code keluar pada gate parkir untuk keluar area parkir. Setelah scan qr berhasil, pilih space parkir untuk mendapatkan kode qr keluar.</small>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
