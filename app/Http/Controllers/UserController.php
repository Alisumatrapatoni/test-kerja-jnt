<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $cabang = Cabang::all();
        $users = User::all();
        return view('user.listUser', [
            'users'     => $users,
            'cabang'    => $cabang
        ]);
    }

    public function create()
    {
        $cabang = Cabang::all();
        return view('user.createUser', ['cabang' => $cabang]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'status'    => 'required',
            'cabang_id' => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
        ]);

        User::create([
            'name'          => $request->name,
            'status'        => $request->status,
            'cabang_id'     => $request->cabang_id,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'created_at'    => now(),
        ]);

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $cabang = Cabang::all();
        $user = User::findOrFail($id);
        return view('user.editUser', [
            'cabang'    => $cabang,
            'user'      => $user
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'      => 'required',
            'status'    => 'required',
            'cabang_id'    => 'required',
            'email'     => 'required|email|unique:users,email,' . $id,
            'password'  => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->status = $request->status;
        $user->cabang_id = $request->cabang_id;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    public function manager_cabang()
    {
        $users = User::where('status', 'manager')->get();
        return view('user.listManager', [
            'users' => $users
        ]);

    }
    public function cabang_versi_manager()
    {
        $cabang_id = auth()->user()->cabang_id;
        $users = User::where('status', 'user')
                    ->where('cabang_id', $cabang_id)
                    ->get();

        return view('user.listUserCabangVersiManager', [
            'users' => $users
        ]);
    }

    public function cabang_versi_hq(Request $request)
    {
        $cabang = Cabang::all();
        $user = Auth::user();

        if ($request->filled('cabang_id')) {
            $cabangId = $request->cabang_id;
            $users = User::where('status', 'user')
                         ->where('cabang_id', $cabangId)
                         ->get();
        } else {
            $users = User::where('status', 'user')
                         ->where('cabang_id', $user->cabang_id)
                         ->get();
        }

        return view('user.listUserCabangVersiHq', [
            'users' => $users,
            'cabang' => $cabang
        ]);
    }


    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', ['user' => $user]);
    }
}
