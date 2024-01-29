@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Kapasitas Bimbingan
@endsection

@section('sub-title')
    Kapasitas Bimbingan
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="swal" data-swal="{{ session('message') }}"></div>
    @endif

    <div class="container card p-4">
        <table class="table table-responsive-lg table-bordered table-striped" style="width:100%" id="">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" scope="col">Kapasitas Bimbingan KP</th>
                    <th class="text-center" scope="col">Kapasitas Bimbingan Skripsi</th>
                    <th class="text-center" scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($kapasitas_bimbingan as $kp)
                    <tr>
                        <td class="text-center">{{ $kp->kapasitas_kp }}</td>
                        <td class="text-center">
                            {{ $kp->kapasitas_skripsi }}
                        </td>
                        <td class="text-center">
                            <a href="/kapasitas-bimbingan/edit/{{ $kp->id }}" class="badge p-2 bg-warning"><i
                                    class="fas fa-pen"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <span class="text-success fw-bold">(</span>
                <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M.
                    Seprinaldi</a><span class="text-success fw-bold">)</span>
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
