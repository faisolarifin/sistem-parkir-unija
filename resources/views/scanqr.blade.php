@extends('layouts.firstlayout')

@section('content')
    <div class="container">
        <div class="row mt-4 justify-content-center">
            <div class="col-10 col-sm-7 py-4 px-5 ibox">
                <h3 class="text-center mb-3">Scan QR</h3>
                <div class="text-center">
                    <video id="preview"></video>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <div class="mt-3 atensi"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        let atensiHtml = document.getElementsByClassName('atensi');
        let audio = document.createElement("audio");
        audio.autoplay = true;

        scanner.addListener('scan', function (content) {
            //xml http request
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    let res = JSON.parse(this.responseText);
                    if (this.status == 200) {
                        let source = "{{ asset('assets/sound/success-1-6297.mp3') }}";
                        audio.load()
                        audio.addEventListener("load", function() {
                            audio.play();
                        }, true);
                        audio.src = source;
                        atensiHtml.item(0).innerHTML = `<div class="alert alert-success" role="alert"> ${res.message} </div>`;
                    } else if (this.status == 400) {
                        let source = "{{ asset('assets/sound/negative_beeps-6008.mp3') }}";
                        audio.load()
                        audio.addEventListener("load", function() {
                            audio.play();
                        }, true);
                        audio.src = source;
                        atensiHtml.item(0).innerHTML = `<div class="alert alert-danger" role="alert"> ${res.message} </div>`;
                    }
                    setTimeout(function () {
                        atensiHtml.item(0).innerHTML = '';
                    }, 5000);
                }
            };
            xhttp.open("POST", "/scanqr", true);
            xhttp.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
            xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhttp.send(JSON.stringify({"qr" : content, "gate" : 1}));
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>
@endsection
