@extends('layouts.main')

@section('title')
    Edit Jadwal Sempro | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Jadwal Sempro
@endsection

@section('content')

<form action="/form-skripsi/edit/{{$skripsi->id}}" method="POST">
        @method('put')
        @csrf
    <div>
        <div class="row">
            <div class="col">
            <div class="mb-3">
            <label for="mahasiswa_nim" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_nim" class="form-select @error('mahasiswa_nim') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($mahasiswas as $mhs)
                    <option value="{{$mhs->nim}}" {{old('mahasiswa_nim', $skripsi->mahasiswa_nim) == $mhs->nim ? 'selected' : null}}>{{$mhs->nama}}</option>
                @endforeach
            </select>
            @error('mahasiswa_nim')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">                
            @if(auth()->user()->role_id == 2)                                                          
                <option value="1">Teknik Elektro D3</option>                
            @endif
            @if(auth()->user()->role_id == 3)                                                          
                <option value="2">Teknik Elektro S1</option>                
            @endif
            @if(auth()->user()->role_id == 4)                                                          
                <option value="3">Teknik Informatika S1</option>                
            @endif
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Skripsi</label>
            <input type="text" name="judul_skripsi" class="form-control @error('judul_skripsi') is-invalid @enderror" value="{{ old('judul_skripsi', $skripsi->judul_skripsi) }}">
            @error('judul_skripsi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $skripsi->tanggal) }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu', $skripsi->waktu) }}">
            @error('waktu')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>


        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $skripsi->lokasi) }}">
            @error('lokasi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
            </div>
            <div class="col">
            <div class="mb-3">
            <label for="pembimbingsatu_nip" class="form-label">Pembimbing Satu</label>
            <select name="pembimbingsatu_nip" class="form-select @error('pembimbingsatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingsatu_nip', $skripsi->pembimbingsatu_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbingsatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>        

        <div class="mb-3">
            <label for="pembimbingdua_nip" class="form-label">Pembimbing Dua</label>
            <select name="pembimbingdua_nip" class="form-select @error('pembimbingdua_nip') is-invalid @enderror">
                <option value="1">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingdua_nip', $skripsi->pembimbingdua_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbingdua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pengujisatu_nip" class="form-label">Penguji Satu</label>
            <select name="pengujisatu_nip" class="form-select @error('pengujisatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujisatu_nip', $skripsi->pengujisatu_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujisatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="pengujidua_nip" class="form-label">Penguji Dua</label>
            <select name="pengujidua_nip" class="form-select @error('pengujidua_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujidua_nip', $skripsi->pengujidua_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujidua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="pengujitiga_nip" class="form-label">Penguji Tiga</label>
            <select name="pengujitiga_nip" class="form-select @error('pengujitiga_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujitiga_nip', $skripsi->pengujitiga_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujitiga_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success float-right mt-4">Perbarui</button>
            </div>
        </div>
    </div>
</form>

<!-- <div class="col-lg-5">
    <form action="/form-skripsi/edit/{{$skripsi->id}}" method="POST">
        @method('put')
        @csrf

        <div class="mb-3">
            <label for="mahasiswa_nim" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_nim" class="form-select @error('mahasiswa_nim') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($mahasiswas as $mhs)
                    <option value="{{$mhs->nim}}" {{old('mahasiswa_nim', $skripsi->mahasiswa_nim) == $mhs->nim ? 'selected' : null}}>{{$mhs->nama}}</option>
                @endforeach
            </select>
            @error('mahasiswa_nim')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select name="prodi_id" class="form-select @error('prodi_id') is-invalid @enderror">                
            @if(auth()->user()->role_id == 2)                                                          
                <option value="1">Teknik Elektro D3</option>                
            @endif
            @if(auth()->user()->role_id == 3)                                                          
                <option value="2">Teknik Elektro S1</option>                
            @endif
            @if(auth()->user()->role_id == 4)                                                          
                <option value="3">Teknik Informatika S1</option>                
            @endif
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Skripsi</label>
            <input type="text" name="judul_skripsi" class="form-control @error('judul_skripsi') is-invalid @enderror" value="{{ old('judul_skripsi', $skripsi->judul_skripsi) }}">
            @error('judul_skripsi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pembimbingsatu_nip" class="form-label">Pembimbing Satu</label>
            <select name="pembimbingsatu_nip" class="form-select @error('pembimbingsatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingsatu_nip', $skripsi->pembimbingsatu_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbingsatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>        

        <div class="mb-3">
            <label for="pembimbingdua_nip" class="form-label">Pembimbing Dua</label>
            <select name="pembimbingdua_nip" class="form-select @error('pembimbingdua_nip') is-invalid @enderror">
                <option value="1">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingdua_nip', $skripsi->pembimbingdua_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbingdua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="pengujisatu_nip" class="form-label">Penguji Satu</label>
            <select name="pengujisatu_nip" class="form-select @error('pengujisatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujisatu_nip', $skripsi->pengujisatu_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujisatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="pengujidua_nip" class="form-label">Penguji Dua</label>
            <select name="pengujidua_nip" class="form-select @error('pengujidua_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujidua_nip', $skripsi->pengujidua_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujidua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label for="pengujitiga_nip" class="form-label">Penguji Tiga</label>
            <select name="pengujitiga_nip" class="form-select @error('pengujitiga_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujitiga_nip', $skripsi->pengujitiga_nip) == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujitiga_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $skripsi->tanggal) }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu', $skripsi->waktu) }}">
            @error('waktu')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>


        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $skripsi->lokasi) }}">
            @error('lokasi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        {{-- <div class="mb-3">
            <label for="jenis_seminar" class="form-label">Jenis Seminar</label>
            <select name="jenis_seminar" class="form-select">
                <option value="Sidang Skripsi">Sidang Skripsi</option>                
            </select>            
        </div>  --}}

        <button type="submit" class="btn btn-outline-dark mb-5">Perbarui</button>

      </form>
</div> -->

@endsection