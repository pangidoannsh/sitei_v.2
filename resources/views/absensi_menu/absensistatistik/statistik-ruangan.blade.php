@extends('absensi_menu.main')

@section('title')
    Statistik Ruangan Perkuliahan | SIA ELEKTRO
@endsection

@section('sub-title')
    Statistik Ruangan Perkuliahan
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif
    <div>
        <div class="container card p-4">
            <ol class="breadcrumb col-lg-12">
                @if (Auth::user()->role_id == 1 ||
                        Auth::user()->role_id == 2 ||
                        Auth::user()->role_id == 3 ||
                        Auth::user()->role_id == 4)
                    <li><a href="{{ route('absensistatistikadmin') }}" class="px-1">Statistik Absensi (<span
                                id="absensiCount"></span>)</a></li>
                @else
                    <li><a href="{{ route('absensistatistik') }}" class="px-1">Statistik Absensi (<span
                                id="absensiCount"></span>)</a></li>
                @endif
                <span class="px-2">|</span>
                <li><a href="{{ route('statistik-ruangan') }}" class="breadcrumb-item fw-bold text-success px-1">Ruangan
                        (<span id="ruanganCount"></span>)</a></li>
            </ol>
            <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%"
                id="datatables">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">No.</th>
                        <th class="text-center" scope="col">Gedung</th>
                        <th class="text-center" scope="col">Ruangan</th>
                        <th class="text-center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statistikRuangan as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td> <!-- Nomor urutan -->
                            <td>{{ $data['gedung'] }}</td> <!-- Nama gedung -->
                            <td>{{ $data['ruangan'] }}</td> <!-- Nama ruangan -->
                            <td class="{{ $data['status'] == 'Sedang Digunakan' ? 'bg-success' : '' }}">
                                {{ $data['status'] }}</td> <!-- Status ruangan -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            // Lakukan permintaan AJAX ke endpoint statistik ruangan
            $.ajax({
                url: "{{ route('statistik-ruangan') }}",
                type: "GET",
                success: function(response) {
                    // Berhasil mendapatkan data, tambahkan data ke dalam tabel
                    $.each(response, function(index, data) {
                        var row = "<tr>" +
                            "<td>" + (index + 1) + "</td>" +
                            "<td>" + data.gedung + "</td>" +
                            "<td>" + data.ruangan + "</td>" +
                            "<td>" + data.status + "</td>" +
                            "</tr>";
                        $("#datatables tbody").append(row);
                    });
                },
                error: function(xhr, status, error) {
                    // Gagal mendapatkan data, tampilkan pesan error
                    console.error(error);
                }
            });
        });

        $(document).ready(function() {
            // Menghitung jumlah baris dalam tabel
            var rowCount = $('#datatables tbody tr').length;

            // Memperbarui nilai pada elemen dengan id 'mataKuliahCount'
            $('#ruanganCount').text(rowCount);
        });
    </script>
@endpush
