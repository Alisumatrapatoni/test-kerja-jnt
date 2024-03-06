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
                                <p class="badge badge-dark text-white ml-auto"> Stok {{ $barang->jumlah }}</p>
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



        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $('#peminjamanModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var nama = button.data('nama');
                var barang_id = button.data('barang-id'); // Ambil nilai barang_id dari data-barang-id
                var modal = $(this);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #barang_id').val(barang_id); // Tetapkan nilai barang_id ke input tersembunyi
            });
        </script>
    </div>

    @include('sweetalert::alert')
@endsection
