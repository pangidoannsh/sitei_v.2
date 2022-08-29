@extends('layouts.main')

@section('title')
    Tambah Jadwal | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Jadwal
@endsection

@section('content')

<div class="col-lg-5">
    <form action="/form-kp/edit/{{$kp->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim', $kp->nim) }}">
            @error('nim')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $kp->nama) }}">
            @error('nama')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($prodis as $prodi)
                    <option value="{{$prodi->id}}" {{old('prodi_id', $kp->prodi_id) == $prodi->id ? 'selected' : null}}>{{$prodi->nama_prodi}}</option>
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="konsentrasi_id" class="form-label">Konsentrasi</label>
            <select name="konsentrasi_id" class="form-select @error('konsentrasi_id') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($konsentrasis as $konsentrasi)
                    <option value="{{$konsentrasi->id}}" {{old('konsentrasi_id', $kp->konsentrasi_id) == $konsentrasi->id ? 'selected' : null}}>{{$konsentrasi->nama_konsentrasi}}</option>
                @endforeach
            </select>
            @error('konsentrasi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Angkatan</label>
            <input type="number" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror" value="{{ old('angkatan', $kp->angkatan) }}">
            @error('angkatan')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>       

        <div class="mb-3">
            <label class="form-label">Judul Laporan Kerja Praktek</label>
            <input type="text" name="judul_kp" class="form-control @error('judul_kp') is-invalid @enderror" value="{{ old('judul_kp', $kp->judul_kp) }}"> 
            @error('judul_kp')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror           
        </div>

        <div class="mb-3">
            <label for="pembimbing_nip" class="form-label">Pembimbing</label>
            <select name="pembimbing_nip" class="form-select @error('pembimbing_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbing_nip', $kp->pembimbing_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbing_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="penguji_nip" class="form-label">Penguji</label>
            <select name="penguji_nip" class="form-select @error('penguji_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('penguji_nip', $kp->penguji_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('penguji_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $kp->tanggal) }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu', $kp->waktu) }}">
            @error('waktu')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $kp->lokasi) }}">  
            @error('lokasi')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror            
        </div>                

        <button type="submit" class="btn btn-outline-dark mb-5">Update</button>

      </form>
</div>

@endsection