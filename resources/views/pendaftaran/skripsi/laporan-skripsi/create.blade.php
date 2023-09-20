@extends('layouts.main')

@section('title')
    Daftar KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Bukti Penyerahan Buku Skripsi
@endsection

@section('content')

@foreach ($pendaftaran_skripsi as $skripsi)

<form action="/penyerahan-buku-skripsi/create/{{$skripsi->id}}" method="POST" enctype="multipart/form-data">
                            @method('put')
                                    @csrf
                                <div>
                                <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label float-start">Buku Skripsi <small class="text-secondary">( Format .pdf | Maks. 10 MB ) </small> </label>
                                        <input name="buku_skripsi_akhir" class="form-control @error ('buku_skripsi_akhir') is-invalid @enderror" value="{{ old('buku_skripsi_akhir') }}" type="file" id="formFile" required autofocus>

                                        @error('buku_skripsi_akhir')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                </div>

                                 <div class="mb-3">
                                        <label for="formFile" class="form-label float-start">STI-17/Bukti Penyerahan Buku Skripsi <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small></label>
                                        <input name="sti_17" class="form-control @error ('sti_17') is-invalid @enderror" value="{{ old('sti_17') }}" type="file" id="formFile" required >

                                        @error('sti_17')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                </div>
                                 <div class="mb-3">
                                        <label for="formFile" class="form-label float-start">STI-29/ Bukti Sudah Daftar Wisuda di Fakultas <small class="text-secondary">( Format .pdf .jpeg .png .jpg | Maks. 200 KB ) </small></label>
                                        <input name="sti_29" class="form-control @error ('sti_29') is-invalid @enderror" value="{{ old('sti_29') }}" type="file" id="formFile" required >

                                        @error('sti_29')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                </div>
 
                                    <button type="submit" class="btn btn-success  mt-4 float-end">Kirim</button>        
                                        </div>

                                    </div>
                                </div>
                            </form>

@endforeach
@endsection
