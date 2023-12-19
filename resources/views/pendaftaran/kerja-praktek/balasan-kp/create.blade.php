@extends('layouts.main')

@section('title')
    SITEI | Surat Balasan Perusahaan
@endsection

@section('sub-title')
    Surat Balasan Perusahaan
@endsection

@section('content')

@foreach ($pendaftaran_kp as $kp)

<form action="/balasankp/create/{{$kp->id}}" method="POST" enctype="multipart/form-data">
@method('put')
        @csrf
    <div>
    <div class="row ">

    <div class="col-12">

    <div class="mb-3">
            <label for="formFile" class="form-label">Surat Balasan Perusahaan<span class="text-danger">*</span> <small class="text-secondary">( Format .pdf | Maks. 200 KB ) </small></label>
            <input name="surat_balasan" class="form-control @error ('surat_balasan') is-invalid @enderror" value="{{ old('surat_balasan') }}" type="file" id="formFile" required autofocus>

            @error('surat_balasan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
    </div>
                
        <div class="mb-3 field">
            <label class="form-label">Tanggal Mulai KP<span class="text-danger">*</span></label>
            <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}" required>
            @error('tanggal_mulai')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        
        <a href="#ModalApprove"  data-toggle="modal" class="btn mt-4 btn-lg btn-success float-right">Kirim</a>  
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
                                              <button type="submit" class="btn btn-success py-2 px-3">Kirim</button>
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



@endforeach
@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
</section>
@endsection
