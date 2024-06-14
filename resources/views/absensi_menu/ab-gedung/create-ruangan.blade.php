@extends('absensi_menu.main')

@section('title')
    Tambah Ruangan | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Ruangan
@endsection

@section('content')
    <form action="{{ url('/gedung/create-ruangan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card ">
            <div class="card-header bg-dark mb-3">
                Form Tambah Ruangan
            </div>

            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-sm-5">

                        <div class="form-group row justify-content-center">
                            <label for="gedung_id" class="col-sm-5 col-form-label">Gedung</label>
                            <div class="col-sm-7">
                                <select name="gedung_id" class="form-select @error('gedung_id') is-invalid @enderror">
                                    <option value="">- Belum Dipilih</option>
                                    @foreach ($gedungs as $gedung)
                                        <option value="{{ $gedung->id }}"
                                            {{ old('gedung_id') == $gedung->id ? 'selected' : null }}>
                                            {{ $gedung->nama_gedung }}</option>
                                    @endforeach
                                </select>
                                @error('gedung_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <label for="nama_ruangan" class="col-sm-5 col-form-label">Ruangan</label>
                            <div class="col-sm-7">
                                <input name="nama_ruangan" class="form-control @error('nama_ruangan') is-invalid @enderror"
                                    rows="2" placeholder="Ruangan">{{ old('nama_ruangan') }}</input>
                                @error('nama_ruangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <button type="submit"
                        class="col-sm-2 btn px-3 py-2 mt-3 btn-success justify-content-center">Tambah</button>
                </div>

            </div>
        </div>
    </form>
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
