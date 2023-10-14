@extends('layouts.main')

@section('title')
    Edit Jadwal KP | SIA ELEKTRO
@endsection

@section('sub-title')
    Edit Jadwal KP
@endsection

@section('content')

<form action="/form-kp/edit/{{$kp->id}}" method="POST">
        @method('put')
        @csrf

        <div class="container">
            <div class="mb-3 field">
                <label for="mahasiswa_nim" class="form-label">Mahasiswa <span class="text-danger">*</span></label>
                <select name="mahasiswa_nim" id="mhs" class="form-select @error('mahasiswa_nim') is-invalid @enderror">
                    <option value="">-Belum Dipilih-</option>
                    @foreach ($mahasiswas as $mhs)
                        <option value="{{$mhs->nim}}" {{old('mahasiswa_nim', $kp->mahasiswa_nim) == $mhs->nim ? 'selected' : null}}>{{$mhs->nama}}</option>
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
                <label class="form-label">Judul Laporan Kerja Praktek<span class="text-danger">*</span></label>
                <input type="text" name="judul_kp" class="form-control @error('judul_kp') is-invalid @enderror" value="{{ old('judul_kp', $kp->judul_kp) }}"> 
                @error('judul_kp')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror           
            </div>

            <div class="mb-3 field">
                <label for="pembimbing_nip" class="form-label">Pembimbing <span class="text-danger">*</span></label>
                <select name="pembimbing_nip" id="pembimbing" class="form-select @error('pembimbing_nip') is-invalid @enderror">
                    <option value="">-Belum Dipilih-</option>
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

            <div class="mb-3 field">
                <label for="penguji_nip" class="form-label">Penguji <span class="text-danger">*</span></label>
                <select name="penguji_nip" id="penguji" class="form-select @error('penguji_nip') is-invalid @enderror">
                    <option value="">-Belum Dipilih-</option>
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

            <div class="mb-3 field">
                <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
                <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
                <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>       
                    <label class="form-label">Tanggal <input type="checkbox" id="cektanggal2"> (manual)</label>
                    <input id ="ciek" type="text" onchange="teshari()" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $kp->tanggal) }}" disabled>
                    
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
        
                        $(`[name="waktu_selasa"]`).prop('selectedIndex',0);
                        $(`[name="waktu_kamis"]`).prop('selectedIndex',0);
                    }
                </script>

            <div class="mb-3 field">
                <label for="waktu"class="form-label">Waktu <input type="checkbox" id="cekwaktu3"> (manual)</label>
                <select name="jam_id" id="waktu4" class="form-control @error('waktu') is-invalid @enderror" disabled>
                <option value="">-Belum Dipilih-</option>
                </select>
                <select name="waktu_selasa" id="waktudb2" style="display:none" class="form-control @error('waktu') is-invalid @enderror" disabled>
                <option value="">-Belum Dipilih-</option>
                    @foreach ($jamkpsels as $jamkpsel)
                        <option value="{{$jamkpsel->jam_tersedia}}" {{old('waktu', $kp->waktu) == $jamkpsel->jam_tersedia ? 'selected' : null}}>{{$jamkpsel->jam_tersedia}}</option>
                    @endforeach
                </select>
                <select name="waktu_kamis" id="waktudb3" style="display:none" class="form-control @error('waktu') is-invalid @enderror" disabled>
                <option value="">-Belum Dipilih-</option>
                    @foreach ($jamkpkams as $jamkpkam)
                        <option value="{{$jamkpkam->jam_tersedia}}" {{old('waktu', $kp->waktu) == $jamkpkam->jam_tersedia ? 'selected' : null}}>{{$jamkpkam->jam_tersedia}}</option>
                    @endforeach
                </select>
                @error('waktu')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3 field">
                <label class="form-label">Lokasi <input type="checkbox" id="ceklokasi2"/> (manual)</label>
                <select type="text" name="ruangan_id" id="lokasi2" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}" disabled>
                <option value="">-Belum Dipilih-</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{$ruangan->nama_ruangan}}" {{old('lokasi', $kp->lokasi) == $ruangan->id ? 'selected' : null}}>{{$ruangan->nama_ruangan}}</option>
                    @endforeach
                </select>
                @error('lokasi')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror            
            </div>

                <button type="submit" class="btn btn-success float-end mt-4">Ubah</button>
        </div>
</form>

<br><br><br>

@endsection

@push('scripts')
<script>

    $(document).ready(function() {
       $('#mhs').select2();
    });

    $(document).ready(function() {
       $('#pembimbing').select2();
    });

    $(document).ready(function() {
       $('#penguji').select2();
    });

    document.getElementById('cekwaktu3').onchange = function() {
        console.log("Test");
        document.getElementById('waktu4').disabled = !this.checked;
        document.getElementById('waktudb2').disabled = !this.checked;
        document.getElementById('waktudb3').disabled = !this.checked;
    };

    document.getElementById('cektanggal2').onchange = function() {
    document.getElementById('ciek').disabled = !this.checked;
    };

    document.getElementById('ceklokasi2').onchange = function() {
    document.getElementById('lokasi2').disabled = !this.checked;
    };

    document.getElementById('cekwaktu3').onchange = function() {
        document.getElementById('waktu4').disabled = !this.checked;
        document.getElementById('waktudb2').disabled = !this.checked;
        document.getElementById('waktudb3').disabled = !this.checked;
    };
</script>
@endpush