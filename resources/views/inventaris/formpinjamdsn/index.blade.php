@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Usulan Peminjaman Barang
@endsection

@section('sub-title')
    Usulan Peminjaman Barang
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container">


            <!-- <ol class="breadcrumb col-lg-12">
        <li class="breadcrumb-item"><a class="breadcrumb-item active fw-bold text-black" href="/seminar">Usulan Peminjaman</a></li>
    </ol> -->

            <div class="card">
                <div class="card-header bg-dark">
                    Form Usulan
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-5">
                            <form action="{{ url('/inventaris/usulan-dosen') }}" method="POST" class="mx-auto"
                                id="input-form">
                                @csrf
                                <div class="form-group row justify-content-center">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label">Tujuan</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="tujuan" required autofocus>
                                            <option selected>Select</option>
                                            <option value="Perkuliahan">Perkuliahan</option>
                                            <option value="Rapat">Rapat</option>
                                            <option value="Lainnya">Seminar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <label for="lokasi" class="col-sm-5 col-form-label">Lokasi</label>
                                    <div class="col-sm-7">
                                        <input type="lokasi" class="form-control" id="inputEmail3" placeholder="Lokasi"
                                            name="ruangan" required>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label">Jaminan</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="jaminan" required>
                                            <option selected>Select</option>
                                            <option value="KTM">KTM</option>
                                            <option value="KTP">KTP</option>
                                            <option value="SIM">SIM</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="product_row1" class="form-group row justify-content-center">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 1</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="barang_satu" id="barang_satu" required>
                                            <option value="">Pilih Barang</option>
                                            @foreach ($nama_barang as $barangs)
                                                <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="product_row1" class="form-group row justify-content-center">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 2</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="barang_dua" id="barang_dua">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($nama_barang as $barangs)
                                                <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="product_row1" class="form-group row justify-content-center">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 3</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="barang_tiga" id="barang_tiga">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($nama_barang as $barangs)
                                                <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <button type="submit"
                            class="col-sm-2 btn px-3 py-2 mt-3 btn-success justify-content-center">Usulkan</button>
                    </div>
                    </form>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->


    </div>
    <!-- ./wrapper -->
    <script>
        $(document).ready(function() {
            $('select').on('change', function(event) {
                var prevValue = $(this).data('previous');
                $('select').not(this).find('option[value="' + prevValue + '"]').show();
                var value = $(this).val();
                $(this).data('previous', value);
                $('select').not(this).find('option[value="' + value + '"]').hide();
            });
        });
    </script>
    <!-- REQUIRED SCRIPTS -->


    {{-- <!-- jQuery -->
<script src="https://sitei.ft.unri.ac.id/assets/plugins/jquery/jquery.min.js"></script>
<script src="https://sitei.ft.unri.ac.id/assets/dataTables/datatables.min.js"></script>
<script type="text/javascript">$('#datatables').DataTable();
</script>

<!-- Bootstrap 4 -->
<script src="https://sitei.ft.unri.ac.id/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://sitei.ft.unri.ac.id/assets/dist/js/adminlte.min.js"></script>
<script src="https://sitei.ft.unri.ac.id/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://sitei.ft.unri.ac.id/assets/dist/js/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <!-- jQuery -->
    <script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/dataTables/datatables.min.js') }}"></script>
    <script type="text/javascript">
        $('#datatables').DataTable();
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
<br>
<br>
<br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                        class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                        target="_blank" href="/developer/ahmad-fajri">Ahmad Fajri, </a>
                    <a class="text-success" formtarget="_blank" target="_blank"
                        href="/developer/yabes-maychel">Yabes Maychel </a> <span
                        class="text-success">&</span>
                    <a class="text-success" formtarget="_blank" target="_blank" href="/developer/yasmine"> Yasmine R.A.S Vadri</a><span class="text-success fw-bold">)</span></small></p>
        </div>
    </section>
@endsection
