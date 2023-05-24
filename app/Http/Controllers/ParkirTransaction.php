<?php

namespace App\Http\Controllers;

use App\Models\ParkirGate;
use App\Models\ParkirGateSpace;
use App\Models\ParkirTrans;
use App\Models\Qruuid;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ParkirTransaction extends Controller
{

    public function getTransPerParkirGate(Request $request)
    {
        $getGate = $request->gate ?? 1;
        $gate = ParkirGate::all();
        $perParkirGate = ParkirGateSpace::with(["user", "gate", "trans"])
            ->whereHas("gate", function($q) use ($getGate) {
                $q->where('id_gate', '=', $getGate);
            })->get();

        $transParkirGate = ParkirTrans::with(["user", "gatespace"])
            ->whereDate('tgl_masuk', Carbon::today())
            ->where('id_gate', '=', $getGate)
            ->get();

        return view('cekparkir', compact('gate', 'perParkirGate', 'transParkirGate'));
    }
    public function indexMyQR() {
        $qr = Qruuid::with(["trans.gatespace", "user"])->where('id_user', '=', 1)->first();
        $enterQr = $this->encodeQr($qr->uuid_enter, 'enter');
        $exitQr  = $this->encodeQr($qr->uuid_exit, 'exit');
        return view('barcodeuser', compact('qr', 'enterQr', 'exitQr'));
    }

    public function indexScanQR() {
        return view('scanqr');
    }

    public function processQrScanned(Request $request) {

        $userQr = json_decode(base64_decode($request->qr));
        $kodeGate = $request->gate;

        if ($userQr->type == 'enter') {
            $userByQr = Qruuid::where("uuid_enter", "=", $userQr->code);
            $userFirst = $userByQr->first();

            if($userFirst == null) return response()->json([
                "message" => "Invalid QR Code!!"
            ], 400);

            if ($userFirst->id_trans !== null) return response()->json([
                "message" => "Anda Sudah Scan QR!!"
            ], 400);

            $randomEmptySpaceGate = ParkirGateSpace::inRandomOrder()->where([
                "id_user" => null,
                "id_gate" => $kodeGate,
            ])->limit(1)->first();

            if ($randomEmptySpaceGate == null) return response()->json([
                "message" => "Space Parkir Sudah Penuh!"
            ], 400);

            ParkirGateSpace::find($randomEmptySpaceGate->id_gatespace)->update([
                "id_user" => $userFirst->id_user,
            ]);
            $trans = ParkirTrans::create([
                "id_gate" => $kodeGate,
                "id_gatespace" => $randomEmptySpaceGate->id_gatespace,
                "id_user" => $userFirst->id_user,
                "tgl_masuk" => Carbon::now(),
                "kode_masuk" => $userQr->code,
            ]);
            $userByQr->update([
                "id_trans" => $trans->id_trans,
                "uuid_exit" => Str::uuid()->toString(),
            ]);
            return response()->json([
                "message" => "Berhasil Scan QR, Gerbang Segera di Buka. Silahkan Masuk.."
            ], 200);

        } elseif ($userQr->type == 'exit') {
            $userByQr = Qruuid::where("uuid_exit", "=", $userQr->code);
            $userFirst = $userByQr->with("trans")->first();

            if($userFirst == null) return response()->json([
                "message" => "Invalid QR Code!"
            ], 400);
            if ($userFirst->id_trans == null) return response()->json([
                "message" => "Anda Sudah Scan QR!!"
            ], 400);

            ParkirGateSpace::find($userFirst->trans->id_gatespace)->update([
                "id_user" => null,
            ]);
            ParkirTrans::find($userFirst->id_trans)->update([
                "tgl_keluar" => Carbon::now(),
                "kode_keluar" => $userQr->code,
            ]);
            $userByQr->update([
                "id_trans" => null,
                "uuid_enter" => Str::uuid()->toString(),
            ]);

            return response()->json([
                "message" => "Berhasil Scan QR, Gerbang Segera di Buka. Silahkan Keluar.."
            ], 200);
        }

    }

    private function encodeQr($code, $type) {
        return base64_encode(json_encode([
            "code" => $code,
            "type" => $type,
        ]));
    }

    public function generateUuid() {
        return Str::uuid()->toString();
    }

}
