@extends('adminlte.template')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-md-6 mt-3">
                    <form action="" method="get">
                        <div class="input">
                            <div class="input-group mb-3">
                                <input type="text" id="keyword_search" name="keyword_search" class="form-control"
                                    placeholder="Search" value="{{ request('keyword_search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @foreach ($barangs as $barang)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <strong class="card-title"><b>{{ $barang->nama }} / {{ $barang->kode }}</b></strong>
                                <p class="badge badge-info text-white ml-auto">{{ $barang->jumlah }} {{ $barang->satuan }}</p>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <div style="min-height: 100px">
                                        @if ($barang->gambar)
                                            <img class="mx-auto d-block" src="{{ asset('storage/' . $barang->gambar) }}"
                                                alt="" width="90px">
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="location text-sm-left">
                                        <u>Kondisi </u>{{ $barang->kondisi }} <br>
                                        <u>Brand </u>{{ $barang->brand }} <br>
                                        <u>Harga Beli </u>Rp. {{ number_format($barang->nilai_harga, 0, ',', '.') }}
                                    </div>
                                </div>
                                <hr>
                                <div class="card-text text-sm-center text-center">
                                    {{-- @if ($barang->status_peminjaman === 'PROSES')
                                    <button type="button" class="btn btn-primary btn-block btn-peminjaman"
                                        data-toggle="modal" data-target="#peminjamanModal" data-nama="{{ $barang->nama }}"
                                        data-barang-id="{{ $barang->id }}">Pinjam</button>
                                    @endif --}}
                                    @if ($barang->status_peminjaman === 'PROSES')
                                        <span class="badge badge-warning">PROSES</span>
                                    @elseif ($barang->status_peminjaman === 'DITERIMA')
                                        <span class="badge badge-success">SEDANG DIPINJAM</span>

                                    @else
                                        <button type="button" class="btn btn-primary btn-block btn-peminjaman"
                                            data-toggle="modal" data-target="#peminjamanModal"
                                            data-nama="{{ $barang->nama }}"
                                            data-barang-id="{{ $barang->id }}">Pinjam</button>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $barangs->links() }}
                    </ul>
                </nav>
            </div>

            <!-- Center modal tambah peminjaman -->
            <div class="modal fade modal" id="peminjamanModal" tabindex="-1" aria-labelledby="peminjamanModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header text-center align-items-center">
                            <img src="{{ asset('adminlte/dist/img/logo-jnt.png') }}" alt="" width="70px">
                            <h5 class="modal-title" id="peminjamanModalLabel">Form Peminjaman</h5>
                        </div>

                        <div class="modal-body">
                            <form action="{{ route('peminjaman.store') }}" method="post" id="form-peminjaman">
                                @csrf
                                <input type="hidden" name="barang_id" id="barang_id" value="">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="nama"><b>Nama Aset</b></label>
                                            <input type="text" class="form-control" id="nama"
                                                placeholder="Nama Aset" name="nama" readonly required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 mt-2">
                                            <label for="tanggal_pinjam"><b>Tanggal Peminjaman</b></label>
                                            <input type="date" class="form-control" id="tanggal_pinjam"
                                                placeholder="Tanggal Pinjam" name="tanggal_pinjam" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 mt-2">
                                            <label for="tanggal_kembali"><b>Tanggal Pengembalian</b></label>
                                            <input type="date" class="form-control" id="tanggal_kembali"
                                                placeholder="Tanggal Pengembalian" name="tanggal_kembali" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 mt-2">
                                            <label for="jumlah_request"><b>Jumlah</b></label>
                                            <input type="number" class="form-control" id="jumlah_request"
                                                placeholder="Jumlah Request" name="jumlah_request" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12 mt-2">
                                            <label for="keperluan"><b>Keperluan</b></label>
                                            <textarea name="keperluan" id="keperluan" cols="30" rows="5" class="form-control"
                                                placeholder="Keperluan" name="keperluan" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0 d-flex mt-2">
                                    <button type="submit" class="btn btn-primary">Pinjam Aset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $('#peminjamanModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var nama = button.data('nama');
                var barang_id = button.data('barang-id');
                var modal = $(this);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #barang_id').val(barang_id);
            });
        </script>
    </div>

    @include('sweetalert::alert')
@endsection
