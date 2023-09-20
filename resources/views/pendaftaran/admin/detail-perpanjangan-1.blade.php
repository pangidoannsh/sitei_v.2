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
@if (Str::length(Auth::guard('web')->user()) > 0)

  <a href="/sidang/admin/index" class="badge bg-success p-2 mb-3"> Kembali <a>

 
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
        <p class="card-title text-secondary text-sm" >NIP</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing1->nip}}</p>

        @elseif($skripsi->pembimbing_2_nip !== null)
        <p class="card-title text-secondary text-sm" >Nama Pembimbing 1</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing1->nama}}</p>
        <p class="card-title text-secondary text-sm" >NIP</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing1->nip}}</p>
        <p class="card-title text-secondary text-sm" >Nama Pembimbing 2</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing2->nama}}</p>
        <p class="card-title text-secondary text-sm" >NIP</p>
        <p class="card-text text-start" >{{$skripsi->dosen_pembimbing2->nip}}</p>
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
        <p class="card-text text-start" ><span><a formtarget="_blank" target="_blank" href="{{asset('storage/' .$skripsi->sti_22_p1 )}}" class="badge bg-dark pr-3 p-2 pl-3">Buka</a></span></p>
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
        @if ($skripsi->status_skripsi == 'PERPANJANGAN 1')
        <p class="card-title text-secondary text-sm" >Status Skripsi</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-secondary text-bold pr-3 pl-3" style="border-radius:20px;">{{$skripsi->status_skripsi}}</span></p>
        @endif
        @if ($skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')
        <p class="card-title text-secondary text-sm " >Status KP</p>
        <p class="card-text text-start" ><span class="badge p-2 bg-info text-bold pr-3 pl-3" style="border-radius:20px;">{{$skripsi->status_skripsi}}</span></p>
        @endif
        <p class="card-title text-secondary text-sm" >Keterangan</p>
        <p class="card-text text-start" ><span>{{$skripsi->keterangan}}</span></p>

      </div>
    </div>



  <div class="row">
      
    @if (Str::length(Auth::guard('dosen')->user()) > 0)
          @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )

    <div class="mb-5 mt-4">
    @if ($skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI PEMBIMBING' || $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI PEMBIMBING 2'  )
    <div class="mb-5 float-right">
 
        <button type="button"
                class="btn btn-danger badge p-2 fas fa-times"
                data-toggle="modal"
                data-target="#GFG2">
            Tolak
        </button>
        <button type="button"
                class="btn btn-success badge p-2  fas fa-check"
                data-toggle="modal"
                data-target="#GFG">
            Setujui
        </button>
  
        <div class="modal fade" id="GFG2">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                <div class="modal-header bg-danger">
                        <h5 class="modal-title  fas fa-times">
                            Tolak
                        </h5>
  
                    </div>
                    <div class="modal-body ">
                        Apakah Anda yakin?
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn " style="border-radius:5px;"
                                data-dismiss="modal">
                            Batal
                        </button>
                        <form action="/daftarsidang/koordinator/tolak/{{$skripsi->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn " style="border-radius:5px;">  Ya</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="GFG">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header bg-success ">
                        <h5 class="modal-title fas fa-check">
                            Setujui
                        </h5>
  
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin?
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn " style="border-radius:5px;"
                                data-dismiss="modal">
                            Batal
                        </button>
                        <form action="/daftarsidang/koordinator/approve/{{$skripsi->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn " style="border-radius:5px;">  Ya</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
            @endif
  
            </div>
   
    @endif
    @endif
    
    @if (Str::length(Auth::guard('dosen')->user()) > 0)
    @if (Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 )

    @if ($skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI KOORDINATOR SKRIPSI' )
    <div class="mb-5 mt-4">

    <div class="mb-5 float-right">
        <!-- <h1 class="text-success">
            GeeksforGeeks
        </h1>
        <h2>Bootstrap 5 Modal Vertically centered</h2> -->
        <button type="button"
                class="btn btn-danger badge p-2 fas fa-times"
                data-toggle="modal"
                data-target="#GFG2">
            Tolak
        </button>
        <button type="button"
                class="btn btn-success badge p-2  fas fa-check"
                data-toggle="modal"
                data-target="#GFG">
            Setujui
        </button>
  
        <div class="modal fade" id="GFG2">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                <div class="modal-header bg-danger">
                        <h5 class="modal-title  fas fa-times">
                            Tolak
                        </h5>
  
                    </div>
                    <div class="modal-body ">
                        Apakah Anda yakin?
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn " style="border-radius:5px;"
                                data-dismiss="modal">
                            Batal
                        </button>
                        <form action="/daftarsidang/kaprodi/tolak/{{$skripsi->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn " style="border-radius:5px;">  Ya</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="GFG">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header bg-success ">
                        <h5 class="modal-title fas fa-check">
                            Setujui
                        </h5>
  
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin?
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn " style="border-radius:5px;"
                                data-dismiss="modal">
                            Batal
                        </button>
                        <form action="/daftarsidang/kaprodi/approve/{{$skripsi->id}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit" class="btn " style="border-radius:5px;">  Ya</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        @endif
        <!-- @if ($skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI' )
                
                <p  class="badge bg-success float-right rounded-pill p-2 ml-3 fas fa-check">  Anda sudah menyetujui</a>
            
        @endif -->
    @endif
    @endif
 
  
  @endforeach
</div>
</div>


<br>

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