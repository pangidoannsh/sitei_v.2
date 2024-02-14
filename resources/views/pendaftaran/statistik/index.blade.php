@extends('layouts.main')

@php
    use Carbon\Carbon;
@endphp

@section('title')
    SITEI | Data Statistik
@endsection

@section('sub-title')
    Data Statistik
@endsection

@section('js')
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}

    <script src="{{ $chart2->cdn() }}"></script>

    {{ $chart2->script() }}
    
    <script src="{{ $chart3->cdn() }}"></script>

    {{ $chart3->script() }}
    
    <script src="{{ $chart4->cdn() }}"></script>

    {{ $chart4->script() }}
    
    <script src="{{ $chart5->cdn() }}"></script>

    {{ $chart5->script() }}
@endsection

<style>
    .larapex-chart-texts text {
    margin: 10px; /* Atur margin label menjadi 10px */
}
</style>
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif
<section class ="mb-5">
    <div class="container card p-4 mb-5">

        <ol class="breadcrumb col-lg-12">

            <li>
                <a href="/statistik" class="breadcrumb-item active fw-bold text-success px-1">Statistik</a>
            </li>

            <span class="px-2">|</span>
            <li><a href="/statistik/bimbingan-kp" class="px-1">Bimbingan KP</a></li>
            <span class="px-2">|</span>
            <li><a href="/statistik/bimbingan-skripsi" class="px-1">Bimbingan Skripsi</a></li>

        </ol>

        <div class="container-fluid">

    <div class="container">
        <div class="p-0">{!! $chart->container() !!}
            </div>

            <div class="p-0">{!! $chart2->container() !!}
            </div>

            <div class="p-0">{!! $chart2->container() !!}
            </div>

            <div class="p-0">{!! $chart3->container() !!}
            </div>

            <div class="p-0">{!! $chart4->container() !!}
            </div>
            
            <div class="p-0">{!! $chart5->container() !!}
            </div>

            
        </div>

</section>
           
        </div>
    </div>
<br>
    <br>
    <br>
@endsection

@section('footer')
    <section class="bg-dark p-1">
        <div class="container">
            <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <a class="text-success fw-bold"
                    formtarget="_blank" target="_blank" href="/developer/m-seprinaldi">( M. Seprinaldi )</a></p>
        </div>
    </section>
@endsection







