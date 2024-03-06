@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">History Peminjaman</h1>
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
                                        <th>Status Manager</th>
                                        <th>Status HQ</th>
                                        <th>Nama Aset</th>
                                        <th>Kode Aset</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Jumlah Request</th>
                                        <th>Bukti Pinjam</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($riwayat_peminjaman as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                <span class="badge {{ $item->status_manager == 'DITOLAK' ? 'badge-danger' : ($item->status_manager == 'DITERIMA' ? 'badge-success' : 'badge-warning') }}">
                                                    {{ $item->status_manager ? $item->status_manager : 'PROSES' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $item->status_hq == 'DITOLAK' ? 'badge-danger' : ($item->status_hq == 'DITERIMA' ? 'badge-success' : 'badge-warning') }}">
                                                    {{ $item->status_hq ? $item->status_hq : 'PROSES' }}
                                                </span>
                                            </td>

                                            <td>{{ $item->barang->nama }}</td>
                                            <td>{{ $item->barang->kode }}</td>
                                            <td>{{ $item->tanggal_pinjam }}</td>
                                            <td>{{ $item->tanggal_kembali }}</td>
                                            <td>{{ $item->jumlah_request }}</td>
                                            <td>
                                                @if ($item->status_manager == 'DITERIMA' && $item->status_hq == 'DITERIMA')
                                                    <form action="{{ route('cetak.pdf', $item->id) }}" method="GET" target="_blank">
                                                        <button type="submit" class="btn btn-danger btn-sm"> <i class="fas fa-file-pdf"></i> Cetak</button>
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

    @include('sweetalert::alert')
@endsection
