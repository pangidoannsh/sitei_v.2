@extends('absensi_menu.main')

@section('title')
    Edit Mata Kuliah | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Mata Kuliah
@endsection

@section('content')
    <form action="/matakuliah/edit/{{ $matakuliah->id }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="card">
            <div class="card-header bg-dark mb-3">
                Form Edit Matakuliah
            </div>

            <div class="ml-3 mr-3">
                <p class="alert-warning p-2"><i class="fas fa-exclamation-triangle px-2 fw-bold" aria-hidden="true"></i>
                    Mohon admin memasukkan semua materi pertemuan berdasarkan RPS dosen bersangkutan</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3 field">
                            <label class="form-label">Kode</label>
                            <input type="text" name="kode_mk" class="form-control @error('kode_mk') is-invalid @enderror"
                                value="{{ old('kode_mk', $matakuliah->kode_mk) }}">
                            @error('kode_mk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Mata Kuliah</label>
                            <input type="text" name="mk" class="form-control @error('mk') is-invalid @enderror"
                                value="{{ old('mk', $matakuliah->mk) }}">
                            @error('mk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="prodi_id" class="form-label">Prodi</label>
                            <select name="prodi_id" id="prodi"
                                class="form-select @error('prodi_id') is-invalid @enderror">
                                <option value="">-Belum Dipilih-</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ old('prodi_id', $matakuliah->prodi_id) == $prodi->id ? 'selected' : null }}>
                                        {{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                            @error('prodi_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select name="kelas_id" id="kelas"
                                class="form-select @error('kelas_id') is-invalid @enderror">
                                <option value="">-Belum Dipilih-</option>
                                @foreach ($kelass as $kelas)
                                    <option value="{{ $kelas->id }}"
                                        {{ old('kelas_id', $matakuliah->kelas_id) == $kelas->id ? 'selected' : null }}>
                                        {{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">SKS</label>
                            <select name="sks" class="form-select @error('sks') is-invalid @enderror">
                                <option value="" selected> Pilih SKS </option>
                                <option value="1" {{ old('sks', $matakuliah->sks) == 1 ? 'selected' : '' }}>1 SKS
                                </option>
                                <option value="2" {{ old('sks', $matakuliah->sks) == 2 ? 'selected' : '' }}>2 SKS
                                </option>
                                <option value="3" {{ old('sks', $matakuliah->sks) == 3 ? 'selected' : '' }}>3 SKS
                                </option>
                                <option value="4" {{ old('sks', $matakuliah->sks) == 4 ? 'selected' : '' }}>4 SKS
                                </option>
                            </select>
                            @error('sks')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3 field">
                            <label class="form-label">Semester</label>
                            <select name="semester_id" class="form-select @error('semester_id') is-invalid @enderror">
                                <option value="">-Belum Dipilih-</option>
                                @foreach ($semesters as $semesterr)
                                    <option value="{{ $semesterr->id }}"
                                        {{ old('semester_id', $semesterr->semester_id) == $semesterr->id ? 'selected' : null }}>
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
                            <label for="nip_dosen" class="form-label">Dosen</label>
                            <select name="nip_dosen" class="form-select @error('nip_dosen') is-invalid @enderror"
                                value="{{ old('nip_dosen', $matakuliah->dosen) }}">
                                <option selected>{{ $matakuliah->nip_dosen }}</option>
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
                            <select name="dosen_2" class="form-select @error('dosen_2') is-invalid @enderror"
                                value="{{ old('dosen_2', $matakuliah->dosen) }}">
                                <option value="">-Belum Dipilih-</option>
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
                            <label class="form-label">Hari</label>
                            <select name="hari" class="form-select @error('hari') is-invalid @enderror">
                                <option selected>{{ $matakuliah->hari }}</option>
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
                            <label class="form-label">Waktu</label>
                            <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
                                value="{{ old('jam', $matakuliah->jam) }}">
                            @error('jam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col">
                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 1</label>
                            <input type="text" name="rps_pertemuan_1"
                                class="form-control @error('rps_pertemuan_1') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_1', $matakuliah->rps_pertemuan_1) }}">
                            @error('rps_pertemuan_1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 2</label>
                            <input name="rps_pertemuan_2"
                                class="form-control @error('rps_pertemuan_2') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_2', $matakuliah->rps_pertemuan_2) }}">
                            @error('rps_pertemuan_2')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 3</label>
                            <input type="text" name="rps_pertemuan_3"
                                class="form-control @error('rps_pertemuan_3') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_3', $matakuliah->rps_pertemuan_3) }}">
                            @error('rps_pertemuan_3')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 4</label>
                            <input name="rps_pertemuan_4"
                                class="form-control @error('rps_pertemuan_4') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_4', $matakuliah->rps_pertemuan_4) }}">
                            @error('rps_pertemuan_4')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 5</label>
                            <input name="rps_pertemuan_5"
                                class="form-control @error('rps_pertemuan_5') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_5', $matakuliah->rps_pertemuan_5) }}">
                            @error('rps_pertemuan_5')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 6</label>
                            <input name="rps_pertemuan_6"
                                class="form-control @error('rps_pertemuan_6') is-invalid @enderror" rows="2"
                                value="{{ old('rps_pertemuan_6', $matakuliah->rps_pertemuan_6) }}">
                            @error('rps_pertemuan_6')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 7</label>
                            <input name="rps_pertemuan_7"
                                class="form-control @error('rps_pertemuan_7') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_7', $matakuliah->rps_pertemuan_7) }}">
                            @error('rps_pertemuan_7')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 8</label>
                            <input name="rps_pertemuan_8"
                                class="form-control @error('rps_pertemuan_8') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_8', $matakuliah->rps_pertemuan_8) }}">
                            @error('rps_pertemuan_8')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Ruangan</label>
                            <select name="ruangan_id" id="ruangan"
                                class="form-select @error('ruangan_id') is-invalid @enderror">
                                <option value="">-Belum Dipilih-</option>
                                @foreach ($abruangans as $abruangan)
                                    <option value="{{ $abruangan->id }}"
                                        {{ old('ruangan_id', $matakuliah->ruangan_id) == $abruangan->id ? 'selected' : null }}>
                                        {{ $abruangan->nama_ruangan }}</option>
                                @endforeach
                            </select>
                            @error('abruangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 field">
                            <label class="form-label">Jenis Matakuliah <span class="text-danger">*</span></label>
                            <select name="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                <option value="W" {{ $matakuliah->jenis == 'W' ? 'selected' : '' }}>W</option>
                                <option value="P" {{ $matakuliah->jenis == 'P' ? 'selected' : '' }}>P</option>
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
                            <label class="form-label">RPS Pertemuan 9</label>
                            <input name="rps_pertemuan_9"
                                class="form-control @error('rps_pertemuan_9') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_9', $matakuliah->rps_pertemuan_9) }}">
                            @error('rps_pertemuan_9')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 10</label>
                            <input name="rps_pertemuan_10"
                                class="form-control @error('rps_pertemuan_10') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_10', $matakuliah->rps_pertemuan_10) }}">
                            @error('rps_pertemuan_10')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 11</label>
                            <input name="rps_pertemuan_11"
                                class="form-control @error('rps_pertemuan_11') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_11', $matakuliah->rps_pertemuan_11) }}">
                            @error('rps_pertemuan_11')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 12</label>
                            <input name="rps_pertemuan_12"
                                class="form-control @error('rps_pertemuan_12') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_12', $matakuliah->rps_pertemuan_12) }}">
                            @error('rps_pertemuan_12')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 13</label>
                            <input name="rps_pertemuan_13"
                                class="form-control @error('rps_pertemuan_13') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_13', $matakuliah->rps_pertemuan_13) }}">
                            @error('rps_pertemuan_13')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 14</label>
                            <input name="rps_pertemuan_14"
                                class="form-control @error('rps_pertemuan_14') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_14', $matakuliah->rps_pertemuan_14) }}">
                            @error('rps_pertemuan_14')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 15</label>
                            <input name="rps_pertemuan_15"
                                class="form-control @error('rps_pertemuan_15') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_15', $matakuliah->rps_pertemuan_15) }}">
                            @error('rps_pertemuan_15')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">RPS Pertemuan 16</label>
                            <input name="rps_pertemuan_16"
                                class="form-control @error('rps_pertemuan_16') is-invalid @enderror"
                                value="{{ old('rps_pertemuan_16', $matakuliah->rps_pertemuan_16) }}">
                            @error('rps_pertemuan_16')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label">Kuota <small>(Ex = 30)</small></label>
                            <input type="number" name="kuota"
                                class="form-control @error('kuota') is-invalid @enderror"
                                value="{{ old('kuota', $matakuliah->kuota) }}">
                            @error('kuota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success float-right mt-4">Simpan</button>
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
