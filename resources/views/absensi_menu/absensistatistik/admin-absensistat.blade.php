@extends('absensi_menu.main')

@section('title')
    Statistik Perkuliahan | SIA ELEKTRO
@endsection

@section('sub-title')
    Statistik Perkuliahan
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif
    <div>
        <div class="container card p-4">
            <ol class="breadcrumb col-lg-12">
                <li><a href="{{ route('absensistatistikadmin') }}" class="px-1 fw-bold text-success">Statistik Absensi (<span
                            id="absensiCount"></span>)</a></li>
                <span class="px-2">|</span>
                <li><a href="{{ route('statistik-ruangan') }}" class="breadcrumb-item  px-1">Ruangan (<span
                            id=""></span>)</a></li>

            </ol>
            <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%"
                id="datatables">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">MK</th>
                        <th class="text-center" scope="col">Kelas</th>
                        <th class="text-center" scope="col">SKS</th>
                        <th class="text-center" scope="col">Semester</th>
                        <th class="text-center" scope="col">Dosen</th>
                        <th class="text-center" scope="col">Dosen 2</th>
                        <th class="text-center" scope="col">Hari</th>
                        <th class="text-center" scope="col">Waktu Mulai</th>
                        <th class="text-center" scope="col">Ruangan</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Pertemuan Terakhir</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestAttendances as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->mata_kuliah }}</td>
                            @if ($data->class == !null)
                                <td>{{ $data->class?->kelas->nama_kelas }}</td>
                            @endif
                            <td>{{ $data->class?->sks }}</td>
                            @if ($data->class == !null)
                                <td>{{ $data->class->semester->semester ?? '-' }}
                                    {{ $data->class->semester->tahun_ajaran ?? '-' }}</td>
                                <td>{{ $data->class?->dosenmatkul->nama_singkat }}</td>
                            @endif
                            <td>{{ $data->class->dosenmatkul2->nama_singkat ?? '-' }}</td>
                            <td>{{ $data->class?->hari }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->perkuliahan?->created_at)->format('H:i:s') }}</td>
                            <td>{{ $data->class?->ruangan->nama_ruangan }}</td>
                            <td>{{ $data->perkuliahan?->status }}</td>
                            <td>{{ $data->perkuliahan?->nomor_pertemuan }}</td>
                            <td class="text-center">
                                <a href="{{ route('detailStatistik', ['class_id' => $data->class->id]) }}"
                                    class="badge btn btn-info p-1 mb-1 mr-1" data-bs-toggle="tooltip"
                                    title="Lihat Detail"><i class="fas fa-info-circle" aria-hidden="true"></i></a>
                            </td>
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

        $(document).ready(function() {
            // Menghitung jumlah baris dalam tabel
            var rowCount = $('#datatables tbody tr').length;

            // Memperbarui nilai pada elemen dengan id 'mataKuliahCount'
            $('#absensiCount').text(rowCount);
        });
    </script>
@endpush
