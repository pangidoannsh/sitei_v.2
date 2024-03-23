@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    Absensi | SIA ELEKTRO
@endsection

@section('sub-title')
    Absensi Perkuliahan
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif

<div class="container card p-4">

  <ol class="breadcrumb col-lg-12">
 
      <li><a href="/absensi" class="px-1 fw-bold text-success">Absensi ({{ $jumlah_abseni }})</a></li> 
      <span class="px-2">|</span>
      <li><a href="{{ route('riwayat-absensi') }}" class="breadcrumb-item  px-1">Riwayat ()</a></li>
      <span class="px-2">|</span>
      <li><a href="{{ route('ruangan-absensi') }}" class="breadcrumb-item  px-1">Ruangan ()</a></li>          
        
</ol>
<!-- Desktop Version -->
            <div class="d-none d-md-flex justify-content-between mb-3 filter">
                <div class="d-flex align-items-center">
                    <div class="dataTables_length input-group" style="width: max-content;">
                        <label class="pt-2 pr-2" for="lengthMenuRiwayatSemester">Tampilkan</label>
                        <select id="lengthMenuRiwayatSemester" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                        </select>
                    </div>
                </div>
                
                <div class="dataTables_filter input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterSemesterRiwayatProdi">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterSemesterRiwayatProdi" placeholder="">
                </div>
            </div>
<table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatablesAbsensi">
  <thead class="table-dark">
    <tr>
      <th class="text-center" scope="col">#</th>      
      <th class="text-center" scope="col">Kode</th>
      <th class="text-center" scope="col">Mata Kuliah</th>
      <th class="text-center" scope="col">Kelas</th>
      <th class="text-center" scope="col">SKS</th>  
      <th class="text-center" scope="col">Semester</th>         
      <th class="text-center" scope="col">Dosen</th>
      <th class="text-center" scope="col">Dosen</th>
      <th class="text-center" scope="col">Hari</th>
      <th class="text-center" scope="col">Waktu</th>
      <th class="text-center" scope="col">Ruangan</th>
      <th class="text-center" scope="col">Kuota</th>
      <th class="text-center" scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($absensi as $abs)
        <tr>
          <td>{{$loop->iteration}}</td>          
          <td>{{$abs->kode_mk}}</td>
          <td>{{$abs->mk}}</td>
          @if ($abs->kelas == !null)
          <td>{{$abs->kelas->nama_kelas}}</td>
          @endif
          <td>{{$abs->sks}}</td>
          @if ($abs->semester == !null)       
          <td>{{$abs->semester->semester}} {{$abs->semester->tahun_ajaran}}</td> 
          @endif                    
          @if ($abs->dosenmatkul == !null)          
          <td>{{$abs->dosenmatkul->nama_singkat}}</td>
          @endif     
          @if ($abs->dosenmatkul2 !== 0 && $abs->dosenmatkul2)
              <td>{{ $abs->dosenmatkul2->nama_singkat }}</td>
          @else
              <td>-</td>
          @endif               
          <td>{{$abs->hari}}</td>          
          <td>{{$abs->jam}}</td>   
          <td>{{$abs->ruangan->nama_ruangan}}</td> 
          <td>{{$abs->kuota}}</td>          
          <td class="text-start" style='white-space: nowrap'>  
            @if ($nextPertemuans[$abs->id] == 'Masuk')
          <a href="{{ route('showQrCode', ['id' => session('idPerkuliahan')]) }}" class="badge bg-info border-0 text-center" style="border-radius:20px; padding:7px;">
              Masuk
          </a>
          @elseif ($nextPertemuans[$abs->id] )
          {{ $abs->nomor_pertemuan }} <!-- Perbaikan disini -->
          <button type="button" class="badge bg-primary border-0 text-center openAbsensiModal" style="border-radius:20px; padding:7px;" data-toggle="modal" data-target="#openAbsensiModal{{$abs->id}}" data-iteration="{{ $loop->iteration }}">
              Mulai
          </button>
           @else
           {{ $abs->nomor_pertemuan }} 
              <button type="button" class="badge bg-primary border-0 text-center openAbsensiModal" style="border-radius:20px; padding:7px;" data-toggle="modal" data-target="#openAbsensiModal{{$abs->id}}" data-iteration="{{ $loop->iteration }}">
                  Mulai
              </button>
          @endif
          <a href="{{ route('detail.statistik', ['matakuliah_id' => $abs->id]) }}" class="badge bg-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle" aria-hidden="true"></i></a>
          <a href="{{ route('download_pdf', ['matakuliah_id' => $abs->id])}}" class="badge bg-success p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-download" aria-hidden="true"></i></a>
            {{-- <a href="{{ route('detail_absensi')}}" class="badge btn btn-secondary p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle" aria-hidden="true"></i></a>    --}}
            <!-- Modal -->
            <div class="modal fade" id="openAbsensiModal{{$abs->id}}" tabindex="-1" role="dialog" aria-labelledby="openAbsensiModalLabel{{$abs->id}}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="openAbsensiModalLabel{{$abs->id}}">Mulai Perkuliahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Form untuk membuka kelas -->
                    <form action="{{route('buka_kelas')}}" method="POST">
                      @csrf
                      <input type="hidden" name="mata_kuliah_id" value="{{ $abs->id }}">
                <input type="hidden" name="next_pertemuan" value="{{$nextPertemuans[$abs->id]}}"> <!-- Gunakan nilai next_pertemuan dari $nextPertemuans -->
                      <div class="form-group">
                        <label for="pertemuan">Pertemuan</label>
                        <input type="text" class="form-control" id="pertemuan" name="pertemuan" value="{{ $nextPertemuans[$abs->id] }}" readonly>
                      </div>
                      
                      <div class="form-group">
                        <label for="materi">Materi</label>
                        <textarea class="form-control" id="materi" name="materi" required></textarea>
                      </div>

                      <div class="form-group">
                        <label for="jenis_perkuliahan">Jenis Perkuliahan</label>
                        <select class="form-control" id="jenis_perkuliahan" name="jenis_perkuliahan">
                          <option value="Offline">Offline</option>
                          <option value="Online">Online</option>
                        </select>
                      </div>
                      
                      <button type="submit" class="btn btn-primary" >Buka Kelas</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>

<br>
<br>
<br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                        class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                        target="_blank" href="/developer/ahmad-fajri">Imperia Prestise Sinaga </a>)
        </div>
    </section>
@endsection

@push('scripts')
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);

  $(document).ready(function() {
    // Fungsi untuk menghitung jumlah baris tabel dan memperbarui elemen absensiCount
    function updateAbsensiCount() {
      // Menghitung jumlah baris dalam tabel dengan ID datatablesAbsensi
      var rowCount = $('#datatablesAbsensi tbody tr').length;
      
      // Memperbarui nilai pada elemen dengan ID 'absensiCount'
      $('#absensiCount').text(rowCount);
    }

    // Panggil fungsi updateAbsensiCount saat halaman dimuat sepenuhnya
    updateAbsensiCount();
  });
</script>
@endpush()

@push('scripts')
<script>
  $(document).ready(function() {
    // Fungsi untuk menambah nilai pertemuan di form modal
    function updatePertemuanValue(modal) {
      modal.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button yang memicu modal
        var nextPertemuan = button.data('nomor-pertemuan'); // Dapatkan nilai nomor pertemuan berikutnya
        $(this).find('.modal-body #pertemuan').val(nextPertemuan); // Perbarui nilai input pertemuan di dalam modal
      });
    }

    // Panggil fungsi untuk setiap modal yang memiliki class openAbsensiModal
    $('.openAbsensiModal').each(function() {
      updatePertemuanValue($(this));
    });
  });
</script>
@endpush
