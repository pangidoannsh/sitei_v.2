@extends('doc.main-layout')

@php
    use Carbon\Carbon;
    if (!str_contains($mbkm->rincian_link, 'https:')) {
        $link = 'https://' . $mbkm->rincian_link;
    } else {
        $link = $mbkm->rincian_link;
    }
@endphp

@section('title')
    SITEI MBKM | Konversi Nilai MBKM
@endsection

@section('sub-title')
    Konversi Nilai MBKM Mahasiswa
@endsection

@section('content')
    <a href="{{ url()->previous() }}" class="badge bg-success p-2 mb-3 "> Kembali </a>
    <section class="row pb-5">
        <div class="dokumen-card mb-4">
            <h2>Informasi Mahasiswa</h2>
            <div class="divider-green"></div>
            <div class="row row-cols-5">
                @if ($sertifikat)
                    <div class="d-flex flex-column gap-1">
                        <div class="label">Sertifikat</div>
                        <div class="value text-capitalize">
                            <a href="{{ asset('storage/' . $sertifikat->file) }}" target="_blank"
                                class="btn btn-success px-5 rounded-2">Buka</a>
                        </div>
                    </div>
                @endif
                @if ($mbkm->transkrip)
                    <div class="d-flex flex-column gap-1">
                        <div class="label">Transkrip</div>
                        <div class="value text-capitalize">
                            <a href="{{ asset('storage/' . $mbkm->transkrip) }}" target="_blank"
                                class="btn btn-success px-5 rounded-2">Buka</a>
                        </div>
                    </div>
                @endif
                <div class="d-flex flex-column gap-1">
                    <div class="label">Surat Rekomendasi</div>
                    <div class="value text-capitalize">
                        <a href="{{ asset('storage/' . $mbkm->surat_rekomendasi) }}" target="_blank"
                            class="btn btn-success px-5 rounded-2">Buka</a>
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">Surat Persetujuan PA</div>
                    <div class="value text-capitalize">
                        <a href="{{ asset('storage/' . $mbkm->persetujuan_pa) }}" target="_blank"
                            class="btn btn-success px-5 rounded-2">Buka</a>
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <div class="label">KRS Berjalan</div>
                    <div class="value text-capitalize">
                        <a href="{{ asset('storage/' . $mbkm->krs_berjalan) }}" target="_blank"
                            class="btn btn-success px-5 rounded-2">Buka</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dokumen-card">
            <h3>Konversi Nilai</h3>
            <form action="{{ route('mbkm.prodi.approvekonversi', $mbkm->id) }}" method="POST" class="col-lg-12"
                id="setujui-konversi">
                @csrf
                <div class="row">
                    <div class="col-5">
                        <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" scope="col">NO</th>
                                    <th class="text-center" scope="col">Mata Kuliah Yang Di Konversi (UNRI)</th>
                                    <th class="text-center" scope="col">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($konversi as $kr)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $kr->nama_nilai_matkul }}</td>
                                        <td class="text-center">{{ $kr->sks }} SKS</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-7">
                        <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" scope="col">NO</th>
                                    <th class="text-center" scope="col">Subjek/Mata Kuliah MBKM</th>
                                    <th class="text-center" scope="col">Nilai MBKM</th>
                                </tr>
                            </thead>
                            <tbody>
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
                <br>
                <hr>
                <br>
                <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center" scope="col">NO</th>
                            <th class="text-center" scope="col">Mata Kuliah</th>
                            <th class="text-center" scope="col">Subjek Penilaian MBKM</th>
                            <th class="text-center" scope="col">Nilai Konversi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konversi as $kr)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <select id="matkul" name="konversi[{{ $kr->id }}][matkul]" class="form-select"
                                        required>
                                        <option value="" selected>- Pilih Mata Kuliah -</option>
                                        @foreach ($konversi as $option)
                                            <option value="{{ $option->id }}">{{ $option->nama_nilai_matkul }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <input name="konversi[{{ $kr->id }}][penilaian_mbkm]" class="form-control" />
                                </td>
                                <td class="text-center">
                                    <input name="konversi[{{ $kr->id }}][nilai]" class="form-control"
                                        type="number" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success px-5 py-2 rounded-2">Setujui Konversi</button>
                </div>
            </form>
        </div>
        {{-- Section Kanan --}}
        <div class="col-lg-4">

        </div>
    </section>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI
                (
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Muhammad Abdullah Qosim
                </a>,
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Ilmi Fajar Ramadhan
                </a>,dan
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Fitra Ramadhan
                </a>
                )
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $("#setujui-konversi").submit(e => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Persetujuan Konversi Nilai',
                text: 'Lanjutkan Persetujuan?',
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
        $("#pengunduran-diri").submit((e) => {
            const form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                title: 'Usulan Pengunduran Diri',
                text: 'Setujui Usulan Pengunduran Diri?',
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
@endpush()
