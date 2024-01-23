@extends('layouts.main')

@php
    Use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Edit Barang
@endsection

@section('sub-title')
    Edit Barang
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <!-- Button trigger modal -->
<div class="card">
            <div class="card-header bg-dark" class="col-sm-6">
              <h5 class="card-title" id="exampleModalLabel">Form Edit Barang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              </button>
            </div>
            <form action="{{ route('updatebarangplp', $barang->id) }}" method="POST">
              @method('put')
              @csrf
            <div class="card-body row justify-content-center">
                <div class="form-group col-sm-6">
                  <div class="form-group row justify-content-center">
                    <label for="lokasi" class="col-sm-5 col-form-label">Kode Barang</label>
                    <div class="col-sm-7">
                      <input type="lokasi" class="form-control" value="{{ $barang->kode_barang }}" name="kode_barang">
                    </div>
                  </div>
                  <div class="form-group row justify-content-center">
                    <label for="lokasi" class="col-sm-5 col-form-label">Nama Barang</label>
                    <div class="col-sm-7">
                      <input type="lokasi" class="form-control" value="{{ $barang->nama_barang }}" name="nama_barang">
                    </div>
                  </div>
                  <div class="form-group row justify-content-center">
                    <label for="lokasi" class="col-sm-5 col-form-label">Jumlah</label>
                    <div class="col-sm-7">
                      <input type="lokasi" class="form-control" value="{{ $barang->jumlah }}" name="jumlah">
                    </div>
                  </div>
                  <div class="modal-footer justify-content-center">
                    <button class="btn btn-success px-3 py-2 mt-3" type="submit">Update Barang</button>
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
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->




<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="#">( Ahmad Fajri )</a></p>
        </div>
</section>
@endsection