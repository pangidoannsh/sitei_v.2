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

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

<ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/persetujuan-koordinator">Persetujuan</a></li>
  <li class="breadcrumb-item"><a href="/riwayat-koordinator">Riwayat Persetujuan</a></li>  
</ol>

<table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
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
          <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>                     
          <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                     
          <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>          
          <td class="text-center">{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
          <td class="text-center">{{$skripsi->waktu}}</td>                   
          <td class="text-center">{{$skripsi->lokasi}}</td>                     
          <td class="text-center">
            <p>1. {{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>2. {{$skripsi->pembimbingdua->nama_singkat}}</p>                               
            @endif
          </td> 
          <td class="text-center">
            <p>1. {{$skripsi->pengujisatu->nama_singkat}}</p>
            <p>2. {{$skripsi->pengujidua->nama_singkat}}</p>
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td>          
          <td class="text-center">                        
            <a href="/penilaian-skripsi/cek-nilai/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-success p-2"style="border-radius:20px;">Berita Acara</a>                  
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

@push('scripts')
<script>
  const swal= $('.swal').data('swal');
  if (swal) {
    Swal.fire({
      title : 'Berhasil',
      text : swal,
      confirmButtonColor: '#28A745',
      icon : 'success'
    })    
  }
</script>
@endpush()