@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Penilaian | SIA ELEKTRO
@endsection

@section('sub-title')
    Jadwal Seminar Mahasiswa Bimbingan
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

@if (session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('loginError')}}        
      </div>
@endif

<div class="container card  p-4">

<ol class="breadcrumb col-lg-12">  
  <li><a href="/kp-skripsi/seminar-pembimbing-penguji" class="breadcrumb-item active fw-bold text-success px-1">Seminar (<span id="seminarKPCount"></span>) </a></li> 

        <span class="px-2">|</span>
        <li><a href="/pembimbing/kerja-praktek" class="px-1">Bimbingan KP (<span id="prodiKPCount"></span>)</a></li>
        
        <span class="px-2">|</span>
        <li><a href="/pembimbing/skripsi" class="px-1">Bimbingan Skripsi (<span id=""></span>)</a></li>
        
        <span class="px-2">|</span>

        <li><a href="/riwayat-pembimbing-penguji" class="px-1">Riwayat</a></li>
        (<span id="bimbinganKPCount"></span>)
  
</ol>

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
      <th class="text-center"scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody> 
    

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
            @if ($sempro->penilaian(Auth::user()->nip, $sempro->id) == false)
              @if (Carbon::now() >= $sempro->tanggal && Carbon::now()->format('H:i:m') >= $sempro->waktu)
              <a href="/penilaian-sempro/create/{{Crypt::encryptString($sempro->id)}}" class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>          
              @else
              <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum Dimulai</span>
              @endif
            @else
              <a href="/penilaian-sempro/edit/{{Crypt::encryptString($sempro->id)}}" class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>              
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
            @if ($skripsi->penilaian(Auth::user()->nip, $skripsi->id) == false)
              @if (Carbon::now() >= $skripsi->tanggal && Carbon::now()->format('H:i:m') >= $skripsi->waktu)
              <a href="/penilaian-skripsi/create/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>          
              @else
              <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum Dimulai</span>
              @endif
            @else
              <a href="/penilaian-skripsi/edit/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>              
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

@push('scripts')
<script>
  const swal= $('.swal').data('swal');
  if (swal) {
    Swal.fire({
      title : 'Berhasil',
      text : swal,
      confirmButtonColor: '#28A745',
      icon : 'success'
    })    
  }
</script>
@endpush()