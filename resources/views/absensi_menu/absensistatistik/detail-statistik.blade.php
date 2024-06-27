@extends('absensi_menu.main')

@section('title')
    Daftar Perkuliahan | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Perkuliahan
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif
    <div>
        @if (Auth::user()->role_id == 2 ||
                Auth::user()->role_id == 3 ||
                Auth::user()->role_id == 4 ||
                Auth::user()->role_id == 6 ||
                Auth::user()->role_id == 7 ||
                Auth::user()->role_id == 8)
            <button class="mb-4 w-85 btn btn-primary rounded border" type="button"
                onclick="window.location.href='{{ route('rekapitulasi.pdf', $matakuliah_id) }}'">Rekapitulasi Perkuliahan <i
                    class="fa-solid fa-download" aria-hidden="true"></i></button>
        @else
        @endif
        <div class="container card p-4">
            <div class="row absensi mb-2">
                <div class="col-6 pl-2">
                    <h6><span>Mata Kuliah</span> {{ $attendances->first()->mata_kuliah ?? '-' }}</h6>
                    <h6><span>Dosen</span> {{ $attendances->first()->nama_dosen ?? '-' }}</h6>
                    <h6><span>Semester</span> {{ $attendances->first()->class->semester->semester ?? '-' }}
                        {{ $attendances->first()->class->semester->tahun_ajaran ?? '-' }}</h6>
                </div>
                <div class="col-6 ">
                    <h6><span>Program Studi</span> {{ $attendances->first()->class->prodi->nama_prodi ?? '-' }}</h6>
                    <h6><span>SKS</span> {{ $attendances->first()->class->sks ?? '-' }} SKS</h6>
                    <h6><span>Kelas</span> {{ $attendances->first()->class->kelas->nama_kelas ?? '-' }}</h6>
                </div>
            </div>

            <hr />

            <div class="d-none d-md-flex justify-content-between mb-3 filter">
                <div class="d-flex align-items-center">
                    <div class="dataTables_length input-group" style="width: max-content;">
                        <label class="pt-2 pr-2" for="lengthMenuRiwayatSemester">Tampilkan</label>
                        <select id="lengthMenuRiwayatSemester" class="custom-select custom-select-md rounded-3 py-1"
                            style="width: 55px;">
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
                    <input type="search" class="form-control form-control-md rounded-3 py-1"
                        id="searchFilterSemesterRiwayatProdi" placeholder="">
                </div>
            </div>
            <!-- Tablet & Mobile Version -->
            <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuMobileMatakuliahProdi">Tampilkan</label>
                    <select id="lengthMenuMobileMatakuliahProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
                <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="searchFilterSemesterRiwayatMobile">Cari</label>
                    <input type="search" class="form-control form-control-md rounded-3 py-1" style="width: 83px; id="searchFilterSemesterRiwayatMobile" placeholder="">
                </div>
            </div>
            <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%"
                id="datatablesDetailAbsensi">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">Pertemuan ke-</th>
                        <th class="text-center" scope="col">Jadwal</th>
                        <th class="text-center" scope="col">Jam Mulai</th>
                        <th class="text-center" scope="col">Jam Selesai</th>
                        <th class="text-center" scope="col">Durasi Perkuliahan</th>
                        <th class="text-center" scope="col">Ruangan</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Materi (Aktual)</th>
                        <th class="text-center" scope="col">Materi (RPS)</th>
                        <th class="text-center" scope="col">Aksi</th>
                        @if (Auth::user()->role_id == 2 ||
                                Auth::user()->role_id == 3 ||
                                Auth::user()->role_id == 4 ||
                                Auth::user()->role_id == 6 ||
                                Auth::user()->role_id == 7 ||
                                Auth::user()->role_id == 8)
                            <th class="text-center" scope="col">Kesesuaian Materi</th>
                        @else
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedAttendances as $perkuliahanId => $attendances)
                        @php
                            $firstAttendance = $attendances->first();
                            $kesesuaian = $firstAttendance->perkuliahan->rekapitulasiRps->kesesuaian ?? null;

                            // Get the actual day and the scheduled day
                            $jadwalDay = \Carbon\Carbon::parse($firstAttendance->perkuliahan->created_at)->locale('id')
                                ->dayName;
                            $scheduledDay = $attendances->first()->class->hari ?? '-';

                            // Compare days
                            $scheduleStatus =
                                $scheduledDay === $jadwalDay
                                    ? 'Sesuai Jadwal'
                                    : '<span class="text-danger">(Tidak Sesuai Jadwal)</span>';
                            // Compare start time
                            $scheduledTimeString = $attendances->first()->class->jam ?? '-';
                            $scheduledTime = \Carbon\Carbon::createFromFormat('H:i', $scheduledTimeString);

                            // Extract time part from created_at
                            $actualStartTime = \Carbon\Carbon::parse($firstAttendance->perkuliahan->created_at)->format(
                                'H:i',
                            );
                            $actualStartTime = \Carbon\Carbon::createFromFormat('H:i', $actualStartTime);

                            // Calculate the difference in minutes
                            $differenceInMinutes = $scheduledTime->diffInMinutes($actualStartTime);

                            // Check if actual start time is within 15 minutes of the scheduled time
                            if ($actualStartTime->lessThanOrEqualTo($scheduledTime->copy()->addMinutes(15))) {
                                $timeStatus = '<span class="text-success">(Tepat Waktu)</span>';
                            } else {
                                $timeStatus =
                                    '<span class="text-danger">(Terlambat ' .
                                    ($differenceInMinutes - 15) .
                                    ' menit)</span>';
                            }
                        @endphp
                        <tr>
                            <td>{{ $firstAttendance->perkuliahan->nomor_pertemuan }}</td>
                            <td>{{ \Carbon\Carbon::parse($firstAttendance->perkuliahan->created_at)->isoFormat('dddd, D MMMM YYYY') }}
                                {!! $scheduleStatus !!}</td>
                            <td>{{ \Carbon\Carbon::parse($firstAttendance->perkuliahan->created_at)->format('H:i:s') }}
                                {!! $timeStatus !!} </td>
                            <td>{{ \Carbon\Carbon::parse($firstAttendance->perkuliahan->updated_at)->format('H:i:s') }}
                            </td>
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
                                    // Calculate required duration in seconds
                                    $requiredDuration = $firstAttendance->class->sks * 50 * 60;
                                    $isDurationMet = $durasiPerkuliahan >= $requiredDuration;

                                    // Calculate the difference for unmet duration
                                    $unmetDurationSeconds = $requiredDuration - $durasiPerkuliahan;
                                    $unmetHours = floor($unmetDurationSeconds / 3600);
                                    $unmetMinutes = floor(($unmetDurationSeconds % 3600) / 60);
                                    $unmetSeconds = $unmetDurationSeconds % 60;

                                    $unmetDurationFormatted = sprintf(
                                        '%02d:%02d:%02d',
                                        $unmetHours,
                                        $unmetMinutes,
                                        $unmetSeconds,
                                    );
                                @endphp
                                {{ $durasiFormatted }} (@if ($isDurationMet)
                                    <span class="text-success">Terpenuhi</span>
                                @else
                                    <span class="text-danger">Tidak Terpenuhi (-{{ $unmetDurationFormatted }})</span>
                                @endif)
                            </td>
                            <td>{{ $firstAttendance->class->ruangan->nama_ruangan }}</td>
                            <td>{{ $firstAttendance->perkuliahan->status }}</td>
                            <td>{{ $firstAttendance->perkuliahan->materi }}</td>
                            <td>
                                {{ $firstAttendance->class->{'rps_pertemuan_' . $loop->iteration} ?? '-' }}
                            </td>
                            <td class=" text-center">
                                <a href="{{ route('daftarhadir', ['perkuliahan_id' => $perkuliahanId]) }}"
                                    class="badge bg-info p-1 mb-1" data-bs-toggle="tooltip" title="Lihat Detail"><i
                                        class="fas fa-info-circle" aria-hidden="true"></i></a>
                            </td>
                            @if (Auth::user()->role_id == 2 ||
                                    Auth::user()->role_id == 3 ||
                                    Auth::user()->role_id == 4 ||
                                    Auth::user()->role_id == 6 ||
                                    Auth::user()->role_id == 7 ||
                                    Auth::user()->role_id == 8)
                                <td class="text-center">
                                    @if ($kesesuaian)
                                        {{ $kesesuaian }}
                                    @else
                                        <a href="#" class="badge bg-success p-1 mb-1 update-kesesuaian"
                                            data-id="{{ $firstAttendance->perkuliahan->id }}" data-kesesuaian="Sesuai"
                                            data-bs-toggle="tooltip" title="Sesuai">
                                            <i class="fa-solid fa-check" aria-hidden="true"></i>
                                        </a>
                                        <a href="#" class="badge bg-danger p-1 mb-1 update-kesesuaian"
                                            data-id="{{ $firstAttendance->perkuliahan->id }}"
                                            data-kesesuaian="Tidak Sesuai" data-bs-toggle="tooltip" title="Tidak Sesuai">
                                            <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </td>
                            @else
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                        target="_blank" href="/developer/imperia">Imperia Prestise Sinaga </a>)
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);

        $(document).on('click', '.update-kesesuaian', function(e) {
            e.preventDefault();
            var perkuliahanId = $(this).data('id');
            var kesesuaian = $(this).data('kesesuaian');
            var kesesuaianCell = $(this).closest('td');

            $.ajax({
                url: '{{ route('update.kesesuaian') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    perkuliahan_id: perkuliahanId,
                    kesesuaian: kesesuaian
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // Update the cell content with the new status
                    kesesuaianCell.html(kesesuaian);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' ' + error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating data. Please try again.',
                    });
                }
            });
        });
    </script>
@endpush
