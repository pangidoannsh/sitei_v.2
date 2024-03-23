@extends('layouts.main')

@section('title')
    Daftar Presensi | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Presensi Mahasiswa
@endsection

@section('content')

@if (session()->has('message'))
<div class="swal" data-swal="{{session('message')}}"></div>
@endif
<div>

    <div class="container card p-4">
        <div class="row absensi mb-2">
            <div class="col-6 pl-2">
                <h6><span>Mata Kuliah</span> {{ $attendances->first()->mata_kuliah ?? '-' }}</h6>
                <h6><span>Dosen</span> {{ $attendances->first()->nama_dosen ?? '-' }}</h6>
                <h6><span>Semester</span>  {{$attendances->first()->class->semester->semester ?? '-'}} {{$attendances->first()->class->semester->tahun_ajaran ?? '-'}}</h6>
                <h6><span>Hari</span> {{$attendances->first()->class->hari ?? '-'}} </h6>
                <h6><span>Tanggal</span> {{\Carbon\Carbon::parse($attendances->first()->perkuliahan->created_at)->format('d-m-Y')}}</h6>
            </div>
            <div class="col-6 ">
                <h6><span>Program Studi</span> {{ $attendances->first()->class->prodi->nama_prodi ?? '-' }}</h6>
                <h6><span>SKS</span> {{ $attendances->first()->class->sks ?? '-' }} SKS</h6>
                <h6><span>Kelas</span> {{ $attendances->first()->class->kelas->nama_kelas ?? '-' }}</h6>
                <h6><span>Pertemuan ke</span>  {{$attendances->first()->perkuliahan->nomor_pertemuan ?? '-'}}</h6>
                <h6><span>Materi</span>  {{$attendances->first()->perkuliahan->materi ?? '-'}}</h6>                
            </div>
        </div>

        {{-- <div class="row absensi mb-3">
            <div class="col-6 pl-2">
            <a href="" class="btn skripsi btn-success"><span class="fa-solid fa-download" aria-hidden="true"></span> Download PDF</a>
            </div>
        </div> --}}

        <hr/>
        <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>      
                    <th class="text-center" scope="col">NIM</th>
                    <th class="text-center" scope="col">Nama</th>
                    <th class="text-center" scope="col">Jam Hadir</th>
                    <th class="text-center" scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $daftar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $daftar->student->nim }}</td>
                        <td>{{ $daftar->student->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($daftar->attended_at)->format('H:i:s') }}</td>
                        <td class="@if($daftar->keterangan === 'Sakit') bg-danger text-white @elseif($daftar->keterangan === 'Izin') bg-warning text-dark @elseif($daftar->keterangan === 'Hadir') bg-info text-white @else bg-secondary text-dark @endif"">{{ $daftar->keterangan }}</td>
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