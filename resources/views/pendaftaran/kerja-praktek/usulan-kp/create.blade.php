@extends('layouts.main')

@section('title')
    Daftar KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Pendaftaran Kerja Praktek
@endsection

<style>

  @media screen and (max-width: 768px){

  }
  </style>

@section('content')
@if (Str::length(Auth::guard('mahasiswa')->user()) > 0)
<div class="container-fluid">
<form action="{{url ('/usulankp/create')}}" method="POST" enctype="multipart/form-data">
        @csrf

<div class="container ">
    <div class="mb-2 field">
            <label class="form-label mb-2 ">Perusahaan/Instansi</label>
            <input type="text" name="nama_perusahaan"  class="form-control @error ('nama_perusahaan') is-invalid @enderror" value="{{ old('nama_perusahaan') }}" required autofocus>
            @error('nama_perusahaan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>  

        <div class="mb-2 field">
            <label class="form-label mb-2">Alamat Perusahaan</label>
            <input type="text" name="alamat_perusahaan" class="form-control @error('alamat_perusahaan') is-invalid @enderror" value="{{ old('alamat_perusahaan') }}" required>
            @error('alamat_perusahaan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-2 field">
            <label class="form-label mb-2">Bidang Usaha/Kegiatan</label>
            <input type="text" name="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" value="{{ old('bidang_usaha') }}" required>
            @error('bidang_usaha')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

            <div class="mb-2">
            <label for="formFile" class="form-label mb-2 float-start">KRS Semester Berjalan <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small></label> 
            <input name="krs_berjalan" class="form-control @error ('krs_berjalan') is-invalid @enderror" value="{{ old('krs_berjalan') }}" type="file" id="formFile" required >
<!-- old tidak bisa di pakai disini karna pertimbangan security, jgn sampai org tau directory kita -->
            @error('krs_berjalan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-2">
            <label for="formFile" class="form-label mb-2 float-start">Transkip Nilai <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small></label>
            <input name="transkip_nilai" class="form-control @error ('transkip_nilai') is-invalid @enderror" value="{{ old('transkip_nilai') }}" type="file" id="formFile" required>

            @error('transkip_nilai')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>

       <div class="mb-2 field">
            <label for="dosen_pembimbing_nip" class="form-label mb-2">Dosen Pembimbing</label>
            <select name="dosen_pembimbing_nip" id="pembimbing_nip" class="form-select @error('dosen_pembimbing_nip') is-invalid @enderror" required>
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('dosen_pembimbing_nip') == $dosen->nama ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('dosen_pembimbing_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
<div class="mb-2 field">
            <label class="form-label mb-2">Rencana mulai KP</label>
            <input type="date" name="tanggal_rencana" class="form-control @error('tanggal_rencana') is-invalid @enderror" value="{{ old('tanggal_rencana') }}" required>
            @error('tanggal_rencana')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>


<button type="submit" class="btn btn-success mt-3 mb-3 float-end">Usulkan KP</button> 

</div>
</form>
</div>
@endif




@endsection

@push('scripts')
<script>

    $(document).ready(function() {
       $('#mhs').select2();
    });

    $(document).ready(function() {
       $('#pembimbing').select2();
    });

    $(document).ready(function() {
       $('#penguji').select2();
    });

</script>
@endpush