@extends('layouts.main')

@section('title')
    Tambah Mahasiswa | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Mahasiswa
@endsection

@section('content')

<div class="col-lg-5">
    <form action="{{url ('/mahasiswa/create')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim') }}">
            @error('nim')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>  

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
            @error('nama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{ old('angkatan') }}">
            @error('angkatan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($prodis as $prodi)
                    <option value="{{$prodi->id}}" {{old('prodi_id') == $prodi->id ? 'selected' : null}}>{{$prodi->nama_prodi}}</option>
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="konsentrasi_id" class="form-label">Konsentrasi</label>
            <select name="konsentrasi_id" class="form-select @error('konsentrasi_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($konsentrasis as $konsentrasi)
                    <option value="{{$konsentrasi->id}}" {{old('konsentrasi_id') == $konsentrasi->id ? 'selected' : null}}>{{$konsentrasi->nama_konsentrasi}}</option>
                @endforeach
            </select>
            @error('konsentrasi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
            @error('password')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 
{{-- 
        <div class="mb-3">
            <label for="imgmhs" class="form-label">Foto Mahasiswa</label>
            <img class="img-preview-mhs img-fluid mb-3 col-sm-5">
            <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="imgmhs" name="gambar" onchange="previewImgmhs()">
            @error('gambar')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> --}}

        <button type="submit" class="btn btn-success mb-5">Submit</button>

      </form>
</div>

@endsection

@push('scripts')
<script>

    function previewImgmhs(){

        const imagemhs = document.querySelector('#imgmhs');
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