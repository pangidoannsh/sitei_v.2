@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Pendaftaran | SIA ELEKTRO
@endsection

@section('sub-title')
   Pendaftaran
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif



@foreach ($pendaftaran_kp as $kp)

<div class="container">
  <div class="row daftar">
  <div class="d-grid col-5 mx-auto">
  @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  <a class="btn btn-success daftarkp" href="/pendaftaran-kp/{{$kp->id}}" role="button">KERJA PRAKTEK</a>
  @endif
  @endif
  <a class="btn btn-success daftarkp" href="/pendaftaran-kp/{{$kp->id}}" role="button">KERJA PRAKTEK</a>
</div>
<div class="d-grid col-5 mx-auto">
<a class="btn btn-warning daftarskripsi" href="#" role="button">SKRIPSI</a>
  </div>
</div>
</div>


@endforeach

@endsection

@push('scripts')
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
@endpush()