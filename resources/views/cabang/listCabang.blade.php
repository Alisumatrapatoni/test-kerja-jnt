@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Cabang</h1>
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
                                        <th>Nama Cabang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($cabang as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><span class="badge badge-primary">{{ $item->status }}</span></td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            <a class="btn btn-primary text-white shadow btn-xs sharp me-1"
                                                title="Edit" href="{{ route('cabang.edit', ['id' => $item->id]) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a onclick="return confirm('Apakah Anda yakin ingin menghapus cabang ini?')"
                                                href="{{ route('cabang.destroy', ['id' => $item->id]) }}"
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
