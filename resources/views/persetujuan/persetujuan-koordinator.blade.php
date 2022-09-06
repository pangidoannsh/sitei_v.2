@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Persetujuan Berita Acara | SIA ELEKTRO
@endsection

@section('sub-title')
    Persetujuan Berita Acara
@endsection

@section('content')

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
            <a href="/nilai-kp/{{$kp->id}}" class="badge bg-success">Berita Acara</a>                  
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
          <td>                        
            <a href="/penilaian-sempro/cek-nilai/{{$sempro->id}}" class="badge bg-success">Berita Acara</a>                  
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
          <td>                        
            <a href="/penilaian-skripsi/cek-nilai/{{$skripsi->id}}" class="badge bg-success">Berita Acara</a>                  
          </td>                        
        </tr>
    @endforeach
  </tbody>
</table>
    
@endsection