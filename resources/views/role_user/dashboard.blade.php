@extends('adminlte.template')

@section('content')
    <div class="content-header">
        @if (session('success'))
        <div class="alert alert-primary">
            <button class="btn btn-sm btn-link text-white" type="button" data-toggle="collapse" data-target="#alertContent"
                aria-expanded="false" aria-controls="alertContent">
                <i class="fas fa-bell" style="color: white;"></i> Notification
            </button>
            <div class="collapse" id="alertContent">
                <div class="card card-body text-dark">
                    {!! session('success') !!}
                </div>
            </div>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info">
            <button class="btn btn-sm btn-link text-white" type="button" data-toggle="collapse" data-target="#alertContent"
                aria-expanded="false" aria-controls="alertContent">
                <i class="fas fa-bell" style="color: white;"></i> Notification
            </button>
            <div class="collapse" id="alertContent">
                <div class="card card-body text-dark">
                    {!! session('info') !!}
                </div>
            </div>
        </div>
    @endif


        <div class="container-fluid">
            <div class="row mb-2">
                <img src="https://www.kargomurah.co.id/wp-content/uploads/2019/09/unnamed.jpg" alt=""
                    style="width: 100%; max-width: 800px; height: auto; display: block; margin: 0 auto;">
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
            </div>
        </div>
    </div>
@endsection
