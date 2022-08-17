@extends('layouts.main')

@section('title')
    Riwayat Jadwal KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Riwayat Jadwal KP
@endsection

@section('content')

<ol class="breadcrumb col-lg-3">   
  <li class="breadcrumb-item"><a href="/form-sempro">Penjadwalan</a></li>  
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/riwayat-penjadwalan-kp">Riwayat Penjadwalan</a></li>  
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
    @foreach ($penjadwalan_kps as $kp)
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$kp->mahasiswa->nim}}</td>
          <td>{{$kp->mahasiswa->nama}}</td>                   
          <td>{{$kp->jenis_seminar}}</td>                                                
          <td>{{$kp->tanggal}}</td>                   
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
  </tbody>
</table>
    
@endsection