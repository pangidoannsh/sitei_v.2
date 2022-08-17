@extends('layouts.main')

@section('title')
    Jadwal KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Jadwal KP
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<a href="{{url ('/form-kp/create')}}" class="btn btn-outline-dark mb-3">+ Jadwal KP</a>

<ol class="breadcrumb col-lg-3">   
  <li class="breadcrumb-item"><a class="breadcrumb-item active" href="/form-kp">Penjadwalan</a></li>  
  <li class="breadcrumb-item"><a href="/riwayat-penjadwalan-kp">Riwayat Penjadwalan</a></li>  
</ol>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIM</th>      
      <th scope="col">Mahasiswa</th>      
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
          <td>{{$kp->pembimbing->nama}}</td>
          <td>{{$kp->penguji->nama}}</td>                    
          <td>
            <a href="/form-kp/edit/{{$kp->id}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>
          </td>
        </tr>
    @endforeach
  </tbody>
</table>
    
@endsection

@push('scripts')
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
@endpush()