@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Riwayat Penilaian | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Penilaian
@endsection

@section('content')

<ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a href="/penilaian">Hari Ini</a></li>
  <li class="breadcrumb-item"><a href="#">Bulan Ini</a></li>  
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/riwayat-penilaian">Riwayat Penilaian</a></li>  
</ol>

<table class="table text-center table-bordered table-striped" id="datatables">
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
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>    

    @foreach ($penjadwalan_kps as $kp)    
        <tr>
          <td>{{$kp->nim}}</td>                             
          <td>{{$kp->nama}}</td>                     
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
          <td>                        
              <a href="/perbaikan-kp/{{$kp->id}}" class="badge bg-info p-2"style="border-radius:20px;">Perbaikan</a>            
              <a href="/nilai-kp/{{$kp->id}}" class="badge bg-success mt-2 p-2"style="border-radius:20px;">Berita Acara</a>
          </td>                        
        </tr>               
    @endforeach

    @foreach ($penjadwalan_sempros as $sempro)
        <tr>
          <td>{{$sempro->nim}}</td>                             
          <td>{{$sempro->nama}}</td>                     
          <td class="bg-success">{{$sempro->jenis_seminar}}</td>                                       
          <td>{{$sempro->prodi->nama_prodi}}</td>          
          <td>{{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td>{{$sempro->waktu}}</td>                   
          <td>{{$sempro->lokasi}}</td>              
          <td>
            <p>{{$sempro->pembimbingsatu->nama}}</p>
            @if ($sempro->pembimbingdua == !null)
            <p>{{$sempro->pembimbingdua->nama}}</p>                               
            @endif
          </td>         
          <td>
            <p>{{$sempro->pengujisatu->nama}}</p>
            <p>{{$sempro->pengujidua->nama}}</p>
            <p>{{$sempro->pengujitiga->nama}}</p>
          </td>                    
          <td>            
            <a href="/nilai-sempro/{{$sempro->id}}" class="badge bg-success">Lihat Nilai</a>
            @if ($sempro->pengujisatu_nip == auth()->user()->nip || $sempro->pengujidua_nip == auth()->user()->nip || $sempro->pengujitiga_nip == auth()->user()->nip)
              <a href="/perbaikan-sempro/{{$sempro->id}}" class="badge bg-primary">Perbaikan</a>
            @endif
            @if ($sempro->pengujisatu_nip == auth()->user()->nip)
              <a href="/penilaian-sempro/cek-nilai/{{$sempro->id}}" class="badge bg-primary">Berita Acara</a> 
            @endif
          </td>                        
        </tr>               
    @endforeach

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