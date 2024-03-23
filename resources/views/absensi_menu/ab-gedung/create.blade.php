@extends('layouts.main')

@section('title')
    Tambah Lokasi Gedung | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Lokasi Gedung
@endsection

@section('content')

<form action="{{url ('/gedung/create')}}" method="POST" enctype="multipart/form-data">
        @csrf
<div class="card ">
    <div class="card-header bg-dark mb-3">
        Form Tambah Lokasi Gedung
    </div>
    
    <div class="card-body">
    <div class="row justify-content-center">

    <div class="col-sm-5">

        <div class="form-group row justify-content-center">
            <label for="nama_gedung" class="col-sm-5 col-form-label">Gedung</label>
            <div class="col-sm-7">
                <input name="nama_gedung" class="form-control @error('nama_gedung') is-invalid @enderror" rows="2" placeholder="Gedung">{{ old('nama_gedung') }}</input>
            @error('nama_gedung')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
        </div> 

        <div class="form-group row justify-content-center">
            <label for="koordinat_longitude" class="col-sm-5 col-form-label">Titik Longitude</label>
            <div class="col-sm-7">
                <input name="koordinat_longitude" class="form-control @error('koordinat_longitude') is-invalid @enderror" rows="2" placeholder="Titik Longitude">{{ old('koordinat_longitude') }}</input>
            @error('koordinat_longitude')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
        </div> 

        <div class="form-group row justify-content-center">
            <label for="koordinat_latitude" class="col-sm-5 col-form-label">Titik Latitude</label>
            <div class="col-sm-7">
                <input name="koordinat_latitude" class="form-control @error('koordinat_latitude') is-invalid @enderror" rows="2" placeholder="Titik Latitude">{{ old('koordinat_latitude') }}</input>
            @error('koordinat_latitude')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
        </div> 

    </div>
    </div>

    <div class="form-group row justify-content-center">
        <button type="submit" class="col-sm-2 btn px-3 py-2 mt-3 btn-success justify-content-center">Tambah</button>
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
                        target="_blank" href="/developer/ahmad-fajri">Imperia Prestise Sinaga </a>)
        </div>
    </section>
@endsection
@push('scripts')
<script>

    function previewImgmhs(){

        const imgPreviewmhs = document.querySelector('.img-preview-mhs');

        imgPreviewmhs.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(imagemhs.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreviewmhs.src = oFREvent.target.result;            
        }

    }

</script>
@endpush()