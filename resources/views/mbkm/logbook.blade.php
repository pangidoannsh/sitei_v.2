@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI MBKM | Logbook MBKM
@endsection

@section('sub-title')
    Logbook MBKM | {{ $mbkm->judul }}
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif


    <div class="container-fluid">
        <div class="container-fluid">
            <a href="{{ Auth::guard('dosen')->check() ? route('mbkm.prodi') : (Auth::guard('mahasiswa')->check() ? route('mbkm') : route('mbkm.staff')) }}"
                class="btn btn-success mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-5" style="width: 120px; ">Kembali <a>
        </div>
        <div class="card p-4 mbkm">
            <table class="table table-responsive-lg table-bordered table-striped" width="100%" id="unorderer_datatables">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" scope="col">Bulan</th>
                        <th class="text-center" scope="col">Logbook</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logbooks as $lb)
                        <tr>
                            <td class="text-center ">{{ Carbon::parse($lb->input_date)->translatedFormat('F Y') }}</td>
                            <td class="text-center ">
                                @if ($lb->file)
                                    <a href="{{ asset('storage/' . $lb->file) }}" target="_blank"
                                        class="btn btn-primary rounded-pill px-5">Lihat logbook</a>
                                @else
                                    @if (optional(Auth::guard('mahasiswa')->user())->nim == $mbkm->mahasiswa_nim)
                                        <button class="btn btn-success rounded-pill px-4" title="Upload logbook"
                                            data-toggle="modal" data-target="#uploadLogbook{{ $lb->id }}">
                                            <i class="fa-solid fa-upload"></i>
                                            Upload Logbook
                                        </button>
                                    @else
                                        <div class="text-secondary">(Belum Menunggah Logbook)</div>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <div class="modal fade" id="uploadLogbook{{ $lb->id }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="uploadLogbook{{ $lb->id }}Label"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadLogbookLabel">Upload Logbook:
                                            {{ Carbon::parse($lb->input_date)->translatedFormat('F Y') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('mbkm.logbook.store', $lb->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="file">Logbook <span style="font-size: 12px">(Pdf,
                                                        max:1MB)</span></label>
                                                <input type="file" class="form-control" id="file" name="file">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success mb-3 d-flex align-items-center justify-content-center fw-bold gap-2 rounded-5" style="width: 120px;">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="fw-semibold">
                <span class="text-danger fw-semibold">*</span>
                Harap lengkapi logbook Anda untuk dapat mengajukan usulan konversi nilai MBKM
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <section class="bg-dark p-1">
        <div class="container d-flex justify-content-center">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI
                (
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Muhammad Abdullah Qosim
                </a>,
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Ilmi Fajar Ramadhan
                </a>,dan
                <a class="text-success fw-bold" href="https://pangidoannsh.vercel.app" target="_blank">
                    Fitra Ramadhan
                </a>
                )
            </p>
        </div>
    </section>
@endsection
