@extends('layouts.main')
@section('title')
    SITEI | Form Usulan Progress
@endsection

@section('sub-title')
    Form Usulan Progress
@endsection
@section('content')
    <div class="">
        <a href="{{ url()->previous() }}" class="btn btn-success py-1 px-2 mb-4"><i class="fas fa-arrow-left fa-xs"></i>
            Kembali
            <a>
    </div>
    <div class="">
        <div class="row pb-5">
            <div class="col-lg-8">
                <div class="dokumen-card">
                    <div>
                        <h2>Laporan Kemajuan</h2>
                        <div class="divider-green"></div>
                    </div>

                    @if ($proposal)
                        <form action="/progress/proposalupdate" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        @else
                            <form action="/progress/proposal" method="POST" enctype="multipart/form-data">
                                @csrf
                    @endif
                    <div class="row">


                        <div class="mb-3 field">
                            <label class="form-label pb-0">Bimbingan Ke</label>
                            <input type="int" name="bimbingan_ke" class="form-control" value="{{ $bimbingan_ke }}"
                                readonly>
                        </div>

                        <div class="mb-3 field">
                            <label class="form-label pb-0">Diskusi</label>
                            <textarea type="text" name="diskusi" class="form-control form-control-lg"></textarea>
                        </div>

                        <div class="mb-3 field">
                            <label for="formFile" class="form-label float-start">File Proposal <small
                                    class="text-secondary">(Format .pdf | Maks. 5 MB) </small></label>

                            <input name="naskah" class="form-control " type="file" id="formFile">
                            @error('naskah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 field">
                            <label for="formFile" class="form-label float-start">Link Proposal <small
                                    class="text-secondary">(Upload Goggle Drive) </small></label>
                            <input name="link" class="form-control" id="formFile">
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                </div>
                
            </div>


            <div class="col-lg-4">
                <div class="dokumen-card">
                    <div>
                        <h2>Detail Skripsi</h2>
                        <div class="divider-green"></div>
                    </div>

                    <div class="mb-3 field">

                        <label class="form-label ">BAB 1 <small class="text-secondary"> (Centang Bila
                                Selesai)</small></label> <br />

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input " name="bab1[]" value="Latar Belakang">Latar
                            Belakang <br />
                            <input type="checkbox" class="form-check-input " name="bab1[]"
                                value="Perumusan Masalah">Perumusan Masalah <br />
                            <input type="checkbox" class="form-check-input " name="bab1[]" value="Tujuan Penelitian">Tujuan
                            Penelitian <br />
                            <input type="checkbox" class="form-check-input " name="bab1[]" value="Batasan Masalah">Batasan
                            Masalah <br />
                            <input type="checkbox" class="form-check-input " name="bab1[]"
                                value="Manfaat Penelitian">Manfaat Penelitian <br />
                            <input type="checkbox" class="form-check-input " name="bab1[]"
                                value="Sistematika Penelitian">Sistematika Penelitan <br />
                        </div>
                    </div>

                    <div class="mb-3 field">

                        <label class="form-label ">BAB 2 <small class="text-secondary"> (Centang Bila
                                Selesai)</small></label> <br />
                        <div class="form-check">

                            <input type="checkbox" class="form-check-input " name="bab2[]"
                                value="Penelitian Terdahulu">Penelitian Terdahulu <br />
                            <input type="checkbox" class="form-check-input " name="bab2[]" value="Teori Pendukung">Teori
                            Pendukung <br />
                        </div>
                    </div>

                    <div class="mb-3 field">

                        <label class="form-label ">BAB 3 <small class="text-secondary"> (Centang Bila
                                Selesai)</small></label> <br />
                        <div class="form-check">

                            <input type="checkbox" class="form-check-input " name="bab3[]" value="Metode Penelitian">Metode
                            Penelitian <br />
                            <input type="checkbox" class="form-check-input " name="bab3[]"
                                value="Metode Pengembangan">Metode Pengembangan / Tahapan Penelitian<br />
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <a href="#ModalApprove" data-toggle="modal" class="btn mt-4 btn-lg btn-success ">Usulkan
                    Progress</a>
    </div>



    <div class="modal fade" id="ModalApprove">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-sm">
                <div class="modal-body">
                    <div class="container px-5 pt-5 pb-2">
                        <h3 class="text-center">Apakah Anda Yakin?</h3>
                        <p class="text-center">Jika belum, silahkan cek kembali Data yang akan Anda Kirim.
                        </p>
                        <div class="row text-center">
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn p-2 px-3 btn-secondary"
                                    data-dismiss="modal">Tidak</button>
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
    </form>
@endsection
