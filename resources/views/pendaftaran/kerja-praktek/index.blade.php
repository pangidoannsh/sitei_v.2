@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Kerja Praktek
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif



<div class="container">

@if (Str::length(Auth::guard('mahasiswa')->user()) > 0)


<div class="container">

<div class="card">
  <h5 class="card-header text-bold">Usulan Kerja Praktek</h5>
  <!-- <img height="15" width="100%" src="/assets/img/h1.jpg" class="card-img-top bg-blur" alt="..."> -->
  <div class="card-body">
    <!-- <h5 class="card-title">Special title treatment</h5> -->
    <p class="card-text">Silahkan usulkan Kerja Praktek.</p>
    <a href="{{url ('/usulankp/create')}}" class="btn mahasiswa btn-success">Usulkan KP</a>
  </div>
</div>


</div>
@endif


</div>

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