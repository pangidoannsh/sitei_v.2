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
    <a href="/persetujuan-kp-skripsi" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
   @endif
        
        @if (Str::length(Auth::guard('web')->user()) > 0)
        <a href="/persetujuan/admin/index" class="btn btn-success py-1 px-2 mb-3"><i class="fas fa-arrow-left fa-xs"></i> Kembali <a>
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
        @if($kp->status_kp == 'USULAN KP')
        <h5 class="text-bold">Calon Dosen Pembimbing</h5>
        @else
        <h5 class="text-bold">Dosen Pembimbing</h5>
        @endif
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

        <p class="card-title text-secondary text-sm" >Nama Perusahaan</p>
        <p class="card-text text-start" >{{$kp->nama_perusahaan}}</p>
     
        <p class="card-title text-secondary text-sm" >Alamat Perusahaan</p>
        <p class="card-text text-start"> {{$kp->alamat_perusahaan}}</p>
        
        <p class="card-title text-secondary text-sm" >Bidang Usaha/Kegiatan</p>
        <p class="card-text text-start" >{{$kp->bidang_usaha}}</p>
        <p class="card-title text-secondary text-sm " >KRS Semester Berjalan</p>
        <p class="card-text  text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->krs_berjalan )}}" class="badge bg-dark px-3 py-2">Buka</a></p>
        <p class="card-title text-secondary text-sm " >Transkip Nilai</p>
        <p class="card-text  text-start" ><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$kp->transkip_nilai )}}" class="badge bg-dark px-3 py-2">Buka</a></p>

        <!-- <p class="card-text text-start " ><button  onclick="newTab2();" formtarget="_blank" target="_blank"class="badge bg-dark px-3 p-1">Buka</button></p> -->

        <p class="card-title text-secondary text-sm" >Rencana Mulai KP</p>
        <p class="card-text text-start mb-md-4"> {{Carbon::parse($kp->tanggal_rencana)->translatedFormat('l, d F Y')}}</p>
        </div>
        <div class="col-lg-6 col-md-12 px-4 py-3 mb-2 bg-white rounded-end">
            <h5 class="text-bold">Keterangan Pendaftaran</h5>
        <hr>
        <p class="card-title text-secondary text-sm" >Jenis Usulan</p>
        <p class="card-text text-start" ><span >{{$kp->jenis_usulan}}</span></p>
        @if ($kp->status_kp == 'USULAN KP' )
        <p class="card-title text-secondary text-sm" >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-secondary text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        @if ($kp->status_kp == 'USULAN KP DITERIMA' )
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-info text-bold pr-3 pl-3" style="border-radius:20px;">{{$kp->status_kp}}</span></p>
        @endif
        <p class="card-title text-secondary text-sm" >Keterangan</p>
        <p class="card-text text-start" ><span>{{$kp->keterangan}}</span></p>
        </div>
    </div>
  </div>

   <div class="container">
    <!-- APPROVAL PEMBIMBING -->
    @if ($kp->dosen_pembimbing_nip == Auth::user()->nip )
    @if ($kp->keterangan == 'Menunggu persetujuan Pembimbing' && $kp->status_kp == 'USULAN KP')
<div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakUsulanKPPembimbing()"  class="btn btn-danger py-2 px-3 mb-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/usulankp/pembimbing/approve/{{$kp->id}}" class="setujui-usulankp-pemb" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success py-2 px-3 mb-3">Setujui</i></button>
</form>
    </div>
  </div>
    @endif
    @endif

         <!-- APPROVAL ADMIN PRODI -->
  @if (Str::length(Auth::guard('web')->user()) > 0)
  @if (Auth::guard('web')->user()->role_id == 2 || Auth::guard('web')->user()->role_id == 3 || Auth::guard('web')->user()->role_id == 4 )
    @if ($kp->keterangan == 'Menunggu persetujuan Admin Prodi' && $kp->status_kp == 'USULAN KP' )
<div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakUsulanKPAdmin()"  class="btn btn-danger py-2 px-3 mb-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/usulankp/admin/approve/{{$kp->id}}" class="setujui-usulankp-admin" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success py-2 px-3 mb-3">Setujui</i></button>
</form>
    </div>
  </div>
    @endif
    @endif
    @endif

    <!-- APPROVAL KOORDINATOR -->
    @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
          @if ($kp->keterangan == 'Menunggu persetujuan Koordinator KP' && $kp->status_kp == 'USULAN KP' )

          <div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
         <button onclick="tolakUsulanKPKoordinator()"  class="btn btn-danger py-2 px-3 mb-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/usulankp/koordinator/approve/{{$kp->id}}" class="setujui-usulankp-koordinator" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success py-2 px-3 mb-3">Setujui</i></button>
</form>
    </div>
  </div>

    @endif
    @endif
    @endif


    
    @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )
          @if ($kp->keterangan == 'Menunggu persetujuan Koordinator Program Studi' && $kp->status_kp == 'USULAN KP' )

            <div class="mb-5 mt-3 float-right">
        <div class="row row-cols-2">
    <div class="col">
        <button onclick="tolakUsulanKPKaprodi()"  class="btn btn-danger py-2 px-3 mb-3" data-bs-toggle="tooltip" title="Tolak" >Tolak</button> 
</div>
    <div class="col">
        <form action="/usulankp/kaprodi/approve/{{$kp->id}}" class="setujui-usulankp-kaprodi" method="POST"> 
    @method('put')
    @csrf
    <button class="btn btn-success py-2 px-3 mb-3">Setujui</i></button>
</form>
    </div>
  </div>
  
    @endif
    @endif
    @endif

  
  @endforeach
</div>
</section>



@endsection

<script>
    function newTab1(url){
        var x = window.open('{{asset('storage/' .$kp->krs_berjalan )}}','_blank');
        x.focus();
    }
    function newTab2(url){
        var x = window.open('{{asset('storage/' .$kp->transkip_nilai )}}','_blank');
        x.focus();
    }

</script>

@push('scripts')
@foreach ($pendaftaran_kp as $kp)
<script>
//APPROVAL
    $('.setujui-usulankp-pemb').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan KP!',
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

function tolakUsulanKPPembimbing() {
     Swal.fire({
            title: 'Tolak Usulan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    html: `
                        <form id="reasonForm" action="/usulankp/pembimbing/tolak/{{$kp->id}}" method="POST">
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
    $('.setujui-usulankp-admin').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan KP!',
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

 function tolakUsulanKPAdmin() {
     Swal.fire({
            title: 'Tolak Usulan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    html: `
                        <form id="reasonForm" action="/usulankp/admin/tolak/{{$kp->id}}" method="POST">
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

    $('.setujui-usulankp-koordinator').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan KP!',
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

 function tolakUsulanKPKoordinator() {
     Swal.fire({
            title: 'Tolak Usulan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    html: `
                        <form id="reasonForm" action="/usulankp/koordinator/tolak/{{$kp->id}}" method="POST">
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

    $('.setujui-usulankp-kaprodi').submit(function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Setujui Usulan KP!',
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

function tolakUsulanKPKaprodi() {
     Swal.fire({
            title: 'Tolak Usulan KP',
            text: 'Apakah Anda Yakin?',
            icon: 'question',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Tolak',
            confirmButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    html: `
                        <form id="reasonForm" action="/usulankp/kaprodi/tolak/{{$kp->id}}" method="POST">
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