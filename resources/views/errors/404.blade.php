@extends('errors.index')

@section('title-error') Not Found | Error 404 @endsection

@section('content-error')    
<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-xl-5 col-12">
            <img src="{{ asset('img/error_img/404.svg') }}" style="width: 100%" alt="">
            <button class="btn btn-secondary" style="width: 100%;" onclick="history.back()">&LeftArrow; Kembali</button>
        </div>
    </div>
</div>
@endsection