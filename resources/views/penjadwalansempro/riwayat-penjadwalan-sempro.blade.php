@extends('layouts.main')

@section('title')
    Riwayat Jadwal Sempro | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Jadwal Sempro
@endsection

@section('content')

<ol class="breadcrumb col-lg-3">   
  <li class="breadcrumb-item"><a href="/form-sempro">Penjadwalan</a></li>  
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/riwayat-penjadwalan-sempro">Riwayat Penjadwalan</a></li>  
</ol>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Seminar</th>      
      <th scope="col">Jadwal</th>
      <th scope="col">Waktu</th>
      <th scope="col">Lokasi</th>
      <th scope="col">Pembimbing</th>
      <th scope="col">Penguji</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($penjadwalan_sempros as $sempro)
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$sempro->mahasiswa->nim}}</td>
          <td>{{$sempro->mahasiswa->nama}}</td>                   
          <td>{{$sempro->jenis_seminar}}</td>                                                
          <td>{{$sempro->tanggal}}</td>                   
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
  </tbody>
</table>
    
@endsection