@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Barang</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Barang</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode" value="{{ $barang->kode }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $barang->jumlah }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $barang->satuan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                                    <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="{{ $barang->tanggal_pembelian }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai_harga" class="form-label">Nilai Harga</label>
                                    <input type="number" class="form-control" id="nilai_harga" name="nilai_harga" value="{{ $barang->nilai_harga }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" class="form-control" id="brand" name="brand" value="{{ $barang->brand }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kondisi" class="form-label">Kondisi</label>
                                    <select class="form-control" id="kondisi" name="kondisi" required>
                                        <option value="Baik" {{ $barang->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Rusak Ringan" {{ $barang->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                        <option value="Rusak Berat" {{ $barang->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>
                                        <b>Gambar</b>
                                    </label>
                                    <div>
                                        @if ($barang->gambar)
                                            <img class="img-thumbnail"
                                                src="{{ asset('storage/' . $barang->gambar) }}"
                                                alt="" width="100px">
                                            <input class="form-control mt-1"
                                                type="file" id="gambar"
                                                name="gambar">
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="detail_tempat" class="form-label">Detail Tempat</label>
                                    <textarea class="form-control" id="detail_tempat" name="detail_tempat" rows="3" required>{{ $barang->detail_tempat }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
