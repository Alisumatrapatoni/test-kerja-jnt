@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Cabang</h1>
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
                            <h3 class="card-title">Form Tambah Cabang</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cabang.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Cabang</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
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
