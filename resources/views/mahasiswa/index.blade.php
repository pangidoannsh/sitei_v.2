@extends('layouts.main')

@section('title')
    Daftar Mahasiswa | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Mahasiswa
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <a href="{{ url('/mahasiswa/create') }}" class="btn mahasiswa btn-success mb-3">+ Mahasiswa</a>

    <div class="container card p-4">
        
        @php
        // Inisialisasi array untuk menyimpan angkatan yang unik
        $unique_angkatan = [];

        // Loop melalui setiap mahasiswa dan menyimpan angkatan yang unik ke dalam array
        foreach ($mahasiswas as $mhs) {
            $unique_angkatan[] = $mhs->angkatan;
        }

        // Hilangkan duplikat angkatan dan urutkan
        $unique_angkatan = array_unique($unique_angkatan);
        sort($unique_angkatan);
        @endphp

        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuDaftarMahasiswaAdminProdi">Tampilkan</label>
                    <select id="lengthMenuDaftarMahasiswaAdminProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="angkatanFilterDaftarMahasiswaAdminProdi">Angkatan</label>
                    <select id="angkatanFilterDaftarMahasiswaAdminProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($unique_angkatan as $angkatan)
                            <option value="{{ $angkatan }}">{{ $angkatan }}</option>
                        @endforeach
                    </select>
                </div>                                
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterDaftarMahasiswaAdminProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilterDaftarMahasiswaAdminProdi" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileDaftarMahasiswaAdminProdi">Tampilkan</label>
                <select id="lengthMenuMobileDaftarMahasiswaAdminProdi" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
            <div class="input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="angkatanFilterMobileDaftarMahasiswaAdminProdi">Angkatan</label>
                <select id="angkatanFilterMobileDaftarMahasiswaAdminProdi" class="custom-select custom-select-md rounded-3 py-1 text-capitalize" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($unique_angkatan as $angkatan)
                        <option value="{{ $angkatan }}">{{ $angkatan }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileDaftarMahasiswaAdminProdi">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileDaftarMahasiswaAdminProdi" placeholder="">
            </div>
        </div>

        <table class="table table-responsive-lg text-center table-bordered table-striped" style="width:100%" id="datatablesdaftarmhsadmprodi">
            <thead class="table-dark">
                <tr>
                    <!--<th class="text-center" scope="col">#</th>-->
                    <th class="text-center" scope="col">NIM</th>
                    <th class="text-center" scope="col">Nama</th>
                    <th class="text-center" scope="col">Angkatan</th>
                    <th class="text-center" scope="col">Program Studi</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mhs)
                    <tr>
                        <!--<td>{{ $loop->iteration }}</td>-->
                        <td>{{ $mhs->nim }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $mhs->angkatan }}</td>
                        <td>{{ $mhs->prodi->nama_prodi }}</td>
                        <td class="text-center">
                            <a href="/mahasiswa/edit/{{ $mhs->id }}" class="badge bg-warning p-2"><i
                                    class="fas fa-pen"></i></a>
                            </form>
                        </td>
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
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <span
                    class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank"
                    href="https://fahrilhadi.com"> Fahril Hadi</a> <span class="text-success fw-bold"> & </span>
                <a class="text-success fw-bold" formtarget="_blank" target="_blank"
                    href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span
                    class="text-success fw-bold">)</span>
            </p>
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
    </script>
@endpush()
