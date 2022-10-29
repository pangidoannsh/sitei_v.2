@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('content')

<div class="row mb-5">

    <div class="col-6">
        <ol class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">NIM</div>
            <span>{{$penjadwalan->mahasiswa->nim}}</span>         
            </div>        
        </li> 
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Nama</div> 
            <span>{{$penjadwalan->mahasiswa->nama}}</span>          
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Judul</div>
            <span>{{$penjadwalan->revisi_skripsi != null ? $penjadwalan->revisi_skripsi : $penjadwalan->judul_proposal }}</span>
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Jadwal</div>
            <span>{{Carbon::parse($penjadwalan->tanggal)->translatedFormat('l, d F Y')}}, : {{$penjadwalan->waktu}}</span>             
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Lokasi</div>
            <span>{{$penjadwalan->lokasi}}</span>    
            </div>        
        </li>   
        </ol>
    </div>

    <div class="col-6">
        <ol class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Pembimbing</div>
                <span>1. {{$penjadwalan->pembimbingsatu->nama}}</span>
                <br>
                @if ($penjadwalan->pembimbingdua_nip != null)
                <span>{{$penjadwalan->pembimbingdua->nama}}</span>
                @endif                
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Penguji</div>
                <span>1. {{$penjadwalan->pengujisatu->nama}}</span>
                <br>
                <span>2. {{$penjadwalan->pengujidua->nama}}</span>
                <br>
                <span>3. {{$penjadwalan->pengujitiga->nama}}</span>
            </div>        
        </li>     
        </ol>
    </div>

</div>

<div>
    <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
        <div class="fw-bold mb-2">Judul Lama</div>
        <span>{{$penjadwalan->judul_skripsi}}</span>         
        </div>        
    </li> 
    <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
        <div class="fw-bold mb-2">Judul Baru</div> 
        <span>{{$penjadwalan->revisi_skripsi}}</span>          
        </div>        
    </li>    
</div>
<br>
@endsection   