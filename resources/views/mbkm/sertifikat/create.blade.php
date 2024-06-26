@extends('mbkm.main')

@php
    $auth = Auth::guard('mahasiswa');
@endphp
@section('title')
    Upload Sertifikat | SIA ELEKTRO
@endsection

@section('sub-title')
    Upload Sertifikat dan Konversi Nilai
@endsection

@section('content')
    <div class="container-fluid">
        <a href="{{ route('mbkm') }}" class="badge bg-success p-2 mb-3 "> Kembali </a>
    </div>
    <form action="{{ route('mbkm.sertif.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $mbkm->id }}" name="mbkm_id">
        <div class="dokumen-card">
            <h2>Sertifikat dan Konversi Nilai</h2>
            <div class="divider-green"></div>
            <div class="d-flex flex-column gap-3">
                @if ($sertifikat)
                    <div class="d-flex flex gap-2">
                        <div>
                            <a target="_blank" href="{{ asset('storage/' . $sertifikat->file) }}"
                                class="btn-outline-success btn px-5 rounded-2">Lihat Sertifikat</a>
                        </div>
                        <button type="button" class="btn text-warning" title="Ubah Sertifikat" id="edit-sertif">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>
                    <div class="row d-none" id="edit-sertif-card">
                        <div class="col-6-lg">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label for="file" class="form-label">Ubah Sertifikat</label>
                                    <span type="button" class="text-secondary pointer" id="cancel-edit">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </span>
                                </div>
                                <input class="form-control @error('file') is-invalid @enderror" type="file"
                                    accept=".jpg, .png, .pdf" id="file" name="file">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-6-lg">
                            <div class="mb-3">
                                <label for="file" class="form-label">Sertifikat</label>
                                <input class="form-control @error('file') is-invalid @enderror" type="file"
                                    accept=".jpg, .png, .pdf" id="file" name="file">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="d-flex flex-column gap-3">
                @if ($mbkm->transkrip)
                    <div class="d-flex flex gap-2">
                        <div>
                            <a target="_blank" href="{{ asset('storage/' . $mbkm->transkrip) }}"
                                class="btn-outline-success btn px-5 rounded-2">Lihat Transkrip Nilai MBKM</a>
                        </div>
                        <button type="button" class="btn text-warning" title="Ubah Sertifikat" id="edit-transkrip">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>
                    <div class="row d-none" id="edit-transkrip-card">
                        <div class="col-6-lg">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label for="transkrip" class="form-label">Ubah Transkrip Nilai MBKM</label>
                                    <span type="button" class="text-secondary pointer" id="cancel-edit-transkrip">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </span>
                                </div>
                                <input class="form-control @error('transkrip') is-invalid @enderror" type="file"
                                    accept=".jpg, .png, .pdf" id="transkrip" name="transkrip">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-6-lg">
                            <div class="mb-3">
                                <label for="transkrip" class="form-label">Transkrip Nilai MBKM</label>
                                <input class="form-control @error('transkrip') is-invalid @enderror" type="file"
                                    accept=".jpg, .png, .pdf" id="transkrip" name="transkrip">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <h4>Konversi Nilai</h4>
            <div class="row row-cols-2">
                <div>
                    <label>Mata Kuliah Berjalan</label>
                    <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" scope="col">NO</th>
                                <th class="text-center" scope="col">Mata Kuliah Yang Di Konversi (UNRI)</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="body-table-matkul">
                            @foreach ($konversi as $kr)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $kr->nama_nilai_matkul }}</td>
                                    <td class="text-center">
                                        <div>
                                            <button type="button" data-id="{{ $kr->id }}"
                                                class="badge btn btn-danger p-1.5 mb-2 delete-konversi"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center" id="btnAddKonversiContainer">
                        <button id="btnAddKonversi" type="button"
                            class="text-secondary btn-text text-center success d-flex align-items-center gap-1">
                            <div><i class="fa-solid fa-plus"></i></div>
                            <div>Mata Kuliah</div>
                        </button>
                    </div>
                </div>
                <div>
                    <label>Penilaian MBKM</label>
                    <table class="table table-responsive-lg table-bordered table-striped" width="100%">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" scope="col">NO</th>
                                <th class="text-center" scope="col">Subjek/Mata Kuliah MBKM</th>
                                <th class="text-center" scope="col">Nilai MBKM</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="body-table-nilai-mbkm">
                            @foreach ($penilaianMbkm as $penilaian)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $penilaian->nama_penilaian }}</td>
                                    <td class="text-center">{{ $penilaian->nilai }}</td>
                                    <td class="text-center">
                                        <div>
                                            <button type="button" data-id="{{ $penilaian->id }}"
                                                class="badge btn btn-danger p-1.5 mb-2 delete-penilaian-mbkm">
                                                <i class="fas fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center" id="btnAddKonversiContainer">
                        <button id="btnAddNilaiMbkm" type="button"
                            class="text-secondary btn-text text-center success d-flex align-items-center gap-1">
                            <div><i class="fa-solid fa-plus"></i></div>
                            <div>Konversi</div>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-success rounded-2 px-5">Ajukan Konversi Nilai</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        const bodyTable = $("#body-table-matkul");
        const bodyTableMbkm = $("#body-table-nilai-mbkm");
        const btnAddKonversi = $("#btnAddKonversi")
        const btnAddNilaiMbkm = $("#btnAddNilaiMbkm")
        var no = @json($konversi).length
        var noMbkm = @json($penilaianMbkm).length
        const matkul = @json($matkul);
        const options = matkul.map(mk => `<option value="${mk.id}">${mk.mk}</option>`).join('');

        function createRowMatkulUnri(matkul = "") {
            const row = $(`<tr>
                        <td class="text-center">${no}</td>
                        <td class="text-center">   
                            <select id="matkul" name="konversi[]" class="form-select" required>
                                <option value="" selected>- Pilih Mata Kuliah -</option>
                                ${options}
                            </select>
                        </td>                        
                    </tr>`)
            const btnDelete = $(`<button class="badge btn btn-danger p-1.5 mb-2">
                                        <i class="fas fa-times"></i>
                                    </button>`)
            btnDelete.click(e => row.remove())

            const cellAksi = $(`<td class="text-center"></td>`).append(btnDelete)
            return row.append(cellAksi)
        }

        function createRowMbkm(matkul = "", nama_nilai_mbkm = "", nilai_mbkm = "") {
            const row = $(`<tr>
                        <td class="text-center">${noMbkm}</td>
                        <td class="text-center">
                            <input type="text" name="penilaian_mbkm[${noMbkm}][nama_nilai_mbkm]" class="form-control" required/>  
                        </td>
                        <td class="text-center">
                            <input type="number" name="penilaian_mbkm[${noMbkm}][nilai_mbkm]" class="form-control" required/>
                        </td>
                        
                    </tr>`)
            const btnDelete = $(`<button class="badge btn btn-danger p-1.5 mb-2">
                                        <i class="fas fa-times"></i>
                                    </button>`)
            btnDelete.click(e => row.remove())

            const cellAksi = $(`<td class="text-center"></td>`).append(btnDelete)
            return row.append(cellAksi)
        }

        btnAddKonversi.click(e => {
            no++
            bodyTable.append(createRowMatkulUnri())
        })
        btnAddNilaiMbkm.click(e => {
            noMbkm++
            bodyTableMbkm.append(createRowMbkm())
        })
    </script>
    <script>
        $(".delete-konversi").click(e => {
            const id = $(e.currentTarget).data("id");
            Swal.fire({
                title: 'Hapus Konversi',
                text: 'Lanjutkan Penghapusan?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/mbkm/sertifikat/create/${id}/delete`
                }
            })
        })
        $(".delete-penilaian-mbkm").click(e => {
            const id = $(e.currentTarget).data("id");
            Swal.fire({
                title: 'Hapus Penilaian MBKM',
                text: 'Lanjutkan Penghapusan?',
                icon: 'question',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/mbkm/penilaian-mbkm/${id}/delete`
                }
            })
        })
        const editSertifCard = $("#edit-sertif-card")
        const editTransrkripCard = $("#edit-transkrip-card")

        $("#edit-sertif").click(e => {
            editSertifCard.removeClass("d-none")
        })
        $("#cancel-edit").click(e => {
            editSertifCard.addClass("d-none")
        })

        $("#edit-transkrip").click(e => {
            editTransrkripCard.removeClass("d-none")
        })
        $("#cancel-edit-transkrip").click(e => {
            editTransrkripCard.addClass("d-none")
        })
    </script>
@endpush
