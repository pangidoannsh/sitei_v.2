@extends('layouts.main')

@section('title')
    Daftar Konsentrasi | SIA ELEKTRO
@endsection

@section('sub-title')
    Daftar Konsentrasi
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <a href="{{ url('/konsentrasi/create') }}" class="btn konsentrasi btn-success mb-4">+ Konsentrasi</a>

    <div class="container card p-4">
        
        <!-- Desktop Version -->
        <div class="d-none d-md-flex justify-content-between mb-3 filter">
            <div class="d-flex align-items-center">
                <div class="dataTables_length input-group" style="width: max-content;">
                    <label class="pt-2 pr-2" for="lengthMenuDaftarKonsentrasiAdminJurusan">Tampilkan</label>
                    <select id="lengthMenuDaftarKonsentrasiAdminJurusan" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="250">250</option>
                    </select>
                </div>                          
            </div>
            <div class="dataTables_filter input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterDaftarKonsentrasiAdminJurusan">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1"  id="searchFilterDaftarKonsentrasiAdminJurusan" placeholder="">
            </div>
        </div>

        <!-- Tablet & Mobile Version -->
        <div class="d-flex flex-wrap justify-content-center gap-3 filter d-block d-md-none">
            <div class="dataTables_length input-group" style="width: max-content;">
                <label class="pt-2 pr-2" for="lengthMenuMobileDaftarKonsentrasiAdminJurusan">Tampilkan</label>
                <select id="lengthMenuMobileDaftarKonsentrasiAdminJurusan" class="custom-select custom-select-md rounded-3 py-1" style="width: 55px;">
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                </select>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3 filter d-block d-md-none">
            <div class="dataTables_filter input-group mt-3" style="width: max-content;">
                <label class="pt-2 pr-2" for="searchFilterMobileDaftarKonsentrasiAdminJurusan">Cari</label>
                <input type="search" class="form-control form-control-md rounded-3 py-1" id="searchFilterMobileDaftarKonsentrasiAdminJurusan" placeholder="">
            </div>
        </div>

        <table class="table text-center table-bordered table-striped" style="width:100%" id="datatablesdaftarkonsentrasiadmjurusan">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Konsentrasi</th>
                    <th class="text-center" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($konsentrasis as $konsentrasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $konsentrasi->nama_konsentrasi }}</td>
                        <td>
                            <a href="/konsentrasi/edit/{{ $konsentrasi->id }}" class="badge p-2 bg-warning"><i
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
@endpush
