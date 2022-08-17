@extends('layouts.main')

@section('title')
    Riwayat Jadwal Skripsi | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Jadwal Skripsi
@endsection

@section('content')

<ol class="breadcrumb col-lg-3">   
  <li class="breadcrumb-item"><a href="/form-skripsi">Penjadwalan</a></li>  
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/riwayat-penjadwalan-skripsi">Riwayat Penjadwalan</a></li>  
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
    @foreach ($penjadwalan_skripsis as $skripsi)
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$skripsi->mahasiswa->nim}}</td>
          <td>{{$skripsi->mahasiswa->nama}}</td>                   
          <td>{{$skripsi->jenis_seminar}}</td>                                                
          <td>{{$skripsi->tanggal}}</td>                   
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