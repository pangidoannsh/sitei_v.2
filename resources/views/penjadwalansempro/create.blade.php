
@extends('layouts.main')

@section('title')
    SITEI | Tambah Jadwal Sempro
@endsection

@section('sub-title')
    Tambah Jadwal Sempro
@endsection

@section('content')

<form action="{{url ('/form-sempro/create')}}" method="POST">
        @csrf
    <div>
        <div class="row">
            <div class="col">
            <div class="mb-3 field">
            <label for="mahasiswa_nim" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_nim" id="mhs" class="form-select @error('mahasiswa_nim') is-invalid @enderror">
                <option value="">-Pilih-</option>
                    @foreach ($mahasiswas as $mhs)
                    <option value="{{$mhs->nim}}" {{old('mahasiswa_nim') == $mhs->nim ? 'selected' : null}}>{{$mhs->nama}}</option>
                @endforeach
            </select>
            @error('mahasiswa_nim')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3 field">
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

        <div class="mb-3 field">
            <label class="form-label">Judul Proposal</label>
            <input type="text" name="judul_proposal" class="form-control @error('judul_proposal') is-invalid @enderror" value="{{ old('judul_proposal') }}">
            @error('judul_proposal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

         <div class="row">
    <div class="col">
      <div class="mb-3 field">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
    </div>
    <div class="col">
      <div class="mb-3 field">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu') }}">
            @error('waktu')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
    </div>
  </div>
        
        <div class="mb-3 field">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}">
            @error('lokasi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
            </div>
            <div class="col-md">
            <div class="mb-3 field">
            <label for="pembimbingsatu_nip" class="form-label">Pembimbing Satu</label>
            <select name="pembimbingsatu_nip" id="pembimbing1" class="form-select @error('pembimbingsatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingsatu_nip') == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbingsatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>        

        <div class="mb-3 field">
            <label for="pembimbingdua_nip" class="form-label">Pembimbing Dua</label>
            <select name="pembimbingdua_nip" id="pembimbing2" class="form-select @error('pembimbingdua_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pembimbingdua_nip') == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pembimbingdua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label for="pengujisatu_nip" class="form-label">Penguji Satu</label>
            <select name="pengujisatu_nip" id="penguji1" class="form-select @error('pengujisatu_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujisatu_nip') == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujisatu_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3 field">
            <label for="pengujidua_nip" class="form-label">Penguji Dua</label>
            <select name="pengujidua_nip" id="penguji2" class="form-select @error('pengujidua_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujidua_nip') == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujidua_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

        <div class="mb-3 field">
            <label for="pengujitiga_nip" class="form-label">Penguji Tiga</label>
            <select name="pengujitiga_nip" id="penguji3" class="form-select @error('pengujitiga_nip') is-invalid @enderror">
                <option value="">-Pilih-</option>
                @foreach ($dosens as $dosen)
                    <option value="{{$dosen->nip}}" {{old('pengujitiga_nip') == $dosen->nip ? 'selected' : null}}>{{$dosen->nama}}</option>
                @endforeach
            </select>
            @error('pengujitiga_nip')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div> 

      <button type="submit" class="btn btn-success float-right mt-4">Tambah</button>
    </div>   

</div>
</div>
</form>

@endsection

@section('footer')
<section class="bg-dark p-1">
<div class="container">
          <p class="developer">Dikembangkan oleh Prodi Teknik Informatika UNRI <small> <span class="text-success fw-bold">(</span><a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/fahril-hadi">Fahril Hadi, </a> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/rahul-ilsa-tajri-mukhti">Rahul Ilsa Tajri Mukhti </a> <span class="text-success fw-bold">&</span> 
          <a class="text-success fw-bold" formtarget="_blank" target="_blank" href="/developer/m-seprinaldi"> M. Seprinaldi</a><span class="text-success fw-bold">)</span></small></p>
        </div>
</section>
@endsection

@push('scripts')
<script>

    $(document).ready(function() {
       $('#mhs').select2();
    });

    $(document).ready(function() {
       $('#pembimbing1').select2();
    });

    $(document).ready(function() {
       $('#pembimbing2').select2();
    });


    $(document).ready(function() {
       $('#penguji1').select2();
    });

    $(document).ready(function() {
       $('#penguji2').select2();
    });


    $(document).ready(function() {
       $('#penguji3').select2();
    });


</script>
@endpush