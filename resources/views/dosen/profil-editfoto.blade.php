@extends('layouts.main')

@section('title')
    Edit Profile | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Profile
@endsection

@section('content')

<div class="col-lg-5">
    <form action="/profil-dosen/editfotodsn/{{$dosen->id}}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="mb-3">
            <label for="imgdosen" class="form-label">Foto Dosen</label>
            <input type="hidden" name="oldImagedsn" value="{{$dosen->gambar}}">
            @if ($dosen->gambar)
            <img src="{{asset('storage/'. $dosen->gambar)}}" class="img-preview-dsn img-fluid mb-3 col-sm-5 d-block">                
            @else
            <img class="img-preview-dsn img-fluid mb-3 col-sm-5">                
            @endif
            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="imgdosen" name="gambar" onchange="previewImgdosen()">
            @error('gambar')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mb-5">Update</button>

      </form>
</div>

@endsection

@push('scripts')
<script>

    function previewImgdosen(){

        const imagedosen = document.querySelector('#imgdosen');
        const imgPreviewdsn = document.querySelector('.img-preview-dsn');

        imgPreviewdsn.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(imagedosen.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreviewdsn.src = oFREvent.target.result;            
        }

    }

</script>
@endpush()