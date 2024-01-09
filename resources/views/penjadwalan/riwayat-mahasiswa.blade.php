@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Seminar Mahasiswa
@endsection

@section('sub-title')
    Riwayat Seminar Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<!-- <ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a class="breadcrumb-item" href="/jadwal">Jadwal</a></li>    
  <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/seminar">Riwayat</a></li>  
</ol> -->

<div class="container card p-4">
<table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
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
      <th class="text-center" scope="col">Aksi</th>
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
          <td class="text-center">
            <p>{{$kp->pembimbing->nama_singkat}}</p>            
          </td> 
          <td class="text-center">
            <p>{{$kp->penguji->nama_singkat}}</p>            
          </td>               
          <td class="text-center">                        
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujikp/{{Crypt::encryptString($kp->id)}}/{{$kp->penguji->nip}}" class="badge bg-info p-2"style="border-radius:20px;">Perbaikan Penguji</a>      
          </td>        
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
        <td class="text-center">        
          <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujisatu->nip}}" class="badge bg-danger p-2"style="border-radius:20px;">Perbaikan Penguji 1</a>
          <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujidua->nip}}" class="badge bg-warning mt-1 p-2"style="border-radius:20px;">Perbaikan Penguji 2</a>
          @if ($sempro->pengujitiga == !null)
          <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujitiga->nip}}" class="badge bg-success mt-1 p-2"style="border-radius:20px;">Perbaikan Penguji 3</a>              
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
        <td class="text-center">        
          <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujisatu->nip}}" class="badge bg-danger p-2"style="border-radius:20px;">Perbaikan Penguji 1</a>
          <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujidua->nip}}" class="badge bg-warning mt-1 p-2"style="border-radius:20px;">Perbaikan Penguji 2</a>
          <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujitiga->nip}}" class="badge bg-success mt-1 p-2"style="border-radius:20px;">Perbaikan Penguji 3</a>  
        </td>                       
      </tr>
    @endforeach

  </tbody>
</table>
</div>
    
@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank" href="https://fahrilhadi.com">Fahril Hadi, </a> 
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