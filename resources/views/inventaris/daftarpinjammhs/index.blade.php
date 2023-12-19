@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    Kerja Praktek | SIA ELEKTRO
@endsection

@section('sub-title')
    Kerja Praktek
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif 

            <!-- Main content -->
            <div class="content">
              <div class="container">
              <a href="{{ route('formusulan') }}">  <button class="mb-4 w-85 btn btn-success rounded border" type="button">+ Usulan Peminjaman</button></a>

        <ol class="breadcrumb col-lg-12">
            <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="{{ route('peminjaman') }}">Daftar Pinjam ({{ $jumlah_pinjaman }})</a></li>    
            <li class="breadcrumb-item"><a href="{{ route('riwayatmhs') }}">Riwayat ({{ $jumlah_riwayat }})</a></li>  
        </ol>
        
        <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="datatables">
          <thead class="table-dark">
            <tr>
              <th class="text-center" scope="col">Barang</th>
              <th class="text-center" scope="col">Tujuan</th>
              <th class="text-center" scope="col">Ruangan</th>
              <th class="text-center" scope="col">Waktu Pinjam</th>
              <th class="text-center" scope="col">Waktu Kembali</th>
              <th class="text-center" scope="col">Jaminan</th>
              <th class="text-center" scope="col">Status</th>
              <th class="text-center" scope="col">Aksi</th>                        
            </tr>
          </thead>
          
          <tbody>
            @foreach ($pinjamans as $pinjaman)
            
            <tr>
          <td class="">
            @if($pinjaman->barang_satu)  1. {{ $pinjaman->barang_satu }} <br/> @endif
            @if($pinjaman->barang_dua)  2. {{ $pinjaman->barang_dua }} <br/> @endif
            @if($pinjaman->barang_tiga)  3. {{ $pinjaman->barang_tiga }} <br/> @endif
          </td>
          <td class="text-center">{{ $pinjaman->tujuan }}</td>                                                 
          <td class="text-center">{{ $pinjaman->ruangan }}</td>                              
          <td class="text-center">{{ $pinjaman->waktu_pinjam }} <br/>{{ $pinjaman->penerima }}</td>                   
          <td class="text-center">{{ $pinjaman->waktu_kembali }} <br/>{{ $pinjaman->pengembali }}</td> 
          <td class="text-center">{{ $pinjaman->jaminan }}</td>                
          @if($pinjaman->status == 'Ditolak')
            <td class="text-center bg-danger">{{ $pinjaman->status }}</td>
            @elseif($pinjaman->status == "Disetujui")
            <td class="text-center bg-success">{{ $pinjaman->status }}</td>
            @else
            <td class="text-center bg-warning">{{ $pinjaman->status }}</td>
            @endif
          <td class="text-center">
            @if($pinjaman->status == 'Usulan')

            <a href="{{ url('inventaris/edit/'.$pinjaman->id) }}" class="badge bg-warning border-0"><i><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/></svg>
            </i></a>
            <a href="{{ url('inventaris/delete/'.$pinjaman->id) }}" class="badge bg-danger border-0"><i><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
            </i></a>
            @endif
          </td>                    
                  
        </tr>
            @endforeach
                   
  </tbody>
        </table>
            
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
        
      
          
        </div>
        <!-- ./wrapper -->
        
        <!-- REQUIRED SCRIPTS -->
@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="#">( Ahmad Fajri )</a></p>
        </div>
</section>
@endsection

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