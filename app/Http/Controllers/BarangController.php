<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.listBarang', [
            'barangs' => $barangs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.createBarang');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $gambar = null;
        if ($request->file('gambar')) {
            $gambar = $request->file('gambar')->store('public/gambar_aset');
            $gambar = str_replace('public/', '', $gambar);
        }
        $barang = Barang::where(['kode' => $request->kode])->first();

        if ($barang) {
            Alert::error('Warning', 'Kode sudah terpakai oleh aset' . $barang->nama . '| Silahkan Ganti Kode Anda');
            return redirect()->route('barang');
        }

        Barang::create([
            'kode'                  => $request->kode,
            'nama'                  => $request->nama,
            'jumlah'                => $request->jumlah,
            'satuan'                => $request->satuan,
            'tanggal_pembelian'     => $request->tanggal_pembelian,
            'nilai_harga'           => $request->nilai_harga,
            'brand'                 => $request->brand,
            'kondisi'               => $request->kondisi,
            'gambar'                => ($gambar) ? $gambar : null,
            'detail_tempat'         => $request->detail_tempat,

        ]);
        Alert::success('Success', 'Aset Berhasil Ditambahkan');
        return redirect()->route('barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.editBarang', [
            'barang' => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode'              => 'required',
            'nama'              => 'required',
            'jumlah'            => 'required|integer',
            'satuan'            => 'required',
            'tanggal_pembelian' => 'required|date',
            'nilai_harga'       => 'required|numeric',
            'brand'             => 'required',
            'kondisi'           => 'required',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048',
            'detail_tempat'     => 'required',
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'nilai_harga' => $request->nilai_harga,
            'brand' => $request->brand,
            'kondisi' => $request->kondisi,
            'detail_tempat' => $request->detail_tempat,
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/gambar_aset');
            $gambarPath = str_replace('public/', '', $gambarPath);
            $barang->gambar = $gambarPath;
            $barang->save();
        }

        return redirect()->route('barang')->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar) {
            Storage::delete('public/' . $barang->gambar);
        }
        $barang->delete();

        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus');
    }

    public function list(Request $request)
    {
        $keyword_search = $request->input('keyword_search');
        $id_user = auth()->user()->id;

        $barangs = Barang::select(
            'barangs.*',
            DB::raw("(SELECT
                CASE
                    WHEN MIN(peminjaman.status_hq) = 'DITERIMA' THEN 'DITERIMA'
                    WHEN MIN(peminjaman.status_hq) = 'PROSES' THEN 'PROSES'
                    ELSE 'SELESAI'
            END
            FROM peminjaman
            WHERE peminjaman.barang_id = barangs.id
            AND peminjaman.user_id = {$id_user}) as status_peminjaman")
        )
            ->where(function ($query) use ($keyword_search) {
                $query->where('barangs.nama', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.kode', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.jumlah', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.kondisi', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.brand', 'like', '%' . strtolower($keyword_search) . '%');
            })
            ->paginate(10);

        return view('barang.listBarangManagerHq', ['barangs' => $barangs, 'keyword_search' => $keyword_search]);
    }
}
