@extends('layouts.main')

@section('title')
    SITEI | Usulan Judul Skripsi
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
            <label class="form-label pb-0">Judul Skripsi<span class="text-danger">*</span></label>
            <input type="text" name="judul_skripsi" class="form-control @error ('judul_skripsi') is-invalid @enderror" value="{{ old('judul_skripsi') }}" required autofocus>
            @error('judul_skripsi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div> 
    <div class="mb-3">
            <label for="formFile" class="form-label pb-0">KRS Semester Berjalan<span class="text-danger">*</span><small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small> </label>
            <input name="krs_berjalan" class="form-control @error ('krs_berjalan') is-invalid @enderror" value="{{ old('krs_berjalan') }}" type="file" id="formFile" required>

            @error('krs_berjalan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label pb-0">Kartu Hasil Studi<span class="text-danger">*</span><small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small> </label>
            <input name="khs" class="form-control @error ('khs') is-invalid @enderror" value="{{ old('khs') }}" type="file" id="formFile" required>

            @error('khs')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="formFile" class="form-label pb-0">Transkip Nilai<span class="text-danger">*</span><small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small> </label>
            <input name="transkip_nilai" class="form-control @error ('transkip_nilai') is-invalid @enderror" value="{{ old('transkip_nilai') }}" type="file" id="formFile" required>

            @error('transkip_nilai')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
    <div class="mb-3">
            <label for="pembimbing_1" class="form-label pb-0">Pembimbing 1<span class="text-danger">*</span></label>
            <select name="pembimbing_1_nip" id="pembimbing_1_nip" class="form-select @error('pembimbing_1_nip') is-invalid @enderror" required>
                <option value="">- Pilih Pembimbing 1 -</option>
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
                <option value="">- Pilih Pembimbing 2 -</option>
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
        
        <a href="#ModalApprove"  data-toggle="modal" class="btn mt-4 btn-lg btn-success float-right">Usulkan Judul</a>  
                            <div class="modal fade"id="ModalApprove">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow-sm">
                                      <div class="modal-body">
                                        <div class="container px-5 pt-5 pb-2">
                                          <h3 class="text-center">Apakah Anda Yakin?</h3>
                                        <p class="text-center">Jika belum, silahkan cek kembali Data yang akan Anda Kirim.</p>
                                         <div class="row text-center">
                                              <div class="col-3">
                                              </div>
                                              <div class="col-3">
                                               <button type="button" class="btn p-2 px-3 btn-secondary" data-dismiss="modal">Tidak</button>
                                              </div>
                                              <div class="col-3">
                                              <button type="submit" class="btn btn-success py-2 px-3">Usulkan</button>
                                              </div>
                                              <div class="col-3">
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

        

                   
            </div>

        </div>
    </div>
</form>




@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
</section>
@endsection
