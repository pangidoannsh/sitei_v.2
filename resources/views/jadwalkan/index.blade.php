@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Jadwal | SIA ELEKTRO
@endsection

@section('sub-title')
    Jadwal
@endsection
@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 


<a href="#" class="btn btn-jadwalkan btn-success mb-3">Cetak Jadwal</a>
<style>
  .dt-buttons {
    display : none !important;
  }
</style>
<table class="table table-responsive-lg table-bordered table-striped" width="100%" id="data-jadwal">
  <thead class="table-dark">
    <tr>      
        <th class="text-center" scope="col">NIM</th>
        <th class="text-center" scope="col">Nama</th>
        <th class="text-center" scope="col">Seminar</th>
        <th class="text-center" scope="col">Prodi</th>
        <th class="text-center" scope="col">Hari</th>
        <th class="text-center" scope="col">Tanggal</th>
        <th class="text-center" scope="col">Waktu</th>
        <th class="text-center" scope="col">Lokasi</th>              
        <th class="text-center" scope="col">Pembimbing</th>
        <th class="text-center" scope="col">Penguji</th>
        @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)       
        <!-- <th class="text-center" scope="col">Aksi</th> -->
        @endif
    </tr>
  </thead>
  <tbody>


    @foreach ($penjadwalan_kps as $kp)
        <tr>                  
            <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$kp->mahasiswa->nama}}</td>                    
            <td class="bg-primary text-center">{{$kp->jenis_seminar}}</td>                     
            <td class="text-center">{{$kp->prodi->nama_prodi}}</td> 
            <td class="text-center">
              @if($kp->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($kp->tanggal)->translatedFormat('l')}}
              </td>
              @endif

            <td class="text-center">
            @if($kp->tanggal == null)
            <p> </p>
            @else
            {{Carbon::parse($kp->tanggal)->translatedFormat('d F Y')}}
            </td>
            @endif
            

            <td class="text-center">
              @if($kp->waktu == null)
              <p> </p>
              @else
              {{$kp->waktu}}
            </td>
            @endif

            <td class="text-center">
            @if ($kp->lokasi == null)<p> </p>
            @else
            {{$kp->lokasi}}
            </td>
            @endif                             
            <td class="text-center">{{$kp->pembimbing->nama_singkat}}</td>
            <td class="text-center">{{$kp->penguji->nama_singkat}}</td>                    
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)       
          <!-- <td class="text-center">
            <a href="/form-kp/edit/{{Crypt::encryptString($kp->id)}}" class="badge bg-warning mb-2"><i class="fas fa-pen"></i></a>            
            <a href="#ModalDelete" data-toggle="modal" class="badge bg-danger"><i class="fas fa-trash"></i></a>
          </td> -->
          @endif
        </tr>

        <div class="modal fade" id="ModalDelete">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Apakah Anda Yakin?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Data Yang Dihapus Tidak Akan Kembali!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <form action="/form-kp/{{Crypt::encryptString($kp->id)}}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button type="submit" class="btn btn-success">Yakin</button>
                </form>        
              </div>
            </div>
          </div>
        </div>
    @endforeach    

    @foreach ($penjadwalan_sempros as $sempro)
        <tr>                 
            <td class="text-center">{{$sempro->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$sempro->mahasiswa->nama}}</td>                     
            <td class="bg-success text-center">{{$sempro->jenis_seminar}}</td>                     
            <td class="text-center">{{$sempro->prodi->nama_prodi}}</td>  
            <td class="text-center">
              @if($sempro->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($sempro->tanggal)->translatedFormat('l')}}
              </td>
              @endif
            <td class="text-center">
            @if($sempro->tanggal == null)
            <p> </p>
            @else
            {{Carbon::parse($sempro->tanggal)->translatedFormat('d F Y')}}
            </td>
            @endif      
            <td class="text-center">{{$sempro->waktu}}</td>                   
            <td class="text-center">{{$sempro->lokasi}}</td>                   
          <td class="text-center">
            <p>1. {{$sempro->pembimbingsatu->nama_singkat}}</p>
            @if ($sempro->pembimbingdua == !null)
            <p>2. {{$sempro->pembimbingdua->nama_singkat}}</p>
            @endif
          </td> 
          <td class="text-center">
            <p>1. {{$sempro->pengujisatu->nama_singkat}}</p>
            @if ($sempro->pengujidua == !null)
            <p>2. {{$sempro->pengujidua->nama_singkat}}</p>            
            @endif
            @if ($sempro->pengujitiga == !null)
            <p>3. {{$sempro->pengujitiga->nama_singkat}}</p>                               
            @endif
          </td> 
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
          <!-- <td class="text-center">            
            <a href="/form-sempro/edit/{{Crypt::encryptString($sempro->id)}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>            
            <a href="#ModalDelete" data-toggle="modal" class="badge bg-danger"><i class="fas fa-trash"></i></a>
          </td> -->
          @endif                                
        </tr>

        <div class="modal fade" id="ModalDelete">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Apakah Anda Yakin?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Data Yang Dihapus Tidak Akan Kembali!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <form action="/form-sempro/{{Crypt::encryptString($sempro->id)}}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button type="submit" class="btn btn-success">Yakin</button>
                </form>        
              </div>
            </div>
          </div>
        </div>
    @endforeach

    @foreach ($penjadwalan_skripsis as $skripsi)
        <tr>                   
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
            <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                                     
            <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>  
            <td class="text-center">
              @if($skripsi->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($skripsi->tanggal)->translatedFormat('l')}}
              </td>
              @endif
            <td class="text-center">
            @if($skripsi->tanggal == null)
            <p> </p>
            @else
            {{Carbon::parse($skripsi->tanggal)->translatedFormat('d F Y')}}
            </td>
            @endif           
            <td class="text-center">{{$skripsi->waktu}}</td>                   
            <td class="text-center">{{$skripsi->lokasi}}</td>                    
          <td class="text-center">
            <p>1. {{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            @endif
          </td> 
          <td class="text-center">
            <p>1. {{$skripsi->pengujisatu->nama_singkat}}</p>
            @if ($skripsi->pengujidua == !null)
            <p>2. {{$skripsi->pengujidua->nama_singkat}}</p>
            @endif
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td> 
          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
          <!-- <td class="text-center">            
            <a href="/form-skripsi/edit/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-warning"><i class="fas fa-pen"></i></a>          
            <a href="#ModalDelete" data-toggle="modal" class="badge bg-danger"><i class="fas fa-trash"></i></a>
          </td>     -->
          @endif     
        </tr>
        <div class="modal fade" id="ModalDelete">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Apakah Anda Yakin?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Data Yang Dihapus Tidak Akan Kembali!</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <form action="/form-skripsi/{{Crypt::encryptString($skripsi->id)}}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button type="submit" class="btn btn-success">Yakin</button>
                </form>        
              </div>
            </div>
          </div>
        </div>
    @endforeach

  </tbody>
</table>
    
@endsection

@push('scripts')

<script>

  const qs = new URLSearchParams(window.location.search);

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);

  $("#data-jadwal").DataTable({
    dom: 'Bfrltip',
    buttons: [
        'pdf'
    ]
  });

  if(qs.get("download")) {
    $('#data-jadwal').DataTable().buttons(0,0).trigger();
  }

  window.location = "/form";

  $(".btn-jadwalkan").click(e => {
  })
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