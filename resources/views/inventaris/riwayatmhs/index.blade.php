@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Riwayat Peminjaman Mahasiswa
@endsection

@section('sub-title')
    Riwayat Peminjaman Mahasiswa
@endsection

@section('content')

    <!-- Main content -->
    <div class="content">
      <div class="container">
        

<ol class="breadcrumb col-lg-12">
  <li class="breadcrumb-item"><a class="breadcrumb-item" href="{{ route('peminjaman') }}">Daftar Pinjam ({{ $jumlah_pinjaman }})</a></li>    
  <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="{{ route('riwayatmhs') }}">Riwayat ({{ $jumlah_riwayat }})</a></li>  
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
            <td class="text-center">{{ $pinjaman->waktu_pinjam }} </br>{{ $pinjaman->penerima }}</td>                   
            <td class="text-center">{{ $pinjaman->waktu_kembali }} </br>{{ $pinjaman->pengembali }}</td> 
            <td class="text-center">{{ $pinjaman->jaminan }}</td>
            @if($pinjaman->status == "Ditolak")                
            <td class="text-center bg-danger">{{ $pinjaman->status }}</td>
            @else
            <td class="text-center bg-primary">{{ $pinjaman->status }}</td>
            @endif    
        </tr>
        @endforeach
      </tbody>
    </table>
    
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@endsection