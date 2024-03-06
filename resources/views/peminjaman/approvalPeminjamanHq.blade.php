@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Approval Peminjaman HQ</h1>
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
                                        <th>Status HQ</th>
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
                                                <span class="badge {{ $item->status_manager == 'DITOLAK' ? 'badge-danger' : ($item->status_manager == 'DITERIMA' ? 'badge-success' : 'badge-secondary') }}">
                                                    {{ $item->status_manager ? $item->status_manager : 'Proses' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($item->status_manager == 'DITERIMA' | $item->status_manager == 'DIAMBIL' | $item->status_manager == 'SELESAI')
                                                    <form action="{{ route('update_status_hq', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <span class="">
                                                            <select name="status_hq" onchange="this.form.submit()">
                                                                <option value="" readonly>Silahkan Pilih</option>
                                                                <option value="DITERIMA" {{ $item->status_hq == 'DITERIMA' ? 'selected' : '' }}>DITERIMA</option>
                                                                <option value="DITOLAK" {{ $item->status_hq == 'DITOLAK' ? 'selected' : '' }}>DITOLAK</option>
                                                                <option value="DIAMBIL" {{ $item->status_hq == 'DIAMBIL' ? 'selected' : '' }}>DIAMBIL</option>
                                                                <option value="SELESAI" {{ $item->status_hq == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                                                            </select>
                                                        </span>
                                                    </form>
                                                    @else
                                                    <span class="badge {{ $item->status_hq == 'DITOLAK' ? 'badge-danger' : ($item->status_hq == 'DITERIMA' ? 'badge-success' : 'badge-secondary') }}">
                                                        {{ $item->status_hq ? $item->status_hq : 'Proses' }}
                                                    </span>
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
