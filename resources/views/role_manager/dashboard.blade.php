@extends('adminlte.template')

@section('content')
<style>
    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-5px) rotate(-10deg); }
        50% { transform: translateX(5px) rotate(10deg); }
        75% { transform: translateX(-5px) rotate(-10deg); }
        100% { transform: translateX(0); }
    }

    .animated {
        animation: shake 1s infinite;
    }
</style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h3>
                        <i class="fas fa-hand-paper animated"></i> Selamat datang, {{ auth()->user()->name }} <i class="fas fa-hand-paper animated"></i>
                    </h3>
                </div>
            </div>
        </div>
    </div>



@endsection
