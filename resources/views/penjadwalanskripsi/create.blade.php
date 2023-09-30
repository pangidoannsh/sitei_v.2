@extends('layouts.main')

@section('title')
    Tambah Jadwal Skripsi | SIA ELEKTRO
@endsection

@section('sub-title')
    Tambah Jadwal Skripsi
@endsection

@section('content')

<form action="{{url ('/form-skripsi/create')}}" method="POST">
        @csrf
    <div>
        <div class="row">
            <div class="col">
            <div class="mb-3 field">
            <label for="mahasiswa_nim" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
            <select name="mahasiswa_nim" id="mhs" class="form-select @error('mahasiswa_nim') is-invalid @enderror">
                <option value="">-Belum Dipilih-</option>
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
            <label for="prodi_id" class="form-label">Program Studi <span class="text-danger">*</span></label>
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
            <label for="pembimbingsatu_nip" class="form-label">Pembimbing Satu <span class="text-danger">*</span></label>
            <select name="pembimbingsatu_nip" id="pembimbing1" class="form-select @error('pembimbingsatu_nip') is-invalid @enderror">
                <option value="">-Belum Dipilih-</option>
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
        <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>       
            <label class="form-label">Tanggal <input type="checkbox" id="cektanggal2"> (manual)</label>
            <input id ="ciek" type="text" onchange="teshari()" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" disabled>
            
            <script type="text/javascript">
                $("#ciek").datepicker({
                dateFormat: "yy-mm-dd",
                beforeShowDay: function (tanggal) {
                var day = tanggal.getDay();
                return [day != 0 && day != 1 && day != 3 && day != 5 && day != 6];
            }
            });
            </script>
            
            
            @error('tanggal')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>
        
        <div class="mb-3 field">
            <label class="form-label">Judul skripsi <span class="text-danger">*</span></label>
            <input type="text" name="judul_skripsi" class="form-control @error('judul_skripsi') is-invalid @enderror" value="{{ old('judul_skripsi') }}">
            @error('judul_skripsi')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <script>
                function teshari()
                {
                    const lambe = new Date($('#ciek').val());
                    var tod = lambe.getDay();
                    if (tod == 2)
                    {
                        $("#waktudb2").show();
                        $("#waktudb3").hide();
                        $("#waktu4").hide();
                    }
                    else if (tod == 4)
                    {
                        $("#waktudb2").hide();
                        $("#waktudb3").show();
                        $("#waktu4").hide();
                    }
                    else
                    {
                        $("#waktudb2").hide();
                        $("#waktudb3").hide();
                        $("#waktu4").show();
                    }
                }
            </script>
    
                <label for="waktu"class="form-label">Waktu <input type="checkbox" id="cekwaktu3"> (manual)</label>
                <select name="waktu" id="waktu4" class="form-control @error('waktu') is-invalid @enderror" disabled>
                <option value="">-Belum Dipilih-</option>
                </select>
                <select name="waktu" id="waktudb2" style="display:none" class="form-control @error('waktu') is-invalid @enderror" disabled>
                <option value="">-Belum Dipilih-</option>
                    @foreach ($jamsels as $jamsel)
                        <option value="{{$jamsel->jam_tersedia}}" {{old('waktu') == $jamsel->jam_tersedia ? 'selected' : null}}>{{$jamsel->jam_tersedia}}</option>
                    @endforeach
                </select>
                <select name="waktu" id="waktudb3" style="display:none" class="form-control @error('waktu') is-invalid @enderror" disabled>
                <option value="">-Belum Dipilih-</option>
                    @foreach ($jamkams as $jamkam)
                        <option value="{{$jamkam->jam_tersedia}}" {{old('waktu') == $jamkam->jam_tersedia ? 'selected' : null}}>{{$jamkam->jam_tersedia}}</option>
                    @endforeach
                </select>
                @error('waktu')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        

            </div>
            <div class="col-md">
        
        
        <div class="mb-3 field">
            <label class="form-label">Lokasi <input type="checkbox" id="ceklokasi2"/> (manual)</label>
            <select type="text" name="lokasi" id="lokasi2" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}" disabled>
            <option value="">-Belum Dipilih-</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{$ruangan->id}}" {{old('lokasi') == $ruangan->id ? 'selected' : null}}>{{$ruangan->nama_ruangan}}</option>
                @endforeach
            </select>
            @error('lokasi')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="mb-3 field">
            <label for="pembimbingdua_nip" class="form-label">Pembimbing Dua 
                <!-- <input type="checkbox" id="cekpem2"> -->
            </label>
            <select name="pembimbingdua_nip" id="pembimbing2" class="form-select @error('pembimbingdua_nip') is-invalid @enderror">
                <option value="">-Belum Dipilih-</option>
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
            <label for="pengujisatu_nip" class="form-label">Penguji Satu <span class="text-danger">*</span></label>
            <select name="pengujisatu_nip" id="penguji1" class="form-select @error('pengujisatu_nip') is-invalid @enderror">
                <option value="">-Belum Dipilih-</option>
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
            <label for="pengujidua_nip" class="form-label">Penguji Dua <span class="text-danger">*</span>
                <!-- <input type="checkbox" id="cekpeng2"> -->
            </label>
            <select name="pengujidua_nip" id="penguji2" class="form-select @error('pengujidua_nip') is-invalid @enderror">
                <option value="">-Belum Dipilih-</option>
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
            <label for="pengujitiga_nip" class="form-label">Penguji Tiga 
                <!-- <input type="checkbox" id="cekpeng3"> -->
            </label>
            <select name="pengujitiga_nip" id="penguji3" class="form-select @error('pengujitiga_nip') is-invalid @enderror">
                <option value="">-Belum Dipilih-</option>
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

    document.getElementById('cektanggal2').onchange = function() {
    document.getElementById('ciek').disabled = !this.checked;
    };

    document.getElementById('ceklokasi2').onchange = function() {
    document.getElementById('lokasi2').disabled = !this.checked;
    };

    // document.getElementById('cekpem2').onchange = function() {
    // document.getElementById('pembimbing2').disabled = !this.checked;
    // };

    // document.getElementById('cekpeng2').onchange = function() {
    // document.getElementById('penguji2').disabled = !this.checked;
    // };

    // document.getElementById('cekpeng3').onchange = function() {
    // document.getElementById('penguji3').disabled = !this.checked;
    // };

    document.getElementById('cekwaktu3').onchange = function() {
    document.getElementById('waktu4').disabled = !this.checked;
    document.getElementById('waktudb2').disabled = !this.checked;
    document.getElementById('waktudb3').disabled = !this.checked;
    };


</script>
@endpush