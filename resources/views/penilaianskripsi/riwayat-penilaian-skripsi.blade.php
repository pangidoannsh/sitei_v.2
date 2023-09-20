@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Riwayat Penilaian Skripsi | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Penilaian Sidang Skripsi
@endsection

@section('content')

<ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a href="/penilaian-skripsi">Hari Ini</a></li>
  <li class="breadcrumb-item"><a href="#">Bulan Ini</a></li>  
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="riwayat-penilaian-skripsi">Riwayat Penilaian</a></li>  
</ol>

<table class="table text-center table-bordered table-striped" id="datatables">
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
            <a href="/nilai-skripsi/{{$skripsi->id}}" class="badge bg-success">Lihat Nilai</a>
            @if ($skripsi->pengujisatu_nip == auth()->user()->nip || $skripsi->pengujidua_nip == auth()->user()->nip || $skripsi->pengujitiga_nip == auth()->user()->nip)
              <a href="/perbaikan-skripsi/{{$skripsi->id}}" class="badge bg-primary">Perbaikan</a>
            @endif
            @if ($skripsi->pengujisatu_nip == auth()->user()->nip)
              <a href="/penilaian-skripsi/cek-nilai/{{$skripsi->id}}" class="badge bg-primary">Berita Acara</a> 
            @endif
          </td>                        
        </tr>               
    @endforeach
  </tbody>
</table>
@endsection