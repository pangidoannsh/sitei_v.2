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

@if (session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('loginError')}}        
      </div>
@endif
<div class="container card  p-4">


<ol class="breadcrumb col-lg-12">
@if (Str::length(Auth::guard('dosen')->user()) > 0)
        @if (Auth::guard('dosen')->user()->role_id == 5 || Auth::guard('dosen')->user()->role_id == 6 || Auth::guard('dosen')->user()->role_id == 7 || Auth::guard('dosen')->user()->role_id == 8 || Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
  <li><a href="/kp-skripsi/seminar" class="breadcrumb-item active fw-bold text-success px-1">Seminar  (<span id=""></span>) </a></li>

        <span class="px-2">|</span>
        <li><a href="/kerja-praktek" class="px-1">Kerja Praktek (<span id=""></span>)</a></li>
        
        <span class="px-2">|</span>
        <li><a href="/skripsi" class="px-1">Skripsi (<span id=""></span>)</a></li>


        <span class="px-2">|</span>
        <li><a href="/kp-skripsi/prodi/riwayat" class="px-1">Riwayat (<span id=""></span>)</a></li>
        
        @endif
  @endif


</ol>

<table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
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
     <th class="text-center"scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody> 
    
    @foreach ($penjadwalan_kps as $kp)    
      <tr>                 
        <td class="text-center">{{$kp->mahasiswa->nim}}</td>                             
        <td class="text-center">{{$kp->mahasiswa->nama}}</td>                    
        <td class="bg-primary text-center">{{$kp->jenis_seminar}}</td>                     
        <td class="text-center">{{$kp->prodi->nama_prodi}}</td>          
        <td class="text-center">{{Carbon::parse($kp->tanggal)->translatedFormat('l, d F Y')}}</td>                   
        <td class="text-center">{{$kp->waktu}}</td>                   
        <td class="text-center">{{$kp->lokasi}}</td>             
        <td class="text-center">
          <p>{{$kp->pembimbing->nama_singkat}}</p>           
        </td>         
        <td class="text-center">
          <p>{{$kp->penguji->nama_singkat}}</p>           
        </td>
        {{-- <td class="text-center">
          @if ($kp->penilaian(Auth::user()->nip, $kp->id) == false)
            @if (Carbon::now() >= $kp->tanggal && Carbon::now()->format('H:i:m') >= $kp->waktu)
            <a href="/penilaian-kp/create/{{Crypt::encryptString($kp->id)}}" class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>          
            @else
            <span class="badge bg-danger" style="border-radius:20px; padding:7px;">Belum Dimulai</span>
         @if (Str::length(Auth::guard('dosen')->user()) > 0)
        @if (Auth::guard('dosen')->user()->role_id == 9 || Auth::guard('dosen')->user()->role_id == 10 || Auth::guard('dosen')->user()->role_id == 11 )
               <a href="/form-kp/edit/{{Crypt::encryptString($kp->id)}}" class="badge bg-warning mt-2" style="border-radius:20px; padding:7px;">Edit Jadwal</a>
              @endif
              @endif

            @endif
          @else
            <a href="/penilaian-kp/edit/{{Crypt::encryptString($kp->id)}}" class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>              
          @endif      
          
          
        </td>                                 --}}
      </tr>               
    @endforeach


     @foreach ($penjadwalan_sempros as $sempro)
     @if($sempro->pengujisatu ==! null)    
        <tr>                  
          <td class="text-center">{{$sempro->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$sempro->mahasiswa->nama}}</td>                     
          <td class="bg-success text-center">{{$sempro->jenis_seminar}}</td>                     
          <td class="text-center">{{$sempro->prodi->nama_prodi}}</td>
           @if ($sempro->tanggal == !null)         
          <td class="text-center">{{Carbon::parse($sempro->tanggal)->translatedFormat('l, d F Y')}}</td>
          @else    
          <td class="text-center"></td>    
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
                      
          <td class="text-center">
            @if ($sempro->penilaian(Auth::user()->nip, $sempro->id) == false)
              @if (Carbon::now() >= $sempro->tanggal && Carbon::now()->format('H:i:m') >= $sempro->waktu)
              <a href="/penilaian-sempro/create/{{Crypt::encryptString($sempro->id)}}" class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>          
              @else
              <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum Dimulai</span>
              @endif
            @else
              <a href="/penilaian-sempro/edit/{{Crypt::encryptString($sempro->id)}}" class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>              
            @endif              
          </td>                        
        </tr>
        @endif               
    @endforeach

    @foreach ($penjadwalan_skripsis as $skripsi)
    @if($skripsi->lokasi ==! null)    
        <tr>               
          <td class="text-center">{{$skripsi->mahasiswa->nim}}</td>                             
          <td class="text-center">{{$skripsi->mahasiswa->nama}}</td>
          <td class="bg-warning text-center">{{$skripsi->jenis_seminar}}</td>                                     
          <td class="text-center">{{$skripsi->prodi->nama_prodi}}</td>          
          <td class="text-center">{{Carbon::parse($skripsi->tanggal)->translatedFormat('l, d F Y')}}</td>                   
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
                             
          <td class="text-center">
            @if ($skripsi->penilaian(Auth::user()->nip, $skripsi->id) == false)
              @if (Carbon::now() >= $skripsi->tanggal && Carbon::now()->format('H:i:m') >= $skripsi->waktu)
              <a href="/penilaian-skripsi/create/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-primary"style="border-radius:20px; padding:7px;"> Input Nilai<a>          
              @else
              <span class="badge bg-danger"style="border-radius:20px; padding:7px;">Belum Dimulai</span>

              @endif
            @else
              <a href="/penilaian-skripsi/edit/{{Crypt::encryptString($skripsi->id)}}" class="badge bg-warning" style="border-radius:20px; padding:7px;"> Edit Nilai<a>              
            @endif    
            
            
          </td>                        
        </tr>               
        @endif    
    @endforeach

   

  </tbody>
</table>
</div>
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


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const waitingApprovalCount = {!! json_encode($penjadwalan_kps->count()) !!};
    const waitingApprovalElement = document.getElementById('waitingApprovalCount');
    if (waitingApprovalCount > 0) {
      waitingApprovalElement.innerText = waitingApprovalCount;
        Swal.fire({
            title: 'Ini adalah halaman Jadwal Seminar Kerja Paktek',
            html: `Ada <strong class="text-info"> ${waitingApprovalCount} Mahasiswa</strong> dijadwalkan Seminar.`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    } else {
      waitingApprovalElement.innerText = '0';
        Swal.fire({
            title: 'Ini adalah halaman Jadwal Seminar Kerja Paktek',
            html: `Tidak ada mahasiswa dijadwalkan Seminar.`,
            icon: 'info',
            showConfirmButton: false,
            timer: 5000,
        });
    }
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const persetujuanKPCount = {!! json_encode($jml_persetujuankp->count()) !!};
    const persetujuanKPElement = document.getElementById('persetujuanKPCount');
       persetujuanKPElement.innerText = persetujuanKPCount;
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const prodiKPCount = {!! json_encode($jml_prodikp->count()) !!};
    const prodiKPElement = document.getElementById('prodiKPCount');
       prodiKPElement.innerText = prodiKPCount;
});
</script>
@endpush()

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bimbinganKPCount = {!! json_encode($jml_bimbingankp->count()) !!};
    const bimbinganKPElement = document.getElementById('bimbinganKPCount');
       bimbinganKPElement.innerText = bimbinganKPCount;
});
</script>
@endpush()