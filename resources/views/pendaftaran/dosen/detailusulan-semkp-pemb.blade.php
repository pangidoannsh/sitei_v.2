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

      <section class="mb-5">
<div class="container">
@if (Str::length(Auth::guard('dosen')->user()) > 0)
    <a href="/pembimbing/kerja-praktek" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
   @endif
 </div>

  @foreach ($pendaftaran_kp as $kp)

<div class="container">
    <div class="row rounded shadow-sm">
        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
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
        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
        <h5 class="text-bold">Dosen Pembimbing</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Nama</p>
        <p class="card-text text-start" >{{$kp->dosen_pembimbingkp->nama}}</p>
        </div>
    </div>
</div>


<div class="container">
    <div class="row rounded shadow-sm">
        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-start">
        <h5 class="text-bold">Data Usulan</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Judul Laporan</p>
        <p class="card-text text-start"> {{$kp->judul_laporan}}</p>
        <p class="card-title text-secondary text-sm" >Laporan</p>
        <p class="card-text  text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->laporan_kp )}}" class="badge bg-dark px-3 py-2">Buka</a></p>
        <p class="card-title text-secondary text-sm" >KPTI-11/Bukti Mengumpulkan Syarat Pendaftaran Seminar KP</p>
        <p class="card-text  text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->kpti_11 )}}" class="badge bg-dark px-3 py-2">Buka</a></p>
        <p class="card-title text-secondary text-sm" >STI-31/Surat Persetujuan Sertifikat Pendamping</p>
        <p class="card-text  text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->sti_31 )}}" class="badge bg-dark px-3 py-2">Buka</a></p>
        </div>
        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
        <h5 class="text-bold">Keterangan Pendaftaran</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Jenis Usulan</p>
        <p class="card-text text-start" ><span >{{$kp->jenis_usulan}}</span></p>
        @if ($kp->status_kp == 'DAFTAR SEMINAR KP' )
        <p class="card-title text-secondary text-sm" >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-secondary text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        @if ($kp->status_kp == 'DAFTAR SEMINAR KP DITOLAK' )
        <p class="card-title text-secondary text-sm" >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-danger text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        @if ($kp->status_kp == 'SEMINAR KP DIJADWALKAN' )
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-success text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        @if ($kp->status_kp == 'SEMINAR KP SELESAI' || $kp->status_kp == 'DAFTAR SEMINAR KP DISETUJUI' )
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-info text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        <p class="card-title text-secondary text-sm" >Keterangan</p>
        <p class="card-text text-start" ><span>{{$kp->keterangan}}</span></p>
        </div>
    </div>
</div>

<div class="container">
     @if ($kp->dosen_pembimbing_nip == Auth::user()->nip )
      @if ($kp->status_kp == 'DAFTAR SEMINAR KP' && $kp->keterangan == 'Menunggu persetujuan Pembimbing' )
  <div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakSemKPPemb()"  class="btn btn-danger py-2 px-3 mb-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/usulan-semkp/pembimbing/approve/{{$kp->id}}" class="setujui-semkp-pembimbing" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success py-2 px-3 mb-3 mb-3">Setujui</i></button>
</form>
    </div>
  </div>
  </div>

@endif
@endif

@endforeach
          </div>
</section>
<br>



@endsection


@push('scripts')
@foreach ($pendaftaran_kp as $kp)
<script>

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
</script>
@endforeach
@endpush()