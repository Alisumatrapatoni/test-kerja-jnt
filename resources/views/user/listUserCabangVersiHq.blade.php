@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List User Cabang</h1>
                </div>
            </div>

            <form action="{{ route('cabang.versi_hq') }}" method="GET">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <select class="form-control" id="cabang_id" name="cabang_id">
                            <option value="">-- Pilih Cabang --</option>
                            @foreach ($cabang as $cabangItem)
                                <option value="{{ $cabangItem->id }}">{{ $cabangItem->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('cabang.versi_hq') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
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
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Cabang</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><span class="badge badge-primary">{{ $item->status }}</span></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->cabang->nama }}</td>
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
