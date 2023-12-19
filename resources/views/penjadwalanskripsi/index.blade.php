@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Jadwal Sidang Skripsi
@endsection

@section('sub-title')
    Jadwal Sidang Skripsi
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<a href="{{url('/form-skripsi/create')}}" class="btn btn-success mb-3">+ Jadwal Skripsi</a>

<ol class="breadcrumb col-lg-12">   
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/form-skripsi">Penjadwalan</a></li>  
  <li class="breadcrumb-item"><a href="/riwayat-penjadwalan-skripsi">Riwayat Penjadwalan</a></li>  
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
    @foreach ($penjadwalan_skripsis as $skripsi)
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$skripsi->nim}}</td>                             
          <td>{{$skripsi->nama}}</td>                                                                                     
          <td>{{$skripsi->prodi->nama_prodi}}</td>          
          <td>{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>
          <td>{{$skripsi->waktu}}</td>                   
          <td>{{$skripsi->lokasi}}</td>                    
          <td>
            <p>1. {{$skripsi->pembimbingsatu->nama}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>2. {{$skripsi->pembimbingdua->nama}}</p>                               
            @endif
          </td> 
          <td>
            <p>1. {{$skripsi->pengujisatu->nama}}</p>
            <p>2. {{$skripsi->pengujidua->nama}}</p>
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama}}</p>
            @endif
          </td> 
          <td>            
            <a href="/form-skripsi/edit/{{$skripsi->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>            
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