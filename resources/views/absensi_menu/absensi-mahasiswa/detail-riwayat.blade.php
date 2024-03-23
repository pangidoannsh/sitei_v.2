@extends('layouts.main')

@section('title')
    Absensi Perkuliahan | SIA ELEKTRO
@endsection

@section('sub-title')
    Detail Absensi Perkuliahan
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif
<div>

    <div class="container card p-4">
        <div class="row absensi mt-4 mb-2">
            <div class="col-6 pl-2">
                <h6><span>Mata Kuliah</span> {{ $detailabsensimahasiswa->first()->mata_kuliah ?? '-' }}</h6>
                <h6><span>Dosen</span> {{ $detailabsensimahasiswa->first()->nama_dosen ?? '-' }}</h6>
                <h6><span>Semester</span> {{ $detailabsensimahasiswa->first()->class->semester->semester ?? '-' }} {{ $detailabsensimahasiswa->first()->class->semester->tahun_ajaran ?? '-' }}</h6>
            </div>
            <div class="col-6 ">
                <h6><span>Program Studi</span> {{ $detailabsensimahasiswa->first()->class->prodi->nama_prodi ?? '-' }}</h6>
                <h6><span>SKS</span> {{ $detailabsensimahasiswa->first()->class->sks ?? '-' }} SKS</h6>
                <h6><span>Kelas</span> {{ $detailabsensimahasiswa->first()->class->kelas->nama_kelas ?? '-' }}</h6>
            </div>
          </div>

        <hr/>
        <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">Pertemuan ke-</th>      
                    <th class="text-center" scope="col">Tanggal Absensi</th>
                    <th class="text-center" scope="col">Waktu Absensi</th>
                    <th class="text-center" scope="col">Ruangan</th>
                    <th class="text-center" scope="col">Materi</th>
                    <th class="text-center" scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailabsensimahasiswa as $index => $absensi)
            <tr>
                <td>{{ $absensi->perkuliahan->nomor_pertemuan ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($absensi->attended_at)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($absensi->attended_at)->format('H:i:s') }}</td>
                <td>{{ $absensi->class->abruangan->nama_ruangan ?? '-' }}</td>
                <td>{{ $absensi->perkuliahan->materi ?? '-' }}</td>
                <td class="@if($absensi->keterangan === 'Sakit') bg-danger text-white @elseif($absensi->keterangan === 'Izin') bg-warning text-dark @elseif($absensi->keterangan === 'Hadir') bg-info text-white @else bg-secondary text-dark @endif"">{{ $absensi->keterangan }}</td>
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
</script>
@endpush