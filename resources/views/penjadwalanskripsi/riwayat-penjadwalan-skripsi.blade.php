@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Riwayat Jadwal Skripsi | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Jadwal Skripsi
@endsection

@section('content')

<ol class="breadcrumb col-lg-12">   
  <li class="breadcrumb-item"><a href="/form-skripsi">Penjadwalan</a></li>  
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/riwayat-penjadwalan-skripsi">Riwayat Penjadwalan</a></li>  
</ol>

<table class="table table-bordered table-striped" id="datatables">
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

    @foreach ($penjadwalan_skripsis as $skripsi)
        <tr>
          <td>{{$skripsi->nim}}</td>                             
          <td>{{$skripsi->nama}}</td>                     
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
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama}}</p>
            @endif
          </td>          
          <td>                        
            <a href="/penilaian-skripsi/cek-nilai/{{$skripsi->id}}" class="badge bg-success">Berita Acara</a>                  
          </td>                        
        </tr>
    @endforeach
    
  </tbody>
</table>
    
@endsection