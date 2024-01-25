@extends('layouts.main')

@section('title')
    Edit Profile | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Profile
@endsection

@section('content')
    <div class="col-lg-5">
        <form action="/profil-mhs/editfotomhs/{{ $mhs->id }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="mb-3">
                <label for="imgmhs" class="form-label">Foto Mahasiswa</label>
                <input type="hidden" name="oldImagemhs" value="{{ $mhs->gambar }}">
                @if ($mhs->gambar)
                    <img src="{{ asset('storage/' . $mhs->gambar) }}"
                        class="img-preview-mhs img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview-mhs img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="imgmhs"
                    name="gambar" onchange="previewImgmhs()">
                @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mb-5">Update</button>

        </form>
    </div>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <span
                    class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank"
                    href="https://fahrilhadi.com"> Fahril Hadi</a> <span class="text-success fw-bold"> & </span>
                <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                    href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                    class="text-success fw-bold">)</span>
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function previewImgmhs() {

            const imagemhs = document.querySelector('#imgmhs');
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
