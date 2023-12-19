@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Daftar Beban Bimbingan Dosen
@endsection

@section('sub-title')
Daftar Beban Bimbingan Dosen
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif

<div class="container pb-4 ">

<div class="container-fluid card p-4">
<div class="mb-4 rounded bg-light">
  <div class="p-2 pt-3">
    <h5 class="">Beban Bimbingan KP</h5>
  <hr>
  </div>
</div>

          <table class="table table-responsive-lg rounded table-bordered table-striped" width="100%" id="datatables">
  <thead class="table-dark">
    <tr>      
        <th class="text-center" scope="col">No.</th>
        <th class="text-center" scope="col">Kode Dosen</th>
        <th class="text-center" scope="col">Nama Dosen</th>
        <th class="text-center" scope="col">Total Bimbingan</th>
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($dosen as $dosen)
<div></div>
        <tr>        
            <td class="text-center">{{$loop->iteration}}</td>                             
            <td class="text-center">{{$dosen->nama_singkat}}</td>                             
            <td >{{$dosen->nama}}</td>                             
            <td class="text-center @if(($dosen->pendaftaran_k_p_count) >= ($kapasitas->kapasitas_kp)) bg-danger @endif bg-info">{{ $dosen->pendaftaran_k_p_count }}</td>

            <td class="text-center" > 
                <a href="/detail/kuota-bimbingan/kp/{{($dosen->nip)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
            </td>                             
            
    @endforeach
  </tbody>
</table>

</div>


<div class="container-fluid card p-4 mt-5">
  <div class="mb-4 rounded bg-light">
    <div class="p-2 pt-3">
      <h5 class="">Beban Bimbingan Skripsi</h5>
    <hr>
    </div>
  </div>

          <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables2">
  <thead class="table-dark">
    <tr>      
        <th class="text-center" scope="col">No.</th>
        <th class="text-center" scope="col">Kode Dosen</th>
        <th class="text-center" scope="col">Nama Dosen</th>

        <th class="text-center" scope="col">Pembimbing 1</th>
        <th class="text-center" scope="col">Pembimbing 2</th>
        <th class="text-center" scope="col">Total Bimbingan</th>
        <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($dosenn as $dosen)
<div></div>
        <tr>        
            <td class="text-center">{{$loop->iteration}}</td>                             
            <td class="text-center">{{$dosen->nama_singkat}}</td>                             
            <td >{{$dosen->nama}}</td>                             

                <td class="text-center">{{ $dosen->pendaftaran_skripsi1_count }}</td>  
                <td class="text-center">{{ $dosen->pendaftaran_skripsi2_count }}</td>  

                <td class="text-center @if(($dosen->pendaftaran_skripsi1_count + $dosen->pendaftaran_skripsi2_count) >= ($kapasitas->kapasitas_skripsi)) bg-danger @endif bg-info">{{ $dosen->pendaftaran_skripsi1_count + $dosen->pendaftaran_skripsi2_count }}</td>
                <td class="text-center">
                    <a href="/detail/kuota-bimbingan/skripsi/{{($dosen->nip)}}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                </td>
    @endforeach
  </tbody>
</table>

</div>


<div class="card pt-2 mt-5">
  <div class="card-body">
    <h5 class="card-title fw-bold ">Keterangan :</h5> <br>
    <span class="card-text">Kuota maksimal bimbingan KP adalah <b> {{$kapasitas->kapasitas_kp}} Orang. </b> </span> <br>
    <span class="card-text">Kuota maksimal bimbingan Skripsi adalah <b> {{$kapasitas->kapasitas_skripsi}} Orang.</span>
  </div>
</div>

</div>

@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
</section>
@endsection