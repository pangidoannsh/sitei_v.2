@extends('layouts.main')

@section('title')
    Tambah Usulan | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Usulan
@endsection

@section('content')

<form action="{{route('usulan.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
<div>
    <div class="row">
        <div class="col-6-lg">
            <div class="mb-3 field">
                <label for="program" class="form-label">Program MBKM</label>
                <select name="program" class="form-select">
                    <option value="1">Studi Independen</option>
                    <option value="2">Magang</option>
                    <option value="3">Lainnya</option>
                </select>
            </div>

        <div class="mb-3 field">
            <label class="form-label">Lokasi (Perusahaan/Instansi)</label>
            <input type="text" name="mitra" class="form-control " >

        </div>
        <div class="mb-3 field">
            <label class="form-label">Alamat Perusahaan/Instansi</label>
            <input type="text" name="mitra" class="form-control " >

        </div>
        <div class="mb-3 field">
            <label class="form-label">Bidang Usaha</label>
            <input type="text" name="mitra" class="form-control " >

        </div>
        <div class="mb-3 field">
            <label class="form-label">Judul Kegiatan</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="mb-3 field">
            <label for="formFile" class="form-label">Rincian Kegiatan (PDF)</label>
            <input class="form-control" type="file" accept=".pdf" id="rincian" name="rincian">
        </div>
        <div class="mb-3 field">
            <label class="form-label">Periode Kegiatan (dd/mm/yyyy - dd/mm/yyyy)</label>
            <input type="text" name="periode" class="form-control " >

        </div>
        <div class="mb-3 field">
            <label class="form-label">Batas Waktu Penawaran</label>
            <input type="date" name="deadline" class="form-control " >

        </div>
        <a href="{{ route('revisi.index') }}">
        <button type="button" class="btn btn-success float-right mt-4">Tambah</button>
        </a>
        </div>
    </div>
</div>
</form>

@endsection

