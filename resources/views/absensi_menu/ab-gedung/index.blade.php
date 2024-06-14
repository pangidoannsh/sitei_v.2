@extends('absensi_menu.main')

@section('title')
    Gedung | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Gedung
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    @if (Auth::user()->role_id == 1)
        <a href="{{ url('/gedung/create') }}" class="btn mahasiswa btn-success mb-3">+ Gedung</a>
    @else
    @endif

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('/gedung/delete') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah Anda Yakin?</h1>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="gedung_deleted_category" id="gedung_id">
                        <p>Data Yang Dihapus Tidak Akan Kembali!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-success">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container card p-4">

        <ol class="breadcrumb col-lg-12">

            <li><a href="/gedung" class="px-1 fw-bold text-success">Gedung ({{ $jumlah_gedung }})</a></li>
            <span class="px-2">|</span>
            <li><a href="/gedung/ruangan" class="breadcrumb-item  px-1">Ruangan ({{ $jumlah_ruangan }})</a></li>

        </ol>
        <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%"
            id="datatables">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Gedung</th>
                    <th class="text-center" scope="col">Longitude</th>
                    <th class="text-center" scope="col">Latitude</th>
                    @if (Auth::user()->role_id == 1)
                        <th class="text-center" scope="col">Aksi</th>
                    @else
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($gedung as $gdg)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gdg->nama_gedung }}</td>
                        <td>{{ $gdg->koordinat_longitude }}</td>
                        <td>{{ $gdg->koordinat_latitude }}</td>
                        @if (Auth::user()->role_id == 1)
                            <td class="text-center">
                                <a href="/gedung/edit/{{ $gdg->id }}" class="badge bg-warning mb-1"
                                    data-bs-toggle="tooltip"><i class="fas fa-pen"></i></a>
                                <button type="button" class="badge bg-danger border-0 text-center modalDeleted"
                                    value="{{ $gdg->id }}">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </td>
                        @else
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span
                        class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank"
                        target="_blank" href="/developer/ahmad-fajri">Imperia Prestise Sinaga </a>)
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);

        $(document).ready(function() {
            $('.modalDeleted').click(function(e) {
                e.preventDefault();

                var gedung_id = $(this).val();
                $('#gedung_id').val(gedung_id);
                $('#deleteModal').modal('show');
            });
        });
        $(document).ready(function() {
            // Menghitung jumlah baris dalam tabel
            var rowCount = $('#datatables tbody tr').length;

            // Memperbarui nilai pada elemen dengan id 'mataKuliahCount'
            $('#absensiCount').text(rowCount);
        });
    </script>
@endpush()

@push('scripts')
    <script>
        $(document).ready(function() {
            // Fungsi untuk menambah nilai pertemuan di form modal
            function updatePertemuanValue(modal) {
                modal.on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button yang memicu modal
                    var nextPertemuan = button.data(
                        'nomor-pertemuan'); // Dapatkan nilai nomor pertemuan berikutnya
                    $(this).find('.modal-body #pertemuan').val(
                        nextPertemuan); // Perbarui nilai input pertemuan di dalam modal
                });
            }
        });
    </script>
@endpush
