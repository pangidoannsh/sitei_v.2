@extends('mbkm.main')

@php
    use Carbon\Carbon;
    if (!str_contains($mbkm->rincian_link, 'https:')) {
        $link = 'https://' . $mbkm->rincian_link;
    } else {
        $link = $mbkm->rincian_link;
    }
@endphp

@section('title')
    SITEI MBKM | Detail Mahasiswa
@endsection

@section('sub-title')
    Detail MBKM
@endsection

@section('content')
    <a href="@if (Auth::guard('dosen')->check()) {{ route('mbkm.prodi') }}
    @elseif(Auth::guard('web')->check())
    {{ route('mbkm.staff') }}
    @else
        {{ route('mbkm') }} @endif"
        class="btn btn-success mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-5"
        style="width: 120px;"> Kembali</a>

    @if ($mbkm->status == 'Usulan pengunduran diri')
        <div class="dokumen-card mb-3">
            <div>
                <h2>Pengajuan Pengunduran Diri</h2>
                <div class="divider-red"></div>
            </div>
            <div class="d-flex flex-column gap-1">
                <div class="label">Surat Pengunduran Diri</div>
                <div class="value text-capitalize">
                    <a href="{{ asset('storage/' . $mbkm->surat_pengunduran) }}"
                        target="_blank"class="btn btn-outline-danger rounded-2 px-5">Buka</a>
                </div>
            </div>

            <div class="d-flex flex-column gap-1">
                <div class="label">Alasan Pengunduran Diri</div>
                <div class="value text-capitalize">{{ $mbkm->alasan_undur_diri }}</div>
            </div>
            @if ($mbkm->status == 'Usulan pengunduran diri')
                @if (Auth::guard('dosen')->check() && in_array(Auth::guard('dosen')->user()->role_id, [6, 7, 8]))
                    <form action="{{ route('mbkm.prodi.approvepengunduran', $mbkm->id) }}" method="POST"
                        style="display: inline;" id="setujui-pengunduran-diri" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-danger px-5 rounded-2">
                            Setujui Pengajuan
                        </button>
                    </form>
                @endif
            @endif
        </div>
    @endif
    <section class="row pb-5">
        <div class="col-lg-8">
            <div class="dokumen-card">
                <div>
                    <h2>Data Lokasi MBKM</h2>
                    <div class="divider-green"></div>
                </div>
                @switch($mbkm->status)
                    @case('Usulan')
                    @case('Usulan konversi nilai')

                    @case('Usulan pengunduran diri')
                        <div class="rounded-2 py-3 text-center fw-semibold text-capitalize status-warning">
                            {{ $mbkm->status }}
                        </div>
                    @break

                    @case('Disetujui')
                    @case('Konversi diterima')

                    @case('Nilai sudah keluar')
                        <div class="status-success rounded-2 py-3 text-center fw-semibold text-capitalize">
                            @if ($mbkm->status == 'Konversi diterima')
                                Telah Terkonversi
                            @else
                                {{ $mbkm->status }}
                            @endif
                        </div>
                    @break

                    @case('Ditolak')
                    @case('Konversi ditolak')
                        <div class="status-danger rounded-2 py-3 text-center fw-semibold text-capitalize">
                            {{ $mbkm->status }} : <span class="fw-normal">{{ $mbkm->catatan }}</span>
                        </div>
                    @break

                    @case('Mengundurkan diri')
                        <div class="status-danger rounded-2 py-3 text-center fw-semibold text-capitalize">
                            {{ $mbkm->status }}
                        </div>
                    @break

                    @default
                @endswitch
                @if ($mbkm->status == 'Usulan')
                    <div class="d-flex flex-column gap-1">
                        <div class="label">Batas Waktu</div>
                        <div class="value text-capitalize">
                            {{ Carbon::parse($mbkm->batas)->translatedFormat('l, d F Y') }}
                            <span class="text-danger fw-bold"> ({{ Carbon::now()->diffInDays($mbkm->batas, false) + 1 }}
                                hari
                                lagi)</span>
                        </div>
                    </div>
                @endif
                <div class="d-flex
                                flex-column gap-1">
                    <div class="label">Nama Perusahaan</div>
                    <div class="value text-capitalize">{{ $mbkm->perusahaan }}</div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Alamat Perusahaan</div>
                    <div class="value text-capitalize">
                        {{ $mbkm->alamat }}
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Bidang Usaha/Kegiatan</div>
                    <div class="value text-capitalize">
                        {{ $mbkm->bidang_usaha }}
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Periode Kegiatan</div>
                    <div class="value">
                        {{ Carbon::parse($mbkm->mulai_kegiatan)->translatedFormat('d F Y') .
                            ' - ' .
                            Carbon::parse($mbkm->selesai_kegiatan)->translatedFormat('d F Y') }}
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Rincian Kegiatan</div>
                    <div class="value text-capitalize">
                        @if ($mbkm->rincian)
                            <a href="{{ asset('storage/' . $mbkm->rincian) }}" target="_blank"
                                class="btn btn-success px-5 rounded-2">PDF</a>
                        @endif
                        @if ($mbkm->rincian_link)
                            <a href="{{ $link }}" target="_blank" class="btn btn-success px-5 rounded-2">Link</a>
                        @endif
                    </div>
                </div>
                <div class="d-flex gap-4">
                    <div class="d-flex flex-column gap-1">
                        <div class="label">Surat Rekomendasi</div>
                        <div class="value text-capitalize">
                            <a href="{{ asset('storage/' . $mbkm->surat_rekomendasi) }}" target="_blank"
                                class="btn btn-success px-5 rounded-2">Lihat SR</a>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <div class="label">Surat Persetujuan PA</div>
                        <div class="value text-capitalize">
                            <a href="{{ asset('storage/' . $mbkm->persetujuan_pa) }}" target="_blank"
                                class="btn btn-success px-5 rounded-2">Lihat Surat</a>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-1">
                        <div class="label">KRS Berjalan</div>
                        <div class="value text-capitalize">
                            <a href="{{ asset('storage/' . $mbkm->krs_berjalan) }}" target="_blank"
                                class="btn btn-success px-5 rounded-2">Lihat KRS</a>
                        </div>
                    </div>
                </div>
                @if ($mbkm->status != 'Usulan')
                    <a href="{{ route('mbkm.logbook', $mbkm->id) }}"
                        class="btn btn-outline-success rounded-2 w-100 py-2">Logbook</a>
                @endif
                @if (in_array($mbkm->status, ['Disetujui', 'Konversi ditolak']) &&
                        optional(Auth::guard('mahasiswa')->user())->nim == $mbkm->mahasiswa_nim)
                    <a href="{{ route('mbkm.sertif.create', $mbkm->id) }}" class="btn btn-success mt-1">
                        Ajukan Konversi
                    </a>
                @endif
                @if ($mbkm->status === 'Mengundurkan diri')
                    <div class="d-flex flex-column gap-1">
                        <div class="label">Surat pengunduran diri</div>
                        <div class="value text-capitalize">
                            <a href="{{ asset('storage/' . $mbkm->surat_pengunduran) }}"
                                target="_blank"class="btn btn-danger rounded-2 px-5">Lihat surat</a>
                        </div>
                    </div>
                @endif
                @if (in_array(optional(Auth::guard('dosen')->user())->role_id, [6, 7, 8]))
                    @if ($mbkm->status == 'Usulan')
                        <form action="{{ route('mbkm.prodi.approveusulan', $mbkm->id) }}" method="POST"
                            style="display: inline" id="setujui-usulan" class="d-flex">
                            @csrf
                            <button class="btn btn-success py-2 rounded-2 w-100">Setujui Usulan MBKM</button>
                        </form>
                    @elseif($mbkm->status == 'Usulan konversi nilai')
                        <a href="{{ route('mbkm.prodi.approvekonversi', $mbkm->id) }}" type="submit"
                            class="btn btn-success py-2 rounded-2">
                            Setujui Konversi Nilai
                        </a>
                    @endif
                @endif
            </div>
        </div>
        {{-- Section Kanan --}}
        <div class="col-lg-4">
            <div class="dokumen-card">
                <div>
                    <h2 style="width: 100%">Mahasiswa</h2>
                    <div class="divider-green"></div>
                </div>

                <div class="d-flex flex-column gap-1">
                    <div class="label">Nama</div>
                    <div class="value text-capitalize">{{ $mbkm->mahasiswa->nama }}</div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">NIM</div>
                    <div class="value text-capitalize">{{ $mbkm->mahasiswa->nim }}</div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Program Studi</div>
                    <div class="value text-capitalize">{{ $mbkm->mahasiswa->prodi->nama_prodi }}</div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Email</div>
                    <div class="value">{{ $mbkm->mahasiswa->email }}</div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Konsentrasi</div>
                    <div class="value">{{ $mbkm->mahasiswa->konsentrasi->nama_konsentrasi }}</div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Dosen PA</div>
                    <div class="value">{{ $mbkm->pembimbing->nama }}</div>
                </div>
            </div>
        </div>

        {{-- Card Konversi --}}
        @if (!in_array($mbkm->status, ['Mengundurkan diri', 'Usulan', 'Ditolak', 'Disetujui']))
            <div class="col-lg-12 mt-2">
                <div class="dokumen-card">
                    <div>
                        <h2>Sertifikat dan Konversi Nilai</h2>
                        <div class="divider-green"></div>
                    </div>

                    <div class="d-flex gap-4">
                        @if ($sertifikat)
                            <div class="d-flex flex-column gap-1">
                                <div class="label">Sertifikat</div>
                                <div class="value text-capitalize">
                                    <a href="{{ asset('storage/' . $sertifikat->file) }}" target="_blank"
                                        class="btn btn-success px-5 rounded-2">Buka</a>
                                    {{-- @else
                                <div class="d-flex align-items-center" style="gap:8px">
                                    <span class="text-secondary" style="font-size: 14px">(Belum upload
                                        sertifikat)</span>
                                    @if (optional(Auth::guard('mahasiswa')->user())->nim == $mbkm->mahasiswa_nim)
                                        <a href="{{ route('mbkm.sertif.create', $mbkm->id) }}"
                                            class="btn btn-success rounded-2">
                                            <i class="fa-solid fa-upload"></i>
                                        </a>
                                    @endif
                                </div> --}}
                                </div>
                            </div>
                        @endif
                        @if ($mbkm->transkrip)
                            <div class="d-flex flex-column gap-1">
                                <div class="label">Transkrip Nilai MBKM</div>
                                <div class="value text-capitalize">
                                    <a href="{{ asset('storage/' . $mbkm->transkrip) }}" target="_blank"
                                        class="btn btn-success px-5 rounded-2">Buka</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- @if ($mbkm->status === 'Konversi diterima')
                        <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" scope="col">NO</th>
                                    <th class="text-center" scope="col">Nama Mata Kuliah</th>
                                    <th class="text-center" scope="col">Subjek Penilaian MBKM</th>
                                    <th class="text-center" scope="col">Nilai Konversi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($konversi as $kr)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $kr->nama_nilai_matkul }}</td>
                                        <td class="text-center">{{ $kr->subjek_mbkm }}</td>
                                        <td class="text-center">
                                            @if ($mbkm->status === 'Konversi diterima')
                                                {{ $kr->nilai_sks }}
                                            @else
                                                {{ $kr->nilai_mbkm }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="row row-cols-2">
                            <div>
                                <label>Mata Kuliah Berjalan</label>
                                <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center" scope="col">NO</th>
                                            <th class="text-center" scope="col">Mata Kuliah Yang Di Konversi (UNRI)
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-table-matkul">
                                        @foreach ($konversi as $kr)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $kr->nama_nilai_matkul }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <label>Penilaian MBKM</label>
                                <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center" scope="col">NO</th>
                                            <th class="text-center" scope="col">Subjek/Mata Kuliah MBKM</th>
                                            <th class="text-center" scope="col">Nilai MBKM</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-table-nilai-mbkm">
                                        @foreach ($penilaianMbkm as $penilaian)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $penilaian->nama_penilaian }}</td>
                                                <td class="text-center">{{ $penilaian->nilai }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif --}}
                    <div class="row row-cols-2">
                        <div>
                            <label>Mata Kuliah Berjalan</label>
                            <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center" scope="col">NO</th>
                                        <th class="text-center" scope="col">Mata Kuliah Yang Di Konversi (UNRI)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="body-table-matkul">
                                    @foreach ($konversi as $kr)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $kr->nama_nilai_matkul }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <label>Penilaian MBKM</label>
                            <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center" scope="col">NO</th>
                                        <th class="text-center" scope="col">Subjek/Mata Kuliah MBKM</th>
                                        <th class="text-center" scope="col">Nilai MBKM</th>
                                    </tr>
                                </thead>
                                <tbody id="body-table-nilai-mbkm">
                                    @foreach ($penilaianMbkm as $penilaian)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $penilaian->nama_penilaian }}</td>
                                            <td class="text-center">{{ $penilaian->nilai }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI
                (
                <a class="text-success fw-bold" href="#" target="_blank">
                    Muhammad Abdullah Qosim
                </a>,
                <a class="text-success fw-bold" href="#" target="_blank">
                    Fitra Ramadhan
                </a>,dan
                <a class="text-success fw-bold" href="#" target="_blank">
                    Ilmi Fajar Ramadhan
                </a>
                )
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const sertif = @json($sertifikat);
        const konversi = @json($konversi);
        const error = []
        if (sertif === null) error.push("Upload sertifikat")
        if (konversi.length === 0) error.push("Menambahkan mata kuliah konversi")

        $("#setujui-usulan").submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Usulan MBKM',
                text: 'Setujui Usulan Mengikuti MBKM?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Setujui',
                confirmButtonColor: '#28a745'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit()
                }
            })
        })
        $("#ajukan-konversi").submit(e => {
            const form = $(this).closest("form");
            e.preventDefault();
            if (error.length === 0) {
                Swal.fire({
                    title: 'Usulan Konversi Nilai',
                    text: 'Lanjutkan Pengajuan?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Ajukan',
                    confirmButtonColor: '#28a745'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.currentTarget.submit()
                    }
                })
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Pengajuan gagal",
                    text: 'Anda belum ' + error.join(" dan "),
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        })
        $("#setujui-pengunduran-diri").submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Usulan Pengunduran Diri',
                text: 'Apakah anda yakin?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Setujui',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.currentTarget.submit()
                }
            })
        })

        function tolakUsulanmbkmKaprodi() {
            Swal.fire({
                title: 'Tolak Usulan MBKM',
                text: 'Apakah Anda Yakin?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tolak',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tolak Usulan MBKM',
                        html: `
                        <form id="reasonForm" action="/prodi/tolakusulan/{{ $mbkm->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="catatan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
            });
        }

        function tolakUsulankonversiKaprodi() {
            Swal.fire({
                title: 'Tolak Konversi MBKM',
                text: 'Apakah Anda Yakin?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tolak',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Tolak Usulan MBKM',
                        html: `
                        <form id="reasonForm" action="/prodi/tolakkonversi/{{ $mbkm->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="catatan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                }
            });
        }
    </script>
@endpush
