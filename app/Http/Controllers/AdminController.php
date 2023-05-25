<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\ParkirGate;
use App\Models\ParkirGateSpace;
use App\Models\ParkirTrans;
use App\Models\Qruuid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function indexPage(Request $request) {
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

        return view('admin.index', compact('gate', 'perParkirGate', 'transParkirGate'));
    }

    public function indexGates(ParkirGate $gate) {
        $gates = ParkirGate::all();
        return view('admin.gates.gates', compact('gates', 'gate'));
    }
    public function saveGate(Request $request) {
        ParkirGate::create([
            'nama_gate' => $request->nm_gate,
            'jml_max' => $request->jml_max,
        ]);
        return redirect()->back();
    }
    public function deleteGate(ParkirGate $gate) {
        $gate->delete();
        return redirect()->back();
    }
    public function updateGate(Request $request, ParkirGate $gate) {
        $gate->update([
            'nama_gate' => $request->nm_gate,
            'jml_max' => $request->jml_max,
        ]);
        return redirect()->route('admin.gates');
    }

    public function indexGatespace(ParkirGateSpace $gateSpace) {
        $gateSpaces = ParkirGateSpace::with('gate')->get();
        $gate = ParkirGate::all();
        return view('admin.gatespace.gatespace', compact('gateSpaces', 'gateSpace', 'gate'));
    }
    public function saveGatespace(Request $request) {
        ParkirGateSpace::create([
            'id_gate' => $request->gate,
            'kode_space' => $request->kode_space,
        ]);
        return redirect()->back();
    }
    public function deleteGatespace(ParkirGateSpace $gate) {
        $gate->delete();
        return redirect()->back();
    }
    public function updateGatespace(Request $request, ParkirGateSpace $gate) {
        $gate->update([
            'id_gate' => $request->gate,
            'kode_space' => $request->kode_space,
        ]);
        return redirect()->route('admin.gatespace');
    }

    public function indexUsers() {
        $users = User::with('account')->get();
        return view('admin.users.user', compact('users',));
    }
    public function tambahUser() {
        return view('admin.users.tambah');
    }
    public function saveUser(Request $request) {
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_identitas' => $request->no_identitas,
            'platnomor' => $request->platnomor
        ]);
        Account::create([
            'id_user' => $user->id_user,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'active',
        ]);
        Qruuid::create([
            'id_user' => $user->id_user,
            'uuid_enter' => Str::uuid()->toString(),
        ]);

        return redirect()->route('admin.user');
    }
    public function editUser($user) {
        $user = User::with('account')->find($user);
        return view('admin.users.edit', compact('user'));
    }
    public function updateUser(Request $request, User $user) {
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_identitas' => $request->no_identitas,
            'platnomor' => $request->platnomor
        ]);
        Account::where('id_user', '=', $user->id_user)->update([
            'id_user' => $user->id_user,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->account->password,
            'role' => $request->role,
            'status' => 'active',
        ]);

        return redirect()->route('admin.user');
    }
    public function deleteUser(User $user) {
        $user->delete();
        return redirect()->back();
    }

    public function historyPage(Request $request) {
        $transParkirGate = ParkirTrans::with(["user", "gate", "gatespace"]);
        if ($request->tgl_awal && $request->tgl_akhir) {
            $transParkirGate->whereBetween('tgl_masuk', [
                $request->tgl_awal,
                $request->tgl_akhir,
            ]);
        }
        $transParkirGate = $transParkirGate->orderBy('tgl_masuk', 'DESC')->get();
        return view('admin.history.history', compact( 'transParkirGate'));
    }


}
