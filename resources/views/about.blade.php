@extends('layouts.app')
@section('title','About')
@section('content')
{{-- card --}}
<div class="col-lg-12">
    <div class="card shadow-sm mb-4">
        <br>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <br>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h1>Aplikasi ini Dibuat Oleh:</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="card shadow-sm mb-4">
                        
                        <div class="card-body">
                            {{-- foto --}}
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-body">
                                            <img src="{{asset('img/2141764161.png')}}" class="img-fluid" alt="Responsive image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4">
                                    <h3>Nama : Bayu Prasetyo</h3>
                                    <h3>NIM : 2141764161</h3>
                                    <h3>Tanggal : 29 September 2022</h3>
                                </div>
                            </div>
                            {{-- end foto --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
