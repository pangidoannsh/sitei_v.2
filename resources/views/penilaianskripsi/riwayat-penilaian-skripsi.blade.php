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
      <th scope="col">#</th>
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
            <p>{{$skripsi->pembimbingsatu->nama}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>{{$skripsi->pembimbingdua->nama}}</p>                               
            @endif
          </td>         
          <td>
            <p>{{$skripsi->pengujisatu->nama}}</p>
            <p>{{$skripsi->pengujidua->nama}}</p>
            <p>{{$skripsi->pengujitiga->nama}}</p>
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