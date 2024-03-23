@extends('layouts.main')

@section('title')
    Daftar Perkuliahan | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Perkuliahan
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
            </div>
            <div class="col-6 ">
                <h6><span>Program Studi</span> {{ $attendances->first()->class->prodi->nama_prodi ?? '-' }}</h6>
                <h6><span>SKS</span> {{ $attendances->first()->class->sks ?? '-' }} SKS</h6>
                <h6><span>Kelas</span> {{ $attendances->first()->class->kelas->nama_kelas ?? '-' }}</h6>
            </div>
        </div>

        {{-- <div class="row absensi mb-3">
            <div class="col-6 pl-2">
            <a href="{{ route('download_pdf', ['matakuliah_id' => $matakuliah_id])}}" class="btn skripsi btn-success"><span class="fa-solid fa-download" aria-hidden="true"></span> Download PDF</a>
            </div>
        </div> --}}
        <hr/>

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
                    <th class="text-center" scope="col">Pertemuan ke-</th>      
                    <th class="text-center" scope="col">Hari</th>
                    <th class="text-center" scope="col">Jam Mulai</th>
                    <th class="text-center" scope="col">Jam Selesai</th>
                    <th class="text-center" scope="col">Durasi Perkuliahan</th>
                    <th class="text-center" scope="col">Ruangan</th>
                    <th class="text-center" scope="col">Status</th>
                    <th class="text-center" scope="col">Materi (Aktual)</th>
                    <th class="text-center" scope="col">Materi (RPS)</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groupedAttendances as $perkuliahanId => $attendances)
                    @php
                        $firstAttendance = $attendances->first();
                    @endphp
                    <tr>
                        <td>{{ $firstAttendance->perkuliahan->nomor_pertemuan }}</td>
                        <td>{{ \Carbon\Carbon::parse($firstAttendance->perkuliahan->created_at)->isoFormat('dddd, D MMMM YYYY') }}</td>
                        <td>{{ \Carbon\Carbon::parse($firstAttendance->perkuliahan->created_at)->format('H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($firstAttendance->perkuliahan->updated_at)->format('H:i:s') }}</td>
                        <td>
                            @php
                                $waktuMulai = \Carbon\Carbon::parse($firstAttendance->perkuliahan->created_at);
                                $waktuSelesai = \Carbon\Carbon::parse($firstAttendance->perkuliahan->updated_at);
                                $durasiPerkuliahan = $waktuSelesai->diffInSeconds($waktuMulai);
                                $jam = floor($durasiPerkuliahan / 3600);
                                $menit = floor(($durasiPerkuliahan % 3600) / 60);
                                $detik = $durasiPerkuliahan % 60;

                                // Format durasi sesuai kebutuhan
                                $durasiFormatted = sprintf('%02d:%02d:%02d', $jam, $menit, $detik);
                            @endphp
                            {{ $durasiFormatted }}
                        </td>
                        <td>{{ $firstAttendance->class->ruangan->nama_ruangan }}</td>
                        <td>{{ $firstAttendance->perkuliahan->status }}</td>
                        <td>{{ $firstAttendance->perkuliahan->materi }}</td>
                        <td>
                            {{ $firstAttendance->class->{"rps_pertemuan_" . $loop->iteration} ?? '-' }}
                        </td>
                        <td class=" text-center">        
                            <a href="{{ route('daftarhadir', ['perkuliahan_id' => $perkuliahanId]) }}" class="badge bg-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle" aria-hidden="true"></i></a>
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
</script>
@endpush