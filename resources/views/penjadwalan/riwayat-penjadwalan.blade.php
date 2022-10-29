@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Riwayat Jadwal | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Jadwal
@endsection

@section('content')

<ol class="breadcrumb col-lg-12">   
  <li class="breadcrumb-item"><a href="/form">Hari Ini</a></li>  
  <li class="breadcrumb-item"><a href="#">Bulan Ini</a></li>    
  <li class="breadcrumb-item"><a href="/riwayat-penjadwalan">Riwayat Penjadwalan</a></li>  
</ol>

<table class="table table-bordered table-striped" id="datatables">
  <thead class="table-dark">
    <tr>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Seminar</th>
      <th scope="col">Prodi</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Waktu</th>
      <th scope="col">Lokasi</th>              
      <th scope="col">Pembimbing</th>
      <th scope="col">Penguji</th>
      @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)         
      <th scope="col">Aksi</th>
      @endif
    </tr>
  </thead>
  <tbody>

    @foreach ($penjadwalan_kps as $kp)
        <tr>
          <td>{{$kp->mahasiswa->nim}}</td>                             
          <td>{{$kp->mahasiswa->nama}}</td>                     
          <td class="bg-primary">{{$kp->jenis_seminar}}</td>                     
          <td>{{$kp->prodi->nama_prodi}}</td>          
          <td>{{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td>{{$kp->waktu}}</td>                   
          <td>{{$kp->lokasi}}</td>                   
          <td>
            <p>{{$kp->pembimbing->nama}}</p>            
          </td> 
          <td>
            <p>{{$kp->penguji->nama}}</p>            
          </td>
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)      
          <td>                        
            <a href="/perbaikan-pengujikp/{{$kp->id}}/{{$kp->penguji->nip}}" class="badge bg-info p-2"style="border-radius:20px;">Perbaikan Penguji</a>           
            <a href="/nilai-kp/{{$kp->id}}" class="badge bg-success mt-2 p-2"style="border-radius:20px;">Berita Acara</a>                  
          </td>
          @endif                     
        </tr>
    @endforeach

    @foreach ($penjadwalan_sempros as $sempro)
        <tr>
          <td>{{$sempro->mahasiswa->nim}}</td>
          <td>{{$sempro->mahasiswa->nama}}</td>                     
          <td class="bg-success">{{$sempro->jenis_seminar}}</td>                     
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
            <p>3. {{$sempro->pengujitiga->nama}}</p>
          </td>        
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
          <td>              
            <a href="/nilai-sempro-pembimbing/{{$sempro->id}}/{{ $sempro->pembimbingsatu->nip }}" class="badge bg-warning">Nilai Pembimbing 1</a>
            @if ($sempro->pembimbingdua == !null)
            <a href="/nilai-sempro-pembimbing/{{$sempro->id}}/{{ $sempro->pembimbingdua->nip }}" class="badge bg-danger">Nilai Pembimbing 2</a>                               
            @endif
            <a href="/nilai-sempro-penguji/{{$sempro->id}}/{{ $sempro->pengujisatu->nip }}" class="badge bg-secondary">Nilai Penguji 1</a>          
            <a href="/nilai-sempro-penguji/{{$sempro->id}}/{{ $sempro->pengujidua->nip }}" class="badge bg-dark">Nilai Penguji 2</a>          
            <a href="/nilai-sempro-penguji/{{$sempro->id}}/{{ $sempro->pengujitiga->nip }}" class="badge bg-blue">Nilai Penguji 3</a>
            <a href="/perbaikan-pengujisempro/{{$sempro->id}}/{{$sempro->pengujisatu->nip}}" class="badge bg-secondary">Perbaikan Penguji 1</a>
            <a href="/perbaikan-pengujisempro/{{$sempro->id}}/{{$sempro->pengujidua->nip}}" class="badge bg-dark">Perbaikan Penguji 2</a>
            <a href="/perbaikan-pengujisempro/{{$sempro->id}}/{{$sempro->pengujitiga->nip}}" class="badge bg-blue">Perbaikan Penguji 3</a>         
            <a href="/penilaian-sempro/cek-nilai/{{$sempro->id}}" class="badge bg-success">Berita Acara</a>
            @if ($sempro->revisi_proposal == !null)
            <a href="/penilaian-sempro/riwayat-judul/{{$sempro->id}}" class="badge bg-success">Revisi Judul</a>
            @endif
          </td>                       
          @endif
        </tr>
    @endforeach
    
    @foreach ($penjadwalan_skripsis as $skripsi)
        <tr>
          <td>{{$skripsi->mahasiswa->nim}}</td>                             
          <td>{{$skripsi->mahasiswa->nama}}</td>                     
          <td class="bg-warning">{{$skripsi->jenis_seminar}}</td>                     
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
            <p>3. {{$skripsi->pengujitiga->nama}}</p>
          </td>
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
          <td>              
            <a href="/nilai-skripsi-pembimbing/{{$skripsi->id}}/{{ $skripsi->pembimbingsatu->nip }}" class="badge bg-warning">Nilai Pembimbing 1</a>
            @if ($skripsi->pembimbingdua == !null)
            <a href="/nilai-skripsi-pembimbing/{{$skripsi->id}}/{{ $skripsi->pembimbingdua->nip }}" class="badge bg-danger">Nilai Pembimbing 2</a>                               
            @endif
            <a href="/nilai-skripsi-penguji/{{$skripsi->id}}/{{ $skripsi->pengujisatu->nip }}" class="badge bg-secondary">Nilai Penguji 1</a>          
            <a href="/nilai-skripsi-penguji/{{$skripsi->id}}/{{ $skripsi->pengujidua->nip }}" class="badge bg-dark">Nilai Penguji 2</a>          
            <a href="/nilai-skripsi-penguji/{{$skripsi->id}}/{{ $skripsi->pengujitiga->nip }}" class="badge bg-blue">Nilai Penguji 3</a>
            <a href="/perbaikan-pengujiskripsi/{{$skripsi->id}}/{{$skripsi->pengujisatu->nip}}" class="badge bg-secondary">Perbaikan Penguji 1</a>
            <a href="/perbaikan-pengujiskripsi/{{$skripsi->id}}/{{$skripsi->pengujidua->nip}}" class="badge bg-dark">Perbaikan Penguji 2</a>
            <a href="/perbaikan-pengujiskripsi/{{$skripsi->id}}/{{$skripsi->pengujitiga->nip}}" class="badge bg-blue">Perbaikan Penguji 3</a>         
            <a href="/penilaian-skripsi/cek-nilai/{{$skripsi->id}}" class="badge bg-success">Berita Acara</a>
            @if ($skripsi->revisi_skripsi == !null)
            <a href="/penilaian-skripsi/riwayat-judul/{{$skripsi->id}}" class="badge bg-success">Revisi Judul</a>
            @endif
          </td>                       
          @endif                    
        </tr>
    @endforeach    
  </tbody>
</table>
    
@endsection