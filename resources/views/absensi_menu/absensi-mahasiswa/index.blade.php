@extends('layouts.main')

@section('title')
    Absensi Perkuliahan | SIA ELEKTRO
@endsection

@section('sub-title')
    Absensi Perkuliahan
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif
<div>
    <div class="container card p-4">
        <ol class="breadcrumb col-lg-12">
            <li><a href="/absensimahasiswa" class="px-1 fw-bold text-success">Absensi (<span id="absensiCount"></span>)</a></li> 
            <span class="px-2">|</span>
            <li><a href="{{ route('riwayatabsensi') }}" class="breadcrumb-item  px-1">Riwayat Absensi (<span id=""></span>)</a></li>   
            
        </ol>
<table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>      
                    <th class="text-center" scope="col">MK</th>
                    <th class="text-center" scope="col">Kelas</th>
                    <th class="text-center" scope="col">SKS</th>
                    <th class="text-center" scope="col">Semester</th>      
                    <th class="text-center" scope="col">Dosen</th>
                    <th class="text-center" scope="col">Hari</th>
                    <th class="text-center" scope="col">Ruangan</th>
                    <th class="text-center" scope="col">Pertemuan Terakhir</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
        @foreach($riwayatAbsensiGroupedFinal as  $absensi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $absensi->mata_kuliah }}</td>
                <td>{{ $absensi->class->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $absensi->class->sks ?? '-'}}</td>
                <td>{{ $absensi->class->semester->semester ?? '-' }}</td>
                <td>{{ $absensi->class->dosenmatkul->nama_singkat ?? '-' }}</td>
                <td>{{ $absensi->class->hari ?? '-'}}</td>
                <td>{{ $absensi->class->abruangan->nama_ruangan ?? '-' }}</td>
                <td>{{ $absensi->perkuliahan->nomor_pertemuan ?? '-' }}</td>
                <td>                
                    <a href="{{ route('detailabsensi',  ['class_id' => $absensi->class->id]) }}" class="badge btn btn-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle" aria-hidden="true"></i></a>
                </td>
            </tr>
    @endforeach
</tbody>

        </table>
    </div>
    
</div>
@endsection

@push('scripts')
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);

  $(document).ready(function() {
        // Menghitung jumlah baris dalam tabel
        var rowCount = $('#datatables tbody tr').length;
        
        // Memperbarui nilai pada elemen dengan id 'mataKuliahCount'
        $('#absensiCount').text(rowCount);
    });
</script>
@endpush