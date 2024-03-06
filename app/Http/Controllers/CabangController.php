<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabang = Cabang::all();
        return view('cabang.listCabang', [
            'cabang' => $cabang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cabang.createCabang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
        ]);

        Cabang::create([
            'nama'          => $request->nama,
            'created_at'    => now(),
        ]);

        return redirect()->route('cabang.list')->with('success', 'Cabang berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cabang = Cabang::findOrFail($id);
        return view('cabang.editCabang', [
            'cabang' => $cabang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'      => 'required',
        ]);

        $cabang = Cabang::findOrFail($id);
        $cabang->nama = $request->nama;

        $cabang->save();

        return redirect()->route('cabang.list')->with('success', 'Cabang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cabang = Cabang::findOrFail($id);
        $cabang->delete();
        return redirect()->back()->with('success', 'Cabang berhasil dihapus.');
    }
}
