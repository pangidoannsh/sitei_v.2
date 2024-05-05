@extends('layouts.main')

@section('title')
    Daftar Dosen | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Dosen
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <a href="{{ url('/dosen/create') }}" class="btn dosen btn-success mb-4">+ Dosen</a>

    <div class="container card p-4">
        
        @php
            $role_list = [];

            // Ambil role akses dari setiap dosen
            foreach ($dosens as $dosen) {
                // Pastikan role akses tidak null
                if ($dosen->role_id !== null) {
                    $role_list[] = $dosen->role->role_akses;
                }
            }

            // Hapus duplikat role akses
            $role_list = array_unique($role_list);

            // Urutkan role akses
            sort($role_list);
        @endphp

        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuDaftarDosenAdminJurusan">Tampilkan</label>
                    <select id="lengthMenuDaftarDosenAdminJurusan" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>
                <div class="input-group ml-3" style="width: max-content;">
                    <label class="pt-2 pr-2" for="roleFilterDaftarDosenAdminJurusan">Jabatan</label>
                    <select id="roleFilterDaftarDosenAdminJurusan" class="custom-select custom-select-md rounded-3 py-1" style="width: 83px;">
                        <option value="" selected>Semua</option>
                        @foreach ($role_list as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>                    
                </div>                                          
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterDaftarDosenAdminJurusan">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilterDaftarDosenAdminJurusan" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileDaftarDosenAdminJurusan">Tampilkan</label>
                <select id="lengthMenuMobileDaftarDosenAdminJurusan" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
            <div class="input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="roleFilterMobileDaftarDosenAdminJurusan">Jabatan</label>
                <select id="roleFilterMobileDaftarDosenAdminJurusan" class="custom-select custom-select-md rounded-3 py-1" style="width: 83px;">
                    <option value="" selected>Semua</option>
                    @foreach ($role_list as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>                    
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileDaftarDosenAdminJurusan">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileDaftarDosenAdminJurusan" placeholder="">
            </div>
        </div>

        <table class="table table-responsive-lg table-bordered table-striped text-center" style="width:100%" id="datatablesdaftardosenadmjurusan">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">NIP</th>
                    <th class="text-center" scope="col">Nama</th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">Jabatan</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dosens as $dosen)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dosen->nip }}</td>
                        <td>{{ $dosen->nama }}</td>
                        <td>{{ $dosen->email }}</td>
                        @if ($dosen->role_id === null)
                            <td> - </td>
                        @endif
                        @if ($dosen->role_id)
                            <td>{{ $dosen->role->role_akses }}</td>
                        @endif
                        <td>
                            <a href="/dosen/edit/{{ $dosen->id }}" class="badge bg-warning p-2"><i
                                    class="fas fa-pen"></i></a>
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
