@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Jadwal Seminar
@endsection

@section('sub-title')
    Jadwal Seminar
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

@if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
    
<!-- <div>
<a href="{{url ('/form-kp/create')}}" class="btn kp btn-success mb-4">+ KP</a>
<a href="{{url('/form-sempro/create')}}" class="btn sempro btn-success mb-4">+ Sempro</a>
<a href="{{url('/form-skripsi/create')}}" class="btn skripsi btn-success mb-4">+ Skripsi</a>
<a href="#ModalClear" data-toggle="modal" class="btn skripsi btn-danger float-right mb-4"><span class="fa-solid fa-trash"></span></a>
<a href="{{url('/jadwalkan?download=true')}}" class="btn skripsi btn-success float-right mb-4" style="margin-right:10px;"><span class="fa-solid fa-download"></span></a>
<a href="{{url('/jadwalkan')}}" class="btn jadwalkan btn-success float-right mb-4" style="margin-right:10px;">JADWALKAN</a>
</a>
</div> -->

<div class="modal fade" id="ModalClear">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apakah Anda Yakin?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Semua Jadwal Akan Dihapus!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <form action="/clear" method="POST" class="d-inline">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-success">Yakin</button>
        </form>        
      </div>
    </div>
  </div>
</div>


@endif

<div class="container card p-4">

<ol class="breadcrumb col-lg-12">   
  {{-- <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/form">Jadwal</a></li>       
  <li class="breadcrumb-item"><a href="/riwayat-penjadwalan">Riwayat Penjadwalan</a></li> --}}
  
  <li><a href="/form" class="breadcrumb-item active fw-bold text-success px-1">Jadwal (<span>{{ $jml_seminar_kp + $jml_sempro + $jml_sidang }}</span>)</a></li>

  <span class="px-2">|</span>      
  <li><a href="/riwayat-penjadwalan" class="px-1">Riwayat Penjadwalan (<span>{{ $jml_riwayat_seminar_kp + $jml_riwayat_sempro + $jml_riwayat_sidang }}</span>)</a></li>
  

</ol>



<table class="table table-responsive-lg table-bordered table-striped" width="100%" id="datatables">
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
        @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)       
        <th class="text-center" scope="col">Aksi</th>
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
            {{-- <td class="text-center">
              @if($kp->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($kp->tanggal)->translatedFormat('l')}}
              </td>
              @endif --}}

            <td class="text-center">
            @if($kp->tanggal == null)
            <p> </p>
            @else
            {{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}
            </td>
            @endif

            <td class="text-center">{{$kp->waktu}}</td>                   
            <td class="text-center">{{$kp->lokasi}}</td>

            <td class="text-center">{{$kp->pembimbing->nama_singkat}}</td>
            @if($kp->penguji ==! null)
            <td class="text-center">{{$kp->penguji->nama_singkat}}</td> 
            @else
              <td class="text-center"></td> 
            @endif     

          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)       
          <td class="text-center">
            <a href="/form-kp/edit/{{Crypt::encryptString($kp->id)}}" class="badge bg-warning p-2"><i class="fas fa-pen"></i></a>            

          </td>
          @endif
        </tr>

    @endforeach    

    @foreach ($penjadwalan_sempros as $sempro)
        <tr>                 
            <td class="text-center">{{$sempro->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$sempro->mahasiswa->nama}}</td>                     
            <td class="bg-success text-center">{{$sempro->jenis_seminar}}</td>                     
            <td class="text-center">{{$sempro->prodi->nama_prodi}}</td>  
            {{-- <td class="text-center">
              @if($sempro->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($sempro->tanggal)->translatedFormat('l')}}
              </td>
              @endif  --}}
            <td class="text-center">
            @if($sempro->tanggal == null)
            <p> </p>
            @else
            {{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}}
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

            @if($sempro->pengujisatu ==! null || $sempro->pengujisatu ==! null || $sempro->pengujitiga ==! null)
                      <td class="text-center">
                        <p>1. {{$sempro->pengujisatu->nama_singkat}}</p>
                        @if ($sempro->pengujidua == !null)
                        <p>2. {{$sempro->pengujidua->nama_singkat}}</p>            
                        @endif
                        @if ($sempro->pengujitiga == !null)
                        <p>3. {{$sempro->pengujitiga->nama_singkat}}</p>                               
                        @endif
                      </td> 
            @else
                <td class="text-center"></td> 
            @endif 

            
         

          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
          <td class="text-center">            
            <a href="/form-sempro/edit/{{Crypt::encryptString($sempro->id)}}" class="badge bg-warning p-2"><i class="fas fa-pen"></i></a>
          </td>
          @endif                                
        </tr>
    @endforeach

    @foreach ($penjadwalan_skripsis as $skripsi)
        <tr>                   
            <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
            <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
            <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                                     
            <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>  
            {{-- <td class="text-center">
              @if($skripsi->tanggal == null)
              <p> </p>
              @else
              {{Carbon::parse($skripsi->tanggal)->translatedFormat('l')}}
              </td>
              @endif  --}}
            <td class="text-center">
            @if($skripsi->tanggal == null)
            <p> </p>
            @else
            {{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}
            </td>
            @endif           
            <td class="text-center">{{$skripsi->waktu}}</td>                   
            <td class="text-center">{{$skripsi->lokasi}}</td>                    
          <td class="text-center">
            <p>1. {{$skripsi->pembimbingsatu->nama_singkat}}</p>
            @if ($skripsi->pembimbingdua == !null)
            <p>2. {{$skripsi->pembimbingdua->nama_singkat}}</p>
            @endif
          </td> 

          @if($skripsi->pengujisatu ==! null || $skripsi->pengujisatu ==! null || $skripsi->pengujitiga ==! null)
                      <td class="text-center">
            <p>1. {{$skripsi->pengujisatu->nama_singkat}}</p>
            @if ($skripsi->pengujidua == !null)
            <p>2. {{$skripsi->pengujidua->nama_singkat}}</p>
            @endif
            @if ($skripsi->pengujitiga == !null)
            <p>3. {{$skripsi->pengujitiga->nama_singkat}}</p>
            @endif
          </td> 
            @else
                <td class="text-center"></td> 
            @endif 

          @if(auth()->user()->role_id == 2 || auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
          <td class="text-center">            
            <a href="/form-skripsi/edit/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-warning p-2"><i class="fas fa-pen"></i></a>
            
          </td>    
          @endif     
        </tr>
    @endforeach

  </tbody>
</table>
</div>
    
@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/fahril-hadi">Fahril Hadi, </a> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span class="text-success fw-bold">&</span> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M. Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jumlahJadwal = {!! json_encode($jml_seminar_kp + $jml_sempro + $jml_sidang) !!};
    const menungguJadwal = {!! json_encode($jml_menunggu_seminar_kp + $jml_menunggu_sempro + $jml_menunggu_sidang) !!};

    if (jumlahJadwal > 0) {
        Swal.fire({
            title: 'Ini adalah halaman Jadwal Seminar',
            html: `Ada <strong class="text-info"> ${menungguJadwal} Mahasiswa</strong> menunggu Jadwal seminar. <br> dan <strong class="text-info"> ${jumlahJadwal} Mahasiswa</strong> dijadwalkan seminar.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    } else {
        Swal.fire({
            title: 'Ini adalah halaman Jadwal Seminar',
            html: `Belum ada mahasiswa yang menunggu dan dijadwalkan seminar.`,
            icon: 'info',
            showConfirmButton: true,
            confirmButtonColor: '#28a745',
        });
    }
});
</script>
@endpush()