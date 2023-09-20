@extends('layouts.main')

@section('title')
    Daftar KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Usulan Judul Skripsi
@endsection
<style>

  @media screen and (max-width: 768px){

  }
  </style>
@section('content')

<form action="{{url ('/usuljudul/create')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div>
    <div class="row">
    <div class="col">
    <div class="mb-3">
            <label class="form-label pb-0">Judul Skripsi</label>
            <input type="text" name="judul_skripsi" class="form-control @error ('judul_skripsi') is-invalid @enderror" value="{{ old('judul_skripsi') }}" required autofocus>
            @error('judul_skripsi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 
    <div class="mb-3">
            <label for="formFile" class="form-label pb-0">KRS Semester Berjalan <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small> </label>
            <input name="krs_berjalan" class="form-control @error ('krs_berjalan') is-invalid @enderror" value="{{ old('krs_berjalan') }}" type="file" id="formFile" required>

            @error('krs_berjalan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label pb-0">Kartu Hasil Studi <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small> </label>
            <input name="khs" class="form-control @error ('khs') is-invalid @enderror" value="{{ old('khs') }}" type="file" id="formFile" required>

            @error('khs')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label pb-0">Transkip Nilai <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small> </label>
            <input name="transkip_nilai" class="form-control @error ('transkip_nilai') is-invalid @enderror" value="{{ old('transkip_nilai') }}" type="file" id="formFile" required>

            @error('transkip_nilai')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="pembimbing_1" class="form-label pb-0">Pembimbing 1</label>
            <select name="pembimbing_1_nip" id="pembimbing_1_nip" class="form-select @error('pembimbing_1_nip') is-invalid @enderror" required>
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbing_1_nip') == $dosen->nama ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbing_1_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    <div class="mb-3">
            <label for="pembimbing_2" class="form-label pb-0">Pembimbing 2</label>
            <select name="pembimbing_2_nip" id="pembimbing_2_nip" class="form-select @error('pembimbing_2_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbing_2_nip') == $dosen->nama ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbing_2_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        


        <button type="submit" class="btn btn-success  mt-4 float-end">Usulkan Judul</button>

                   
            </div>

        </div>
    </div>
</form>




@endsection
