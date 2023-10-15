@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Detail Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('message')}}
</div>
@endif


@foreach ($pendaftaran_skripsi as $skripsi)
<div class="container-fluid">

<div>
@if (Str::length(Auth::guard('dosen')->user()) > 0)

  <a href="/kp-skripsi/persetujuan-skripsi" class="badge bg-success p-2 mb-3"> Kembali <a>

 
  @endif



  <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h5 class="text-bold">Mahasiswa</h5>
      <hr>
        <p class="card-title text-secondary text-sm " >Nama</p>
        <p class="card-text text-start" >{{$skripsi->mahasiswa->nama}}</p>
        <p class="card-title text-secondary text-sm " >NIM</p>
        <p class="card-text text-start" >{{$skripsi->mahasiswa->nim}}</p>
        <p class="card-title text-secondary text-sm " >Program Studi</p>
        <p class="card-text text-start" >{{$skripsi->mahasiswa->prodi->nama_prodi}}</p>
        <p class="card-title text-secondary text-sm " >Konsentrasi</p>
        <p class="card-text text-start" >{{$skripsi->mahasiswa->konsentrasi->nama_konsentrasi}}</p>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Dosen Pembimbing</h5>
        <hr>
        @if ($skripsi->pembimbing_2_nip == null )
        <p class="card-title text-secondary text-sm" >Nama</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing1->nama}}</p>
        <!-- <p class="card-title text-secondary text-sm" >NIP</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing1->nip}}</p> -->

        @elseif($skripsi->pembimbing_2_nip !== null)
        <p class="card-title text-secondary text-sm" >Nama Pembimbing 1</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing1->nama}}</p>
        <!-- <p class="card-title text-secondary text-sm" >NIP</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing1->nip}}</p> -->
        <p class="card-title text-secondary text-sm" >Nama Pembimbing 2</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing2->nama}}</p>
        <!-- <p class="card-title text-secondary text-sm" >NIP</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing2->nip}}</p> -->
        @endif
      </div>
    </div>
  </div>
</div>



  
<div class="card">
<div class="card-body">
      <h5 class="text-bold">Data Usulan</h5>
      <hr>
<div class="row">
<div class="col">
   
        <p class="card-title text-secondary text-sm " >STI-22/Surat Pernyataan Perpanjangan Waktu Skripsi</p>
        <p class="card-text text-start" ><span><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$skripsi->sti_22_p2 )}}" class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
        </div>

  </div>
  </div>
  </div>
    
    

    <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Keterangan Pendaftaran</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Jenis Usulan</p>
        <p class="card-text text-start" ><span >{{$skripsi->jenis_usulan}}</span></p>
        @if ($skripsi->status_skripsi == 'PERPANJANGAN 2')
        <p class="card-title text-secondary text-sm" >Status Skripsi</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-secondary text-bold pr-3 pl-3" style="border-radius:20px;">{{$skripsi->status_skripsi}}</span></p>
        @endif
        @if ($skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-info text-bold pr-3 pl-3" style="border-radius:20px;">{{$skripsi->status_skripsi}}</span></p>
        @endif
        @if ($skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK')
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-danger text-bold pr-3 pl-3" style="border-radius:20px;">{{$skripsi->status_skripsi}}</span></p>
        @endif
        <p class="card-title text-secondary text-sm" >Keterangan</p>
        <p class="card-text text-start" ><span>{{$skripsi->keterangan}}</span></p>

      </div>
    </div>

    @if ($skripsi->pembimbing_1_nip == Auth::user()->nip )
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2' && $skripsi->keterangan == 'Menunggu persetujuan Pembimbing 1' )
          <div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakPerpanjangan2Pembimbing()"  class="btn btn-danger badge p-2 px-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button>
</div>
    <div class="col">
        <form action="/perpanjangan2/pembimbing/approve/{{$skripsi->id}}" class="setujui-perpanjangan2-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-2 px-3">Setujui</i></button>
</form>
    </div>
  </div>
  </div>
     @endif
     @endif  



    @if (Str::length(Auth::guard('dosen')->user()) > 0)
    @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )

    @if ($skripsi->keterangan == 'Menunggu persetujuan Koordinator Program Studi' && $skripsi->status_skripsi == 'PERPANJANGAN 2' )
    <div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakPerpanjangan2Kaprodi()"  class="btn btn-danger badge p-2 px-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button>
</div>
    <div class="col">
        <form action="/perpanjangan2/kaprodi/approve/{{$skripsi->id}}" class="setujui-perpanjangan2-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-2 px-3">Setujui</i></button>
</form>
    </div>
  </div>
  </div>

        @endif

    @endif
    @endif
 
 
  
  @endforeach
</div>
</div>


<br>
<br>
<br>

@endsection

@push('scripts')
@foreach ($pendaftaran_skripsi as $skripsi)
<script>
  
$('.setujui-perpanjangan2-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Perpanjangan 2 Waktu Skripsi!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakPerpanjangan2Pembimbing(id) {
     Swal.fire({
            title: 'Tolak Perpanjangan 2 Waktu Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 2 Waktu Skripsi',
                    html: `
                        <form id="reasonForm" action="/perpanjangan2/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }
$('.setujui-perpanjangan2-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Perpanjangan 2 Waktu Skripsi!',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Setuju'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakPerpanjangan2Kaprodi(id) {
     Swal.fire({
            title: 'Tolak Perpanjangan 2 Waktu Skripsi!',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 2 Waktu Skripsi',
                    html: `
                        <form id="reasonForm" action="/perpanjangan2/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
            }
        });
    }
</script>
@endforeach
@endpush()