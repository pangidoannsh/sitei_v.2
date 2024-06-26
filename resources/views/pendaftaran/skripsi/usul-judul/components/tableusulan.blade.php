<div class="card p-4">
    <table class="table table-responsive-lg table-bordered table-striped" width="100%">
        <thead class="table-dark">
            <p class="alert-warning p-2"><i class="fas fa-exclamation-triangle px-2 fw-bold"></i> Jika Anda lewat
                batas, Pembimbing berhak menghapus anda dari daftar bimbingan (Ajukan Judul baru)</p>
            <tr>
                <th class="text-center" scope="col">NIM</th>
                <th class="text-center" scope="col">Nama</th>
                <th class="text-center" scope="col">Jenis Usulan</th>
                <th class="text-center" scope="col">Status Skripsi</th>
                <th class="text-center" scope="col">Keterangan</th>
                <th class="text-center" scope="col" style="padding-left: 50px; padding-right:50px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <div></div>
            @foreach ($skripsi as $skripsi)
                <tr>
                    <td class="text-center">{{ $skripsi->mahasiswa->nim }}</td>
                    <td class="text-center fw-bold">{{ $skripsi->mahasiswa->nama }}</td>
                    <td class="text-center">{{ $skripsi->jenis_usulan }}</td>
                    @if (
                        $skripsi->status_skripsi == 'USULAN JUDUL' ||
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                            $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN REVISI' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 1' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 2' ||
                            $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI')
                        <td class="text-center bg-secondary">{{ $skripsi->status_skripsi }}</td>
                    @endif
                    @if (
                        $skripsi->status_skripsi == 'JUDUL DISETUJUI' ||
                            $skripsi->status_skripsi == 'SEMPRO SELESAI' ||
                            $skripsi->status_skripsi == 'SIDANG SELESAI' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' ||
                            $skripsi->status_skripsi == 'SKRIPSI SELESAI' ||
                            $skripsi->status_skripsi == 'LULUS' ||
                            $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI' ||
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI')
                        <td class="text-center bg-info">{{ $skripsi->status_skripsi }}</td>
                    @endif
                    @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' || $skripsi->status_skripsi == 'SIDANG DIJADWALKAN')
                        <td class="text-center bg-success">{{ $skripsi->status_skripsi }}</td>
                    @endif
                    @if (
                        $skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' ||
                            $skripsi->status_skripsi == 'USULKAN JUDUL ULANG' ||
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' ||
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' ||
                            $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' ||
                            $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' ||
                            $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                        <td class="text-center bg-danger">{{ $skripsi->status_skripsi }}</td>
                    @endif

                    @if (
                        $skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' ||
                            $skripsi->status_skripsi == 'USULKAN JUDUL ULANG' ||
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG' ||
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' ||
                            $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' ||
                            $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK' ||
                            $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                        <td class="text-center text-danger">{{ $skripsi->keterangan }}</td>
                    @else
                        <td class="text-center">{{ $skripsi->keterangan }}</td>
                    @endif

                    @if (
                        $skripsi->status_skripsi == 'USULAN JUDUL' ||
                            $skripsi->status_skripsi == 'JUDUL DISETUJUI' ||
                            $skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' ||
                            $skripsi->status_skripsi == 'USULKAN JUDUL ULANG')
                        <td class="text-center">
                            <a href="/usuljudul/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                                data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                            @if ($skripsi->status_skripsi == 'USULAN JUDUL DITOLAK' || $skripsi->status_skripsi == 'USULKAN JUDUL ULANG')
                                <a href="/usuljudul-ulang/create" class="badge p-1  mb-1" data-bs-toggle="tooltip"
                                    title="Usul Judul Ulang"><img height="25" width="25"
                                        src="/assets/img/add.png" alt="..." class="zoom-image"></a>
                            @endif
                            @if ($skripsi->status_skripsi == 'JUDUL DISETUJUI')
                                <a href="/daftar-sempro/create/{{ $skripsi->id }}" class="badge p-1  mb-1"
                                    data-bs-toggle="tooltip" title="Daftar Seminar Proposal"><img height="25"
                                        width="25" src="/assets/img/add.png" alt="..." class="zoom-image"></a>
                            @endif


                        </td>
                    @endif

                    @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' || $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG')
                        <td class="text-center">
                            <a href="/daftar-sempro/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                                data-bs-toggle="tooltip"><i class="fas fa-info-circle"></i> <span
                                    class="custom-tooltip">Lihat
                                    Detail</span></a>
                            @if ($skripsi->status_skripsi == 'DAFTAR SEMPRO DITOLAK' || $skripsi->status_skripsi == 'DAFTAR SEMPRO ULANG')
                                <a href="/daftar-sempro/create/{{ $skripsi->id }}" class="badge p-1  mb-1"
                                    data-bs-toggle="tooltip" title="Daftar Seminar Proposal"><img height="25"
                                        width="25" src="/assets/img/add.png" alt="..." class="zoom-image"></a>
                            @endif

                        </td>
                    @endif

                    @if (
                        $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                            $skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' ||
                            $skripsi->status_skripsi == 'SEMPRO SELESAI' ||
                            $skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' ||
                            $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK' ||
                            $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI')
                        <td class="text-center">
                            @if (
                                $skripsi->status_skripsi == 'DAFTAR SEMPRO' ||
                                    $skripsi->status_skripsi == 'SEMPRO DIJADWALKAN' ||
                                    $skripsi->status_skripsi == 'SEMPRO SELESAI' ||
                                    $skripsi->status_skripsi == 'DAFTAR SEMPRO DISETUJUI')
                                <a href="/daftar-sempro/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                                    data-bs-toggle="tooltip"><i class="fas fa-info-circle"></i> <span
                                        class="custom-tooltip">Lihat
                                        Detail</span></a>
                            @endif
                            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' || $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK')
                                <a href="/daftar-sidang/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                                    data-bs-toggle="tooltip"><i class="fas fa-info-circle"></i> <span
                                        class="custom-tooltip">Lihat
                                        Detail</span></a>
                            @endif

                            @if ($skripsi->status_skripsi == 'SEMPRO DIJADWALKAN')
                                <a href="/jadwal/mahasiswa" class="badge p-1 mb-1" data-bs-toggle="tooltip"
                                    title="Lihat Jadwal"><img height="25" width="25"
                                        src="/assets/img/calendar.png" alt="..." class="zoom-image"></a>
                            @endif
                            @if ($skripsi->status_skripsi == 'SEMPRO SELESAI')
                                <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"><i
                                        class="fas fa-history"></i> <span class="custom-tooltip">Riwayat
                                        Seminar</span></a>
                                <a type="button" data-toggle="modal" data-target="#GFG">
                                    <img height="25" width="25" src="/assets/img/clockplus.png" alt="..."
                                        class=""> <span class="custom-tooltip">Permohonan
                                        Perpanjangan 1 Waktu Skripsi</span></a>


                                <div class="modal fade" id="GFG">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content ">
                                            <div class="modal-header bg-secondary justify-content-center">
                                                <h5 class="modal-title ">
                                                    Perpanjangan Waktu Skripsi ke-1
                                                </h5>

                                            </div>
                                            <div class="modal-body ">
                                                <form action="/perpanjangan1-skripsi/create/{{ $skripsi->id }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label for="formFile"
                                                                        class="form-label float-start">STI/TE-22/Surat
                                                                        Pernyataan Perpanjangan Skripsi<span
                                                                            class="text-danger">*</span> <small
                                                                            class="text-secondary">( Format .pdf |
                                                                            Maks. 200 KB ) </small></label>
                                                                    <input name="sti_22"
                                                                        class="form-control @error('sti_22') is-invalid @enderror"
                                                                        value="{{ old('sti_22') }}" type="file"
                                                                        id="formFile" required autofocus>

                                                                    @error('sti_22')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>


                                                                <!-- <button type="submit" class="btn btn-success px-3 py-2 mt-4 float-end" data-bs-toggle="modal" data-bs-target="#ModalApprove">Kirim</button> -->

                                                                <a href="#ModalApprove" data-toggle="modal"
                                                                    class="btn mt-4 btn-lg btn-success float-right">Kirim</a>
                                                                <div class="modal fade"id="ModalApprove">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content shadow-sm">
                                                                            <div class="modal-body">
                                                                                <div class="container px-5 pt-5 pb-2">
                                                                                    <h3 class="text-center">Apakah
                                                                                        Anda Yakin?</h3>
                                                                                    <p class="text-center">Jika
                                                                                        belum, silahkan cek kembali
                                                                                        Data yang akan Anda Kirim.
                                                                                    </p>
                                                                                    <div class="row text-center">
                                                                                        <div class="col-3">
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <button type="button"
                                                                                                class="btn p-2 px-3 btn-secondary"
                                                                                                data-dismiss="modal">Tidak</button>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-success py-2 px-3">Kirim</button>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer ">

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <a href="/daftar-sidang/create/{{ $skripsi->id }}" class="mb-1"
                                    data-bs-toggle="tooltip"><img height="25" width="25"
                                        src="/assets/img/add.png" alt="..." class="zoom-image"> <span
                                        class="custom-tooltip">Daftar Sidang skripsi</span></a>
                            @endif


                            @if ($skripsi->status_skripsi == 'DAFTAR SIDANG ULANG' || $skripsi->status_skripsi == 'DAFTAR SIDANG DITOLAK')
                                <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                                    title="Lihat Riwayat Seminar"><i class="fas fa-history"></i></a>
                                <a href="/daftar-sidang/create/{{ $skripsi->id }}" class="badge p-1 mb-1"
                                    data-bs-toggle="tooltip" title="Daftar Sidang skripsi"><img height="25"
                                        width="25" src="/assets/img/add.png" alt="..."
                                        class="zoom-image"></a>
                            @endif

                        </td>
                    @endif


                    @if (
                        $skripsi->status_skripsi == 'PERPANJANGAN 1' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK' ||
                            $skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')
                        <td class="text-center">

                            <a href="/perpanjangan-1/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                                data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>

                            @if ($skripsi->status_skripsi == 'PERPANJANGAN 1 DITOLAK')
                                <a type="button" data-toggle="modal" title="Permohonan Perpanjangan 1 Waktu Skripsi"
                                    data-target="#GFG">
                                    <img height="25" width="25" src="/assets/img/clockplus.png"
                                        alt="..." class=""> </a>


                                <div class="modal fade" id="GFG">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content ">
                                            <div class="modal-header bg-secondary justify-content-center">
                                                <h5 class="modal-title ">
                                                    Perpanjangan Waktu Skripsi ke-1
                                                </h5>

                                            </div>
                                            <div class="modal-body ">
                                                <form action="/perpanjangan1-skripsi/create/{{ $skripsi->id }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3">
                                                                    <label for="formFile"
                                                                        class="form-label float-start">STI/TE-22/Surat
                                                                        Pernyataan Perpanjangan Skripsi<span
                                                                            class="text-danger">*</span> <small
                                                                            class="text-secondary">( Format .pdf |
                                                                            Maks. 200 KB ) </small></label>
                                                                    <input name="sti_22"
                                                                        class="form-control @error('sti_22') is-invalid @enderror"
                                                                        value="{{ old('sti_22') }}" type="file"
                                                                        id="formFile" required autofocus>

                                                                    @error('sti_22')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>


                                                                <!-- <button type="submit" class="btn btn-success px-3 py-2 mt-4 float-end" data-bs-toggle="modal" data-bs-target="#ModalApprove">Kirim</button> -->

                                                                <a href="#ModalApprove" data-toggle="modal"
                                                                    class="btn mt-4 btn-lg btn-success float-right">Kirim</a>
                                                                <div class="modal fade"id="ModalApprove">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content shadow-sm">
                                                                            <div class="modal-body">
                                                                                <div class="container px-5 pt-5 pb-2">
                                                                                    <h3 class="text-center">Apakah
                                                                                        Anda Yakin?</h3>
                                                                                    <p class="text-center">Jika
                                                                                        belum, silahkan cek kembali
                                                                                        Data yang akan Anda Kirim.
                                                                                    </p>
                                                                                    <div class="row text-center">
                                                                                        <div class="col-3">
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <button type="button"
                                                                                                class="btn p-2 px-3 btn-secondary"
                                                                                                data-dismiss="modal">Tidak</button>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <button type="submit"
                                                                                                class="btn btn-success py-2 px-3">Kirim</button>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer ">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="/daftar-sidang/create/{{ $skripsi->id }}" class="mb-1"
                                    data-bs-toggle="tooltip" title="Daftar Sidang skripsi"><img height="25"
                                        width="25" src="/assets/img/add.png" alt="..."
                                        class="zoom-image"></a>

                        </td>
                    @endif

                    @if ($skripsi->status_skripsi == 'PERPANJANGAN 1 DISETUJUI')
                        <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                            title="Lihat Riwayat Seminar"><i class="fas fa-history"></i></a>
                        <a type="button" data-toggle="modal" title="Permohonan Perpanjangan 2 Waktu Skripsi"
                            data-target="#GFG">
                            <img height="25" width="25" src="/assets/img/clockplus2.png" alt="..."
                                class=""> </a>


                        <div class="modal fade" id="GFG">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content ">
                                    <div class="modal-header bg-secondary justify-content-center">
                                        <h5 class="modal-title ">
                                            Perpanjangan Waktu Skripsi ke-2
                                        </h5>

                                    </div>
                                    <div class="modal-body ">
                                        <form action="/perpanjangan2-skripsi/create/{{ $skripsi->id }}"
                                            method="POST" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="formFile"
                                                                class="form-label float-start">STI/TE-22/Surat
                                                                Pernyataan Perpanjangan Skripsi<span
                                                                    class="text-danger">*</span> <small
                                                                    class="text-secondary">( Format .pdf | Maks.
                                                                    200 KB ) </small></label>
                                                            <input name="sti_22"
                                                                class="form-control @error('sti_22') is-invalid @enderror"
                                                                value="{{ old('sti_22') }}" type="file"
                                                                id="formFile" required autofocus>

                                                            @error('sti_22')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <!-- <button type="submit" class="btn btn-success px-3 py-2 mt-4 float-end" data-bs-toggle="modal" data-bs-target="#ModalApprove">Kirim</button> -->

                                                        <a href="#ModalApprove" data-toggle="modal"
                                                            class="btn mt-4 btn-lg btn-success float-right">Kirim</a>
                                                        <div class="modal fade"id="ModalApprove">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content shadow-sm">
                                                                    <div class="modal-body">
                                                                        <div class="container px-5 pt-5 pb-2">
                                                                            <h3 class="text-center">Apakah Anda
                                                                                Yakin?</h3>
                                                                            <p class="text-center">Jika belum,
                                                                                silahkan cek kembali Data yang akan
                                                                                Anda Kirim.</p>
                                                                            <div class="row text-center">
                                                                                <div class="col-3">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <button type="button"
                                                                                        class="btn p-2 px-3 btn-secondary"
                                                                                        data-dismiss="modal">Tidak</button>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <button type="submit"
                                                                                        class="btn btn-success py-2 px-3">Kirim</button>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer ">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="/daftar-sidang/create/{{ $skripsi->id }}" class="mb-1" data-bs-toggle="tooltip"
                            title="Daftar Sidang skripsi"><img height="25" width="25"
                                src="/assets/img/add.png" alt="..." class="zoom-image"></a>

                        </td>
                    @endif
                    @if ($skripsi->status_skripsi == 'PERPANJANGAN 1')
                        <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                            title="Lihat Riwayat Seminar"><i class="fas fa-history"></i></a>


                        </td>
                    @endif
            @endif
            @if (
                $skripsi->status_skripsi == 'PERPANJANGAN 2' ||
                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK' ||
                    $skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')
                <td class="text-center">

                    <a href="/perpanjangan-2/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                        data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>

                    @if ($skripsi->status_skripsi == 'PERPANJANGAN 2 DITOLAK')
                        <a type="button" data-toggle="modal" title="Permohonan Perpanjangan 2 Waktu Skripsi"
                            data-target="#GFG">
                            <img height="25" width="25" src="/assets/img/clockplus2.png" alt="..."
                                class=""> </a>


                        <div class="modal fade" id="GFG">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content ">
                                    <div class="modal-header bg-secondary justify-content-center">
                                        <h5 class="modal-title ">
                                            Perpanjangan Waktu Skripsi ke-2
                                        </h5>

                                    </div>
                                    <div class="modal-body ">
                                        <form action="/perpanjangan2-skripsi/create/{{ $skripsi->id }}"
                                            method="POST" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="formFile"
                                                                class="form-label float-start">STI/TE-22/Surat
                                                                Pernyataan Perpanjangan Skripsi<span
                                                                    class="text-danger">*</span> <small
                                                                    class="text-secondary">( Format .pdf | Maks.
                                                                    200 KB ) </small></label>
                                                            <input name="sti_22"
                                                                class="form-control @error('sti_22') is-invalid @enderror"
                                                                value="{{ old('sti_22') }}" type="file"
                                                                id="formFile" required autofocus>

                                                            @error('sti_22')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>


                                                        <!-- <button type="submit" class="btn btn-success px-3 py-2 mt-4 float-end" data-bs-toggle="modal" data-bs-target="#ModalApprove">Kirim</button> -->

                                                        <a href="#ModalApprove" data-toggle="modal"
                                                            class="btn mt-4 btn-lg btn-success float-right">Kirim</a>
                                                        <div class="modal fade"id="ModalApprove">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content shadow-sm">
                                                                    <div class="modal-body">
                                                                        <div class="container px-5 pt-5 pb-2">
                                                                            <h3 class="text-center">Apakah Anda
                                                                                Yakin?</h3>
                                                                            <p class="text-center">Jika belum,
                                                                                silahkan cek kembali Data yang akan
                                                                                Anda Kirim.</p>
                                                                            <div class="row text-center">
                                                                                <div class="col-3">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <button type="button"
                                                                                        class="btn p-2 px-3 btn-secondary"
                                                                                        data-dismiss="modal">Tidak</button>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <button type="submit"
                                                                                        class="btn btn-success py-2 px-3">Kirim</button>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer ">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="/daftar-sidang/create/{{ $skripsi->id }}" class="mb-1" data-bs-toggle="tooltip"
                            title="Daftar Sidang skripsi"><img height="25" width="25"
                                src="/assets/img/add.png" alt="..." class="zoom-image"></a>

                </td>
            @endif

            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2 DISETUJUI')
                <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                    title="Lihat Riwayat Seminar"><i class="fas fa-history"></i></a>


                <a href="/daftar-sidang/create/{{ $skripsi->id }}" class="mb-1" data-bs-toggle="tooltip"
                    title="Daftar Sidang skripsi"><img height="25" width="25" src="/assets/img/add.png"
                        alt="..." class="zoom-image"></a>

                </td>
            @endif
            @if ($skripsi->status_skripsi == 'PERPANJANGAN 2')
                <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                    title="Lihat Riwayat Seminar"><i class="fas fa-history"></i></a>


                </td>
            @endif
            @endif

            @if (
                $skripsi->status_skripsi == 'DAFTAR SIDANG' ||
                    $skripsi->status_skripsi == 'SIDANG DIJADWALKAN' ||
                    $skripsi->status_skripsi == 'SIDANG SELESAI' ||
                    $skripsi->status_skripsi == 'DAFTAR SIDANG DISETUJUI')
                <td class="text-center">

                    <a href="/daftar-sidang/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                        data-bs-toggle="tooltip"><i class="fas fa-info-circle"></i> <span
                            class="custom-tooltip">Lihat Detail</span></a>


                    @if ($skripsi->status_skripsi == 'SIDANG DIJADWALKAN')
                        <a href="/jadwal/mahasiswa" class="badge p-1" data-bs-toggle="tooltip"
                            title="Lihat Jadwal"><img height="25" width="25" src="/assets/img/calendar.png"
                                alt="..." class="zoom-image"></a>
                    @endif


                    @if ($skripsi->status_skripsi == 'SIDANG SELESAI')
                        <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                            title="Riwayat Seminar skripsi"><i class="fas fa-history"></i></a>
                        <!-- <a href="/perpanjangan/revisi/create/{{ $skripsi->id }}" class=" mb-1"data-bs-toggle="tooltip" title="Unggah STI/TE-23/SURAT PERNYATAAN PERPANJANGAN REVISI SKRIPSI"><img height="25" width="25" src="/assets/img/clockb.png"  alt="..." class=""></a> -->

                        <a type="button" data-toggle="modal" title="Permohonan Perpanjangan 2 Waktu Skripsi"
                            data-target="#GFG">
                            <img height="25" width="25" src="/assets/img/clockb.png" alt="..."
                                class=""> </a>


                        <div class="modal fade" id="GFG">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content ">
                                    <div class="modal-header bg-secondary justify-content-center">
                                        <h5 class="modal-title">
                                            Perpanjangan Revisi Skripsi
                                        </h5>

                                    </div>
                                    <div class="modal-body ">
                                        <form action="/perpanjangan-revisi/create/{{ $skripsi->id }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="formFile"
                                                                class="form-label float-start">STI/TE-23/Surat
                                                                Perpanjangan Waktu Revisi Skripsi<span
                                                                    class="text-danger">*</span> <small
                                                                    class="text-secondary">( Format .pdf | Maks.
                                                                    200 KB ) </small></label>
                                                            <input name="sti_23"
                                                                class="form-control @error('sti_23') is-invalid @enderror"
                                                                value="{{ old('sti_23') }}" type="file"
                                                                id="formFile" required autofocus>

                                                            @error('sti_23')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>


                                                        <!-- <button type="submit" class="btn btn-success px-3 py-2 mt-4 float-end" data-bs-toggle="modal" data-bs-target="#ModalApprove">Kirim</button> -->

                                                        <a href="#ModalApprove" data-toggle="modal"
                                                            class="btn mt-4 btn-lg btn-success float-right">Kirim</a>
                                                        <div class="modal fade"id="ModalApprove">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content shadow-sm">
                                                                    <div class="modal-body">
                                                                        <div class="container px-5 pt-5 pb-2">
                                                                            <h3 class="text-center">Apakah Anda
                                                                                Yakin?</h3>
                                                                            <p class="text-center">Jika belum,
                                                                                silahkan cek kembali Data yang akan
                                                                                Anda Kirim.</p>
                                                                            <div class="row text-center">
                                                                                <div class="col-3">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <button type="button"
                                                                                        class="btn p-2 px-3 btn-secondary"
                                                                                        data-dismiss="modal">Tidak</button>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <button type="submit"
                                                                                        class="btn btn-success py-2 px-3">Kirim</button>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer ">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="/penyerahan-buku-skripsi/create/{{ $skripsi->id }}" class="mb-1"
                            data-bs-toggle="tooltip" title="Unggah STI/TE-17/Bukti Penyerahan Buku Skripsi"><img
                                height="25" width="25" src="/assets/img/add.png" alt="..."
                                class="zoom-image"></a>
                    @endif
                </td>
            @endif
            @if (
                $skripsi->status_skripsi == 'PERPANJANGAN REVISI' ||
                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI' ||
                    $skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK')
                <td class="text-center">

                    <a href="/perpanjangan-revisi/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                        data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                    <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                        title="Riwayat Seminar skripsi"><i class="fas fa-history"></i></a>

                    @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI DISETUJUI')
                        <a href="/penyerahan-buku-skripsi/create/{{ $skripsi->id }}" class="badge  mb-1"
                            data-bs-toggle="tooltip" title="Unggah STI/TE-17/Bukti Penyerahan Buku Skripsi"><img
                                height="25" width="25" src="/assets/img/add.png" alt="..."
                                class="zoom-image"></a>
                    @endif

                    @if ($skripsi->status_skripsi == 'PERPANJANGAN REVISI DITOLAK')
                        <a type="button" data-toggle="modal" title="Permohonan Perpanjangan 2 Waktu Skripsi"
                            data-target="#GFG">
                            <img height="25" width="25" src="/assets/img/clockb.png" alt="..."
                                class=""> </a>


                        <div class="modal fade" id="GFG">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content ">
                                    <div class="modal-header bg-secondary justify-content-center">
                                        <h5 class="modal-title">
                                            Perpanjangan Revisi Skripsi
                                        </h5>

                                    </div>
                                    <div class="modal-body ">
                                        <form action="/perpanjangan-revisi/create/{{ $skripsi->id }}" method="POST"
                                            enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label for="formFile"
                                                                class="form-label float-start">STI/TE-23/Surat
                                                                Perpanjangan Waktu Revisi Skripsi<span
                                                                    class="text-danger">*</span> <small
                                                                    class="text-secondary">( Format .pdf | Maks.
                                                                    200 KB ) </small></label>
                                                            <input name="sti_23"
                                                                class="form-control @error('sti_23') is-invalid @enderror"
                                                                value="{{ old('sti_23') }}" type="file"
                                                                id="formFile" required autofocus>

                                                            @error('sti_23')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>


                                                        <!-- <button type="submit" class="btn btn-success px-3 py-2 mt-4 float-end" data-bs-toggle="modal" data-bs-target="#ModalApprove">Kirim</button> -->

                                                        <a href="#ModalApprove" data-toggle="modal"
                                                            class="btn mt-4 btn-lg btn-success float-right">Kirim</a>
                                                        <div class="modal fade"id="ModalApprove">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content shadow-sm">
                                                                    <div class="modal-body">
                                                                        <div class="container px-5 pt-5 pb-2">
                                                                            <h3 class="text-center">Apakah Anda
                                                                                Yakin?</h3>
                                                                            <p class="text-center">Jika belum,
                                                                                silahkan cek kembali Data yang akan
                                                                                Anda Kirim.</p>
                                                                            <div class="row text-center">
                                                                                <div class="col-3">
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <button type="button"
                                                                                        class="btn p-2 px-3 btn-secondary"
                                                                                        data-dismiss="modal">Tidak</button>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                    <button type="submit"
                                                                                        class="btn btn-success py-2 px-3">Kirim</button>
                                                                                </div>
                                                                                <div class="col-3">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer ">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="/penyerahan-buku-skripsi/create/{{ $skripsi->id }}" class=" mb-1"
                            data-bs-toggle="tooltip" title="Unggah STI/TE-17/Bukti Penyerahan Buku Skripsi"><img
                                height="25" width="25" src="/assets/img/add.png" alt="..."
                                class="zoom-image"></a>
                    @endif
                </td>
            @endif

            @if (
                $skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI' ||
                    $skripsi->status_skripsi == 'SKRIPSI SELESAI' ||
                    $skripsi->status_skripsi == 'LULUS')
                <td class="text-center">
                    <a href="/bukti-buku-skripsi/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                        data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                    <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                        title="Lihat Riwayat Seminar"><i class="fas fa-history"></i></a>
                </td>
            @endif
            @if ($skripsi->status_skripsi == 'BUKTI PENYERAHAN BUKU SKRIPSI DITOLAK')
                <td class="text-center">
                    <a href="/bukti-buku-skripsi/detail/{{ $skripsi->id }}" class="badge btn btn-info p-1 mb-1"
                        data-bs-toggle="tooltip" title="Lihat Detail"><i class="fas fa-info-circle"></i></a>
                    <a href="/seminar" class="badge btn btn-dark p-1 mb-1" data-bs-toggle="tooltip"
                        title="Lihat Riwayat Seminar"><i class="fas fa-history"></i></a>

                    <a href="/penyerahan-buku-skripsi/create/{{ $skripsi->id }}" class="badge  mb-1"
                        data-bs-toggle="tooltip" title="Unggah STI/TE-17/Bukti Penyerahan Buku Skripsi"><img
                            height="25" width="25" src="/assets/img/add.png" alt="..."
                            class="zoom-image"></a>
                </td>
            @endif

            </tr>
            @endforeach

        </tbody>


    </table>
</div>
