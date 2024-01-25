@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Edit Barang
@endsection

@section('sub-title')
    Tambah Barang
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-dark" class="col-sm-6">
            <h5 class="card-title" id="exampleModalLabel">Form Tambah Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <form action="{{ route('stokbaruplp') }}" method="POST">
            @csrf
            <div class="card-body row justify-content-center">
                <div class="form-group col-sm-6">
                    <div class="form-group row justify-content-center">
                        <label for="lokasi" class="col-sm-5 col-form-label">Kode Barang</label>
                        <div class="col-sm-7">
                            <input type="lokasi" class="form-control" name="kode_barang" required>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="lokasi" class="col-sm-5 col-form-label">Nama Barang</label>
                        <div class="col-sm-7">
                            <input type="lokasi" class="form-control" name="nama_barang" required>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="lokasi" class="col-sm-5 col-form-label">Jumlah</label>
                        <div class="col-sm-7">
                            <input type="lokasi" class="form-control" name="jumlah" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn btn-success px-3 py-2 mt-3" type="submit">Tambah Barang</button>
                    </div>
                </div>
            </div>
        </form>

    </div><!-- /.container-fluid -->
    </div>
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->


    </div>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold"
                    formtarget="_blank" target="_blank" href="#">( Ahmad Fajri )</a></p>
        </div>
    </section>
@endsection
