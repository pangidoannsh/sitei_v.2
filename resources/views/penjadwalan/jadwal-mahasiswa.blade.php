@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Jadwal Seminar | SIA ELEKTRO
@endsection

@section('sub-title')
    Jadwal Seminar
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif
  <a href="/usulankp/index" class="badge bg-success p-2 mb-3 float-start"> Kembali <a>

<!-- <ol class="breadcrumb col-lg-12">
    <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/jadwal">Jadwal</a></li>    
    <li class="breadcrumb-item"><a href="/seminar">Riwayat</a></li>  
</ol> -->

<div class="container card p-4">
<table class="table table-responsive-lg table-bordered table-striped" width="100%" >
  <thead class="table-dark">
    <tr>      
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <th class="text-center" scope="col">Seminar</th>
        <th class="text-center" scope="col">Prodi</th>
        <th class="text-center" scope="col">Tanggal</th>
        <th class="text-center" scope="col">Waktu</th>
        <th class="text-center" scope="col">Lokasi</th>              
        <th class="text-center" scope="col">Pembimbing</th>
        <th class="text-center" scope="col">Penguji</th>        
    </tr>
  </thead>
  <tbody>

    @foreach ($penjadwalan_kps as $kp)
        <tr>                  
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>                    
            <td class="bg-primary text-center">{{$kp->jenis_seminar}}</td>                     
            <td class="text-center">{{$kp->prodi->nama_prodi}}</td>          
            <td class="text-center">{{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}</td>                   
            <td class="text-center">{{$kp->waktu}}</td>                   
            <td class="text-center">{{$kp->lokasi}}</td>                   
            <td class="text-center">{{$kp->pembimbing->nama_singkat}}</td>
            <td class="text-center">{{$kp->penguji->nama_singkat}}</td>          
        </tr>
    @endforeach

    @foreach ($penjadwalan_sempros as $sempro)
        <tr>                 
            <td class="text-center">{{$sempro->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$sempro->mahasiswa->nama}}</td>                     
            <td class="bg-success text-center">{{$sempro->jenis_seminar}}</td>                     
            <td class="text-center">{{$sempro->prodi->nama_prodi}}</td>          
            <td class="text-center">{{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}}</td>                   
            <td class="text-center">{{$sempro->waktu}}</td>                   
            <td class="text-center">{{$sempro->lokasi}}</td>                   
          <td class="text-center">
            <p>1. {{$sempro->pembimbingsatu->nama_singkat}}</p>
            @if ($sempro->pembimbingdua == !null)
            <p>2. {{$sempro->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td> 
          <td class="text-center">
            <p>1. {{$sempro->pengujisatu->nama_singkat}}</p>
            <p>2. {{$sempro->pengujidua->nama_singkat}}</p>
            @if ($sempro->pengujitiga == !null)
            <p>3. {{$sempro->pengujitiga->nama_singkat}}</p>
            @endif
          </td>                                          
        </tr>
    @endforeach

    @foreach ($penjadwalan_skripsis as $skripsi)
        <tr>                   
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
            <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                                     
            <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>          
            <td class="text-center">{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
            <td class="text-center">{{$skripsi->waktu}}</td>                                                  
            <td class="text-center">{{$skripsi->lokasi}}</td>                    
          <td class="text-center">
            <p>1. {{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>2. {{$skripsi->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td> 
          <td class="text-center">
            <p>1. {{$skripsi->pengujisatu->nama_singkat}}</p>
            <p>2. {{$skripsi->pengujidua->nama_singkat}}</p>
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td>              
        </tr>
    @endforeach

  </tbody>
</table>
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