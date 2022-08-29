@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Jadwal KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Jadwal KP
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<a href="{{url ('/form-kp/create')}}" class="btn btn-success mb-3">+ Jadwal KP</a>

<ol class="breadcrumb col-lg-12">   
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/form-kp">Penjadwalan</a></li>  
  <li class="breadcrumb-item"><a href="/riwayat-penjadwalan-kp">Riwayat Penjadwalan</a></li>  
</ol>

<table class="table table-bordered table-striped" id="datatables">
  <thead class="table-dark">
    <tr>      
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Prodi</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Waktu</th>
      <th scope="col">Lokasi</th>              
      <th scope="col">Pembimbing</th>
      <th scope="col">Penguji</th>          
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($penjadwalan_kps as $kp)
        <tr>                  
          <td>{{$kp->nim}}</td>                             
          <td>{{$kp->nama}}</td>                                                                                     
          <td>{{$kp->prodi->nama_prodi}}</td>          
          <td>{{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}</td>
          <td>{{$kp->waktu}}</td>                   
          <td>{{$kp->lokasi}}</td>                    
          <td>{{$kp->pembimbing->nama}}</td>
          <td>{{$kp->penguji->nama}}</td>                    
          <td>
            <a href="/form-kp/edit/{{$kp->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
          </td>
        </tr>
    @endforeach
  </tbody>
</table>
    
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