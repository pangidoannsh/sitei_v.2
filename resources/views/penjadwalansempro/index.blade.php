@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Jadwal Sempro
@endsection

@section('sub-title')
    Jadwal Sempro
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<a href="{{url('/form-sempro/create')}}" class="btn btn-success mb-3">+ Jadwal Sempro</a>

<ol class="breadcrumb col-lg-12">   
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/form-sempro">Penjadwalan</a></li>  
  <li class="breadcrumb-item"><a href="/riwayat-penjadwalan-sempro">Riwayat Penjadwalan</a></li>  
</ol>

<table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
  <thead class="table-dark">
    <tr>
      <th class="text-center" scope="col">#</th>
      <th class="text-center" scope="col">NIM</th>
      <th class="text-center" scope="col">Nama</th>
      <th class="text-center" scope="col">Prodi</th>
      <th class="text-center" scope="col">Tanggal</th>
      <th class="text-center" scope="col">Waktu</th>
      <th class="text-center" scope="col">Lokasi</th>              
      <th class="text-center" scope="col">Pembimbing</th>
      <th class="text-center" scope="col">Penguji</th>          
      <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($penjadwalan_sempros as $sempro)
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$sempro->nim}}</td>                             
          <td>{{$sempro->nama}}</td>                                                                                     
          <td>{{$sempro->prodi->nama_prodi}}</td>          
          <td>{{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}}</td>
          <td>{{$sempro->waktu}}</td>                   
          <td>{{$sempro->lokasi}}</td>                   
          <td>
            <p>1. {{$sempro->pembimbingsatu->nama}}</p>
            @if ($sempro->pembimbingdua == !null)
            <p>2. {{$sempro->pembimbingdua->nama}}</p>                               
            @endif
          </td> 
          <td>
            <p>1. {{$sempro->pengujisatu->nama}}</p>
            <p>2. {{$sempro->pengujidua->nama}}</p>
            @if ($sempro->pengujitiga == !null)
            <p>3. {{$sempro->pengujitiga->nama}}</p>
            @endif
          </td> 
          <td>            
            <a href="/form-sempro/edit/{{$sempro->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>            
          </td>                                
        </tr>
    @endforeach
  </tbody>
</table>
    
@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/fahril-hadi">Fahril Hadi, </a> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span class="text-success fw-bold">&</span> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M. Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
</section>
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