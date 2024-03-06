@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Barang</h1>
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
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Kondisi</th>
                                        <th>brand</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($barangs as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jumlah }} {{ $item->satuan }}</td>
                                        <td>{{ $item->kondisi }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>
                                            <a class="btn btn-primary text-white shadow btn-xs sharp me-1"
                                                title="Edit" href="{{ route('barang.edit', ['id' => $item->id]) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a onclick="return confirm('Apakah Anda yakin ingin menghapus Aset ini?')"
                                                href="{{ route('barang.destroy', ['id' => $item->id]) }}"
                                                class="btn btn-danger text-white shadow btn-xs sharp me-1">
                                                <i class="fa fa-trash"></i>
                                            </a>
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
