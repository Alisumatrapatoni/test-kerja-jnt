@extends('adminlte.template')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit User</h1>
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
                            <h3 class="card-title">Form Edit User</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="manager" {{ $user->status == 'manager' ? 'selected' : '' }}>Manager</option>
                                        <option value="hq" {{ $user->status == 'hq' ? 'selected' : '' }}>HQ</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="cabang_id" class="form-label">Cabang</label>
                                    <select class="form-control" id="cabang_id" name="cabang_id" required>
                                        @foreach($cabang as $cabangItem)
                                            <option value="{{ $cabangItem->id }}" {{ $user->cabang_id == $cabangItem->id ? 'selected' : '' }}>{{ $cabangItem->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
