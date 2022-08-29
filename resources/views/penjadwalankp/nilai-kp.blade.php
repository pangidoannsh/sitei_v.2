@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Berita Acara KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Berita Acara Seminar KP
@endsection

@section('content')

<div class="row mb-5">

    <div class="col-6">
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:20px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">NIM</div>
            <span>{{$penjadwalan->nim}}</span>         
            </div>        
        </li> 
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Nama</div> 
            <span>{{$penjadwalan->nama}}</span>            
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
            <div class="fw-bold mb-2">Judul</div>
            <span>{{$penjadwalan->judul_kp}}</span>
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
        <ol class="list-group" style="box-shadow: 2px 2px 2px 2px #dbdbdb; border-radius:20px;">
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Pembimbing</div>
                <span>{{$penjadwalan->pembimbing->nama}}</span>                              
            </div>        
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold mb-2">Penguji</div>
                <span>{{$penjadwalan->penguji->nama}}</span>                            
            </div>        
        </li>     
        </ol>
    </div>

</div>

<div>     
    <table class="table table-bordered" style="background-color:white;">
        <thead class="bg-success">
            <tr>
                <th style="width: 50px">#</th>
                <th style="width: 600px">Aspek Penilaian</th>                
                <th>Nilai</th>                        
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>  
                <td>Presentasi</td>                
                <td>{{$penilaiankp->presentasi}}</td>                        
            </tr>
            
            <tr>
                <td>2</td>  
                <td>Materi</td>                
                <td>{{$penilaiankp->materi}}</td>                        
            </tr>
            
            <tr>
                <td>3</td>  
                <td>Tanya Jawab</td>                
                <td>{{$penilaiankp->tanya_jawab}}</td>                        
            </tr>  

            <tr>
                <td colspan="2">Total Nilai Seminar
                    <span class="badge bg-success ml-3">30%</span>
                </td>                               
                <td >{{$penilaiankp->total_nilai_seminar}}</td>                        
            </tr>
            
            <tr>
                <td colspan="2">Nilai Pembimbing Lapangan
                    <span class="badge bg-success ml-3">40%</span>
                </td>                               
                <td >{{$penilaiankp->nilai_pembimbing_lapangan}}</td>                        
            </tr>

            <tr>
                <td colspan="2">Nilai Pembimbing KP
                    <span class="badge bg-success ml-3">30%</span>
                </td>                               
                <td >{{$penilaiankp->nilai_pembimbing_kp}}</td>                        
            </tr>

            <tr>
                <td class="bg-secondary" colspan="2">Total Nilai Angka</td>                               
                <td class="bg-secondary">{{$penilaiankp->total_nilai_angka}}</td>                        
            </tr>

            <tr>
                <td class="bg-secondary" colspan="2">Total Nilai Huruf</td>                               
                <td class="bg-secondary">{{$penilaiankp->total_nilai_huruf}}</td>                        
            </tr>

        </tbody>
    </table>            
</div>
@endsection   