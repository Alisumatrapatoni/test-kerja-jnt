@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Peminjaman</h1>
                </div>

            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peminjam</th>
                                        <th>Nama Aset</th>
                                        <th>Kode Aset</th>
                                        <th>Jumlah Dipinjam</th>
                                        <th>Konfirmasi Pengambilan</th>

                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($peminjaman as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->barang->nama }}</td>
                                            <td>{{ $item->barang->kode }}</td>
                                            <td>{{ $item->jumlah_request }}</td>
                                            <td>
                                                @if ($item->status_hq == 'DITERIMA' || $item->status_hq == 'DIAMBIL')
                                                    <form action="{{ route('update_status.konfirmasi_ambil', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <span class="">
                                                            <select name="status" onchange="this.form.submit()">
                                                                <option value="DITERIMA"
                                                                    {{ $item->status_hq == 'DITERIMA' ? 'selected' : '' }}>
                                                                    DITERIMA</option>
                                                                <option value="DIAMBIL"
                                                                    {{ $item->status_hq == 'DIAMBIL' ? 'selected' : '' }}>
                                                                    DIAMBIL</option>
                                                            </select>
                                                        </span>
                                                    </form>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach
                                <tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
