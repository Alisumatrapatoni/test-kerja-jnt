@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Barang</h1>
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
                            <h3 class="card-title">Form Tambah Barang</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="kode" name="kode" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                </div>
                                <div class="mb-3">
                                    <label for="satuan" class="form-label">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                                    <input type="date" class="form-control" id="tanggal_pembelian"
                                        name="tanggal_pembelian" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai_harga" class="form-label">Nilai Harga</label>
                                    <input type="number" class="form-control" id="nilai_harga" name="nilai_harga" required>
                                </div>
                                <div class="mb-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" class="form-control" id="brand" name="brand" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kondisi" class="form-label">Kondisi</label>
                                    <select class="form-control" id="kondisi" name="kondisi" required>
                                        <option value="Baik">Baik</option>
                                        <option value="Rusak Ringan">Rusak Ringan</option>
                                        <option value="Rusak Berat">Rusak Berat</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*" required>
                                </div>
                                <div class="mb-3">
                                    <label for="detail_tempat" class="form-label">Detail Tempat</label>
                                    <textarea class="form-control" id="detail_tempat" name="detail_tempat" rows="3" required></textarea>
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
