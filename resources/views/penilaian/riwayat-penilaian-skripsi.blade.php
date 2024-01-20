@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Riwayat Penilaian | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Seminar Skripsi
@endsection

@section('content')

<div class="container card  p-4">

<ol class="breadcrumb col-lg-12">
  <li><a href="/kp-skripsi/persetujuan-skripsi" class="px-1">Persetujuan</a></li>
  (<span id="waitingApprovalCount"></span>)
  <span class="px-2">|</span>      
  <li><a href="/kp-skripsi/penilaian-skripsi" class="px-1">Seminar</a></li>
  (<span id="seminarKPCount"></span>)  
  <span class="px-2">|</span>
  <li><a href="/kp-skripsi/riwayat-penilaian-skripsi" class="breadcrumb-item active fw-bold text-black px-1">Riwayat Seminar</a></li>
  (<span id=""></span>)
  <span class="px-2">|</span>

  @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if ( Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )

        <li><a href="/skripsi" class="px-1">Data Skripsi</a></li>
        (<span id="prodiKPCount"></span>)
        <span class="px-2">|</span>
        <li><a href="/skripsi/nilai-keluar" class="px-1">Riwayat Skripsi</a></li>
        (<span id=""></span>)
        <span class="px-2">|</span>

      @endif
  @endif

        <li><a href="/pembimbing/skripsi" class="px-1">Bimbingan Skripsi</a></li>
        (<span id="bimbinganKPCount"></span>)
        <span class="px-2">|</span>
        <li><a href="/skripsi/pembimbing/nilai-keluar" class="px-1">Riwayat Bimbingan Skripsi</a></li>
        (<span id=""></span>)
  
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
      <th class="text-center" scope="col">Aksi</th>
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
            <a formtarget="_blank" target="_blank" href="/nilai-sempro/{{Crypt::encryptString($sempro->id)}}" class="badge bg-success p-2" style="border-radius:20px;">Lihat Nilai</a>

            @if ($sempro->pengujisatu_nip == auth()->user()->nip || $sempro->pengujidua_nip == auth()->user()->nip || $sempro->pengujitiga_nip == auth()->user()->nip)
            <a formtarget="_blank" target="_blank" href="/perbaikan-sempro/{{Crypt::encryptString($sempro->id)}}" class="badge bg-primary p-2 my-1" style="border-radius:20px;">Perbaikan</a>
            @endif

            @if ($sempro->pembimbingsatu_nip == auth()->user()->nip || $sempro->pembimbingdua_nip == auth()->user()->nip)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujisatu->nip}}" class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujidua->nip}}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
            @if ($sempro->pengujitiga == !null)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujisempro/{{Crypt::encryptString($sempro->id)}}/{{$sempro->pengujitiga->nip}}" class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 3</a>
            @endif
            @endif

            @if ($sempro->pengujisatu_nip == auth()->user()->nip)
              <a formtarget="_blank" target="_blank" href="/penilaian-sempro/beritaacara-sempro/{{Crypt::encryptString($sempro->id)}}" class="badge bg-warning p-2" style="border-radius:20px;">Berita Acara</a> 
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
            <a formtarget="_blank" target="_blank" href="/nilai-skripsi/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2" style="border-radius:20px;">Lihat Nilai</a>
            @if ($skripsi->pengujisatu_nip == auth()->user()->nip || $skripsi->pengujidua_nip == auth()->user()->nip || $skripsi->pengujitiga_nip == auth()->user()->nip)
              <a formtarget="_blank" target="_blank" href="/perbaikan-skripsi/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-primary p-2 my-1" style="border-radius:20px;">Perbaikan</a>
            @endif

            @if ($skripsi->pembimbingsatu_nip == auth()->user()->nip || $skripsi->pembimbingdua_nip == auth()->user()->nip)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujisatu->nip}}" class="badge bg-danger p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 1</a>
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujidua->nip}}" class="badge bg-warning p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 2</a>
            @if ($skripsi->pengujitiga == !null)
            <a formtarget="_blank" target="_blank" href="/perbaikan-pengujiskripsi/{{Crypt::encryptString($skripsi->id)}}/{{$skripsi->pengujitiga->nip}}" class="badge bg-success p-2 mt-1" style="border-radius:20px;">Perbaikan Penguji 3</a>
            @endif
            @endif

            @if ($skripsi->pengujisatu_nip == auth()->user()->nip)
              <a formtarget="_blank" target="_blank" href="/penilaian-skripsi/beritaacara-skripsi/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-warning p-2" style="border-radius:20px;">Berita Acara</a> 
            @endif
          </td>                        
        </tr>               
    @endforeach

    @foreach ($penjadwalan_skripsis_draf as $skripsi)    
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
            <a href="/penilaian-skripsi/draft-ba/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2"style="border-radius:20px;">Draft BA</a>
          </td>                        
        </tr>               
    @endforeach

    @foreach ($penjadwalan_skripsis_draff as $skripsi)    
        <tr>                  
          <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
          <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                                     
          <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>          
          <td class="text-center">{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td class="text-center">{{$skripsi->waktu}}</td>                   
          <td class="text-center">{{$skripsi->lokasi}}</td>                
          <td class="text-center">
            <p>{{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>{{$skripsi->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td>         
          <td class="text-center">
            <p>{{$skripsi->pengujisatu->nama_singkat}}</p>
            <p>{{$skripsi->pengujidua->nama_singkat}}</p>
            @if ($skripsi->pengujitiga == !null)
            <p>{{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td>                    
          <td class="text-center">                                    
            <a href="/penilaian-skripsi/draft-ba/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2"style="border-radius:20px;">Draft BA</a>
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