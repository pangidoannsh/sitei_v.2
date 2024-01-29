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

            <div class="card">
                <div class="card-header bg-dark">
                    Edit Usulan
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-sm-5">
                            <form action="{{ url('inventaris/update/' . $pinjaman->id) }}" method="POST" class="mx-auto"
                                id="input-form">
                                @csrf
                                <div class="form-group row justify-content-center">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label">Tujuan</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="tujuan">
                                            <option selected>{{ $pinjaman->tujuan }}</option>
                                            <option value="Perkuliahan">Perkuliahan</option>
                                            <option value="Rapat">Rapat</option>
                                            <option value="Lainnya">Lainnya</option>\
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <label for="lokasi" class="col-sm-5 col-form-label">Lokasi</label>
                                    <div class="col-sm-7">
                                        <input type="lokasi" class="form-control" id="ruangan" placeholder="Lokasi"
                                            name="ruangan" value="{{ $pinjaman->ruangan }}">
                                    </div>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <label for="inputPassword3" class="col-sm-5 col-form-label">Jaminan</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="jaminan">
                                            <option selected>{{ $pinjaman->jaminan }}</option>
                                            <option value="KTM">KTM</option>
                                            <option value="KTP">KTP</option>
                                            <option value="SIM">SIM</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="product_row1" class="form-group row justify-content-center">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 1</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="barang_satu">
                                            @foreach ($nama_barang as $barangs)
                                                @if (old('barang_satu', $pinjaman->barang_satu) == $barangs->id)
                                                    <option value="{{ $barangs->id }}" selected>{{ $barangs->nama_barang }}
                                                    </option>
                                                @else
                                                    <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="product_row1" class="form-group row justify-content-center">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 2</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="barang_dua">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($nama_barang as $barangs)
                                                @if (old('barang_dua', $pinjaman->barang_dua) == $barangs->id)
                                                    <option value="{{ $barangs->id }}" selected>{{ $barangs->nama_barang }}
                                                    </option>
                                                @else
                                                    <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="product_row1" class="form-group row justify-content-center">
                                    <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Barang 3</label>
                                    <div class="col-sm-7">
                                        <select class="custom-select" name="barang_tiga">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($nama_barang as $barangs)
                                                @if (old('barang_tiga', $pinjaman->barang_tiga) == $barangs->id)
                                                    <option value="{{ $barangs->id }}" selected>
                                                        {{ $barangs->nama_barang }}</option>
                                                @else
                                                    <option value="{{ $barangs->id }}">{{ $barangs->nama_barang }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <button type="submit" class="col-sm-2 btn btn-success justify-content-center">Usulkan
                            Ulang</button>
                    </div>
                    </form>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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
