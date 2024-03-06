@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0">Approval Manager</h1>
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
                                        <th>Cabang</th>
                                        <th>Nama Aset</th>
                                        <th>Kode Aset</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status Manager</th>
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
                                            <td>{{ $item->user->cabang->nama }}</td>
                                            <td>{{ $item->barang->nama }}</td>
                                            <td>{{ $item->barang->kode }}</td>
                                            <td>{{ $item->tanggal_pinjam }}</td>
                                            <td>{{ $item->tanggal_kembali }}</td>
                                            <td>
                                                <form action="{{ route('update_status_manager', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <span class="">
                                                        <select name="status_manager" onchange="this.form.submit()">
                                                            <option value="PROSES" {{ $item->status_manager == 'PROSES' ? 'selected' : '' }}>PROSES</option>
                                                            <option value="DITERIMA" {{ $item->status_manager == 'DITERIMA' ? 'selected' : '' }}>DITERIMA</option>
                                                            <option value="DITOLAK" {{ $item->status_manager == 'DITOLAK' ? 'selected' : '' }}>DITOLAK</option>
                                                            <option value="DIAMBIL" {{ $item->status_manager == 'DIAMBIL' ? 'selected' : '' }}>DIAMBIL</option>
                                                            <option value="SELESAI" {{ $item->status_manager == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                                                        </select>
                                                    </span>
                                                </form>
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
