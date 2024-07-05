@extends('absensi_menu.main')

@section('title')
    Tambah Mata Kuliah | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Mata Kuliah
@endsection

@section('content')
    <form action="{{ url('/matakuliah/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card ">
            <div class="card-header bg-dark mb-3">
                Form Tambah Matakuliah
            </div>
            <div class="ml-3 mr-3">
                <p class="alert-warning p-2"><i class="fas fa-exclamation-triangle px-2 fw-bold" aria-hidden="true"></i>
                    Mohon admin memasukkan semua materi pertemuan berdasarkan RPS dosen bersangkutan</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3 field">
                            <label class="form-label">Kode <span class="text-danger">*</span></label>
                            <input type="text" name="kode_mk" class="form-control @error('kode_mk') is-invalid @enderror"
                                value="{{ old('kode_mk') }}">
                            @error('kode_mk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                            <input type="text" name="mk" class="form-control @error('mk') is-invalid @enderror"
                                value="{{ old('mk') }}">
                            @error('mk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="prodi_id" class="form-label">Prodi <span class="text-danger">*</span></label>
                            <select name="prodi_id" id="prodi"
                                class="form-select @error('prodi_id') is-invalid @enderror">
                                @if (auth()->user()->role_id == 2)
                                    <option value="1">Teknik Elektro D3</option>
                                @endif
                                @if (auth()->user()->role_id == 3)
                                    <option value="2">Teknik Elektro S1</option>
                                @endif
                                @if (auth()->user()->role_id == 4)
                                    <option value="3">Teknik Informatika S1</option>
                                @endif
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="kelas_id" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <select name="kelas_id" id="kelas"
                                class="form-select @error('kelas_id') is-invalid @enderror">
                                @if (auth()->user()->role_id == 2)
                                    <option value="1">D3 TE</option>
                                @endif
                                @if (auth()->user()->role_id == 3)
                                    <option value="2">S1 TE A</option>
                                    <option value="3">S1 TE B</option>
                                    <option value="11">S1 TE C</option>
                                    <option value="9">S1 TE TELKOM</option>
                                    <option value="10">S1 TE POWER</option>
                                @endif
                                @if (auth()->user()->role_id == 4)
                                    <option value="4">S1 TI A</option>
                                    <option value="5">S1 TI B</option>
                                    <option value="6">S1 TI RPL</option>
                                    <option value="7">S1 TI KCV</option>
                                    <option value="7">S1 TI KBJ</option>
                                    <option value="12">Teknik Informatika</option>
                                @endif
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">SKS <span class="text-danger">*</span></label>
                            <select name="sks" class="form-select @error('sks') is-invalid @enderror">
                                <option value="" selected disabled> Pilih SKS </option>
                                <option value="1" {{ old('sks') == 1 ? 'selected' : '' }}>1 SKS</option>
                                <option value="2" {{ old('sks') == 2 ? 'selected' : '' }}>2 SKS</option>
                                <option value="3" {{ old('sks') == 2 ? 'selected' : '' }}>3 SKS</option>
                                <option value="4" {{ old('sks') == 2 ? 'selected' : '' }}>4 SKS</option>
                            </select>
                            @error('sks')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="semester_id" class="form-label">Semester <span class="text-danger">*</span></label>
                            <select name="semester_id" class="form-select @error('semester_id') is-invalid @enderror">
                                <option value="">- Belum Dipilih</option>
                                @foreach ($semesters as $semesterr)
                                    <option value="{{ $semesterr->id }}"
                                        {{ old('semester_id') == $semesterr->id ? 'selected' : null }}>
                                        {{ $semesterr->semester }} {{ $semesterr->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                            @error('semester_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="nip_dosen" class="form-label">Dosen <span class="text-danger">*</span></label>
                            <select name="nip_dosen" id="dosenmatkul1"
                                class="form-select @error('nip_dosen') is-invalid @enderror">
                                <option value="">- Belum Dipilih</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->nama }}"
                                        {{ old('nip_dosen') == $dosen->nama ? 'selected' : null }}>{{ $dosen->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nip_dosen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="dosen_2" class="form-label">Dosen</label>
                            <select name="dosen_2" id="dosenmatkul2"
                                class="form-select @error('dosen_2') is-invalid @enderror">
                                <option value="">- Belum Dipilih</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->nama }}"
                                        {{ old('dosen_2') == $dosen->nama ? 'selected' : null }}>{{ $dosen->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Hari <span class="text-danger">*</span></label>
                            <select name="hari" class="form-select @error('hari') is-invalid @enderror">
                                <option value="" selected disabled> Pilih Hari </option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                            @error('hari')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3 field">
                            <label class="form-label">Waktu <span class="text-danger">*</span></label>
                            <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
                                value="{{ old('jam') }}">
                            @error('jam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md">

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 1 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_1"
                                class="form-control @error('rps_pertemuan_1') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_1') }}">
                            @error('rps_pertemuan_1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 2 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_2"
                                class="form-control @error('rps_pertemuan_2') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_2') }}">
                            @error('rps_pertemuan_2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 3 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_3"
                                class="form-control @error('rps_pertemuan_3') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_3') }}">
                            @error('rps_pertemuan_3')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 4 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_4"
                                class="form-control @error('rps_pertemuan_4') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_4') }}">
                            @error('rps_pertemuan_4')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 5 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_5"
                                class="form-control @error('rps_pertemuan_5') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_5') }}">
                            @error('rps_pertemuan_5')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 6 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_6"
                                class="form-control @error('rps_pertemuan_6') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_6') }}">
                            @error('rps_pertemuan_6')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 7 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_7"
                                class="form-control @error('rps_pertemuan_7') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_7') }}">
                            @error('rps_pertemuan_7')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 8 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_8"
                                class="form-control @error('rps_pertemuan_8') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_8') }}">
                            @error('rps_pertemuan_8')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="ruangan_id" class="form-label">Ruangan <span class="text-danger">*</span></label>
                            <select name="ruangan_id" id="ruangan"
                                class="form-select @error('ruangan_id') is-invalid @enderror">
                                <option value="">-Pilih-</option>
                                @foreach ($abruangans as $abruangan)
                                    <option value="{{ $abruangan->id }}"
                                        {{ old('ruangan_id') == $abruangan->id ? 'selected' : null }}>
                                        {{ $abruangan->nama_ruangan }}</option>
                                @endforeach
                            </select>
                            @error('ruangan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 field">
                            <label class="form-label">Jenis Matakuliah <span class="text-danger">*</span></label>
                            <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                <option value="W" selected>W</option>
                                <option value="P">P</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 9 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_9"
                                class="form-control @error('rps_pertemuan_9') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_9') }}">
                            @error('rps_pertemuan_9')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 10 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_10"
                                class="form-control @error('rps_pertemuan_10') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_10') }}">
                            @error('rps_pertemuan_10')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 11 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_11"
                                class="form-control @error('rps_pertemuan_11') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_11') }}">
                            @error('rps_pertemuan_11')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 12 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_12"
                                class="form-control @error('rps_pertemuan_12') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_12') }}">
                            @error('rps_pertemuan_12')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 13 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_13"
                                class="form-control @error('rps_pertemuan_13') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_13') }}">
                            @error('rps_pertemuan_13')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 14 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_14"
                                class="form-control @error('rps_pertemuan_14') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_14') }}">
                            @error('rps_pertemuan_14')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 15 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_15"
                                class="form-control @error('rps_pertemuan_15') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_15') }}">
                            @error('rps_pertemuan_15')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Materi Pertemuan 16 (RPS) <span class="text-danger">*</span></label>
                            <input type="text" name="rps_pertemuan_16"
                                class="form-control @error('rps_pertemuan_16') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_16') }}">
                            @error('rps_pertemuan_16')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Kuota <span class="text-danger">*</span> <small>(Ex =
                                    30)</small></label>
                            <input type="number" name="kuota"
                                class="form-control @error('kuota') is-invalid @enderror" value="{{ old('kuota') }}">
                            @error('kuota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success float-right mt-4">Tambah</button>


                    </div>
                </div>

            </div>
        </div>
    </form>

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
        function previewImgmhs() {

            const imgPreviewmhs = document.querySelector('.img-preview-mhs');

            imgPreviewmhs.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(imagemhs.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreviewmhs.src = oFREvent.target.result;
            }

        }
    </script>
@endpush()
