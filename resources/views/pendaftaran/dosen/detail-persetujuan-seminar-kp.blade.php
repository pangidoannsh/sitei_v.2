@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Detail Mahasiswa
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


<div class="container-fluid">
<div>
@foreach ($pendaftaran_kp as $kp)

@if (Str::length(Auth::guard('dosen')->user()) > 0)       

  <a href="/kp-skripsi/persetujuan-kp" class="badge bg-success p-2 mb-3 "> Kembali <a>
  @endif
  
  @if (Str::length(Auth::guard('web')->user()) > 0)       
  
    <a href="/persetujuan/admin/index" class="badge bg-success p-2 mb-3"> Kembali <a><br>
        <!-- <a href="/form-kp/create" class="badge bg-success p-2 mb-3"> Tambah Jadwal KP<a> -->
    @endif

 <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <h5 class="text-bold">Mahasiswa</h5>
      <hr>
        <p class="card-title text-secondary text-sm " >Nama</p>
        <p class="card-text text-start" >{{$kp->mahasiswa->nama}}</p>
        <p class="card-title text-secondary text-sm " >NIM</p>
        <p class="card-text text-start" >{{$kp->mahasiswa->nim}}</p>
        <p class="card-title text-secondary text-sm " >Program Studi</p>
        <p class="card-text text-start" >{{$kp->mahasiswa->prodi->nama_prodi}}</p>
        <p class="card-title text-secondary text-sm " >Konsentrasi</p>
        <p class="card-text text-start" >{{$kp->mahasiswa->konsentrasi->nama_konsentrasi}}</p>
        
      </div>
    </div>
     <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Dosen Pembimbing</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Nama</p>
        <p class="card-text text-start" >{{$kp->dosen_pembimbingkp->nama}}</p>
        <!-- <p class="card-title text-secondary text-sm" >NIP</p>
        <p class="card-text text-start" >{{$kp->dosen_pembimbingkp->nip}}</p> -->

      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
<div class="card-body">
      <h5 class="text-bold">Data Usulan</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Judul Laporan</p>
        <p class="card-text text-start"> {{$kp->judul_laporan}}</p>
        <p class="card-title text-secondary text-sm" >Laporan</p>
       <p class="card-text text-start " ><button  onclick="window.location.href='{{asset('storage/' .$kp->laporan_kp )}}';" formtarget="_blank" target="_blank"class="badge bg-dark px-3 p-1">Buka</button></p>
        <!-- <p class="card-text text-start" > <span><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->laporan_kp)}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></span></p> -->
        <p class="card-title text-secondary text-sm" >KPTI-11</p>
        <p class="card-text text-start " ><button  onclick="window.location.href='{{asset('storage/' .$kp->kpti_11 )}}';" formtarget="_blank" target="_blank"class="badge bg-dark px-3 p-1">Buka</button></p>
        <!-- <p class="card-text text-start" > <span><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->kpti_11)}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></span></p> -->
        <p class="card-title text-secondary text-sm" >STI-31</p>
        <p class="card-text text-start " ><button  onclick="window.location.href='{{asset('storage/' .$kp->sti_31 )}}';" formtarget="_blank" target="_blank"class="badge bg-dark px-3 p-1">Buka</button></p>
        <!-- <p class="card-text text-start" > <span><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->sti_31)}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></span></p> -->

  </div>
  </div>
   
  </div>
</div>

<!-- <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Data Usulan</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Judul Laporan</p>
        <p class="card-text text-start"> {{$kp->judul_laporan}}</p>
        <p class="card-title text-secondary text-sm" >Laporan</p>
        <p class="card-text text-start" > <span><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->laporan_kp)}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></span></p>
        <p class="card-title text-secondary text-sm" >KPTI-11</p>
        <p class="card-text text-start" > <span><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->kpti_11)}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></span></p>
        <p class="card-title text-secondary text-sm" >STI-31</p>
        <p class="card-text text-start" > <span><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->sti_31)}}" class="badge bg-dark pr-3 p-2 pl-3">Lihat</a></span></p>

      </div>
    </div> -->


    <div class="card">
      <div class="card-body">
        <h5 class="text-bold">Keterangan Pendaftaran</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Jenis Usulan</p>
        <p class="card-text text-start" ><span >{{$kp->jenis_usulan}}</span></p>
        @if ($kp->status_kp == 'DAFTAR SEMINAR KP' )
        <p class="card-title text-secondary text-sm" >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-secondary text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        @if ($kp->status_kp == 'SEMINAR KP DIJADWALKAN' )
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-success text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        @if ($kp->status_kp == 'SEMINAR KP SELESAI' )
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-info text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        <p class="card-title text-secondary text-sm" >Keterangan</p>
        <p class="card-text text-start" ><span>{{$kp->keterangan}}</span></p>

      </div>
    </div>

    @if (Str::length(Auth::guard('web')->user()) > 0)
    @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
    
    @if ($kp->status_kp == 'DAFTAR SEMINAR KP' && $kp->keterangan == 'Menunggu persetujuan Admin Prodi')
   <div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakSemKPAdmin()"  class="btn btn-danger badge p-2 px-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/semkp/admin/approve/{{$kp->id}}" class="setujui-semkp-admin" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-2 px-3 mb-3">Setujui</i></button>
</form>
    </div>
  </div>
        @endif
  @endif
  @endif

        @if ($kp->dosen_pembimbing_nip == Auth::user()->nip )
      @if ($kp->status_kp == 'DAFTAR SEMINAR KP' && $kp->keterangan == 'Menunggu persetujuan Pembimbing' )
  <div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakSemKPPemb()"  class="btn btn-danger badge p-2 px-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/usulan-semkp/pembimbing/approve/{{$kp->id}}" class="setujui-semkp-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-2 px-3 mb-3">Setujui</i></button>
</form>
    </div>
  </div>

            @endif
            @endif

@if ($kp->dosen_pembimbing_nip == Auth::user()->nip )
            @if ($kp->status_kp == 'SEMINAR KP DIJADWALKAN' )
      <div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakGagalSemKPPemb()"  class="btn btn-danger badge p-2 px-3" data-bs-toggle="tooltip" title="Tolak" >Gagal</button> 
</div>
    <div class="col">
        <form action="/selesaiseminar-kp/pembimbing/approve/{{$kp->id}}" class="setujui-selesai-semkp-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-2 px-3 mb-3">Selesai</i></button>
</form>
    </div>
  </div>

            @endif
            @endif

            <!-- APPROVAL KOORDINATOR KP  -->
  @if (Str::length(Auth::guard('dosen')->user()) > 0)
  @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
     @if ($kp->status_kp == 'DAFTAR SEMINAR KP' && $kp->keterangan == 'Menunggu persetujuan Koordinator KP')
<div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakSemKPKoordinator()"  class="btn btn-danger badge p-2 px-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/usulan-semkp/koordinator/approve/{{$kp->id}}" class="setujui-semkp-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-2 px-3 mb-3">Setujui</i></button>
</form>
    </div>
  </div>
    @endif
    @endif
    @endif
  @if (Str::length(Auth::guard('dosen')->user()) > 0)
  @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
     @if ($kp->status_kp == 'DAFTAR SEMINAR KP' && $kp->keterangan == 'Menunggu persetujuan Koordinator Program Studi')
<div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakSemKPKaprodi()"  class="btn btn-danger badge p-2 px-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/usulan-semkp/kaprodi/approve/{{$kp->id}}" class="setujui-semkp-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success badge p-2 px-3 mb-3">Setujui</i></button>
</form>
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
@foreach ($pendaftaran_kp as $kp)
<script>
   $('.setujui-semkp-admin').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Daftar Seminar KP!',
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

 function tolakSemKPAdmin() {
     Swal.fire({
            title: 'Tolak Usulan Daftar Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Daftar Seminar KP',
                    html: `
                        <form id="reasonForm" action="/semkp/admin/tolak/{{$kp->id}}" method="POST">
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



$('.setujui-semkp-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Seminar KP!',
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

function tolakSemKPPemb() {
     Swal.fire({
            title: 'Tolak Usulan Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    html: `
                        <form id="reasonForm" action="/usulan-semkp/pembimbing/tolak/{{$kp->id}}" method="POST">
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

//APPROVAL
    $('.setujui-semkp-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Seminar KP!',
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

 function tolakSemKPKoordinator() {
     Swal.fire({
            title: 'Tolak Usulan Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    html: `
                        <form id="reasonForm" action="/usulan-semkp/koordinator/tolak/{{$kp->id}}" method="POST">
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
//APPROVAL
    $('.setujui-semkp-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan Seminar KP!',
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

 function tolakSemKPKaprodi() {
     Swal.fire({
            title: 'Tolak Usulan Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    html: `
                        <form id="reasonForm" action="/usulan-semkp/kaprodi/tolak/{{$kp->id}}" method="POST">
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

     $('.setujui-selesai-semkp-pembimbing').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Selesai Seminar KP',
        text: "Apakah Anda Yakin?",
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonColor: '#28a745',
        cancelButtonColor: 'grey',
        confirmButtonText: 'Selesai'
    }).then((result) => {
        if (result.isConfirmed) {
            event.currentTarget.submit();
        }
    })
});

function tolakGagalSemKPPemb() {
     Swal.fire({
            title: 'Gagal Seminar KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Gagal',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Gagal Seminar KP',
                    html: `
                        <form id="reasonForm" action="/selesaiseminar-kp/pembimbing/tolak/{{$kp->id}}" method="POST">
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