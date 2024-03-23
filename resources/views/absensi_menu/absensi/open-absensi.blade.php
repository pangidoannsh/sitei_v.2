@extends('layouts.main')


@section('title')
    Absensi Perkuliahan | SIA ELEKTRO
@endsection


@section('sub-title')
    Absensi Perkuliahan
@endsection


@section('content')
<div>
    <a href="/absensi/" class="btn btn-success py-1 px-2 mb-3 "><i class="fas fa-arrow-left fa-xs" aria-hidden="true"></i>
        Kembali 
    </a>

    <!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="konfirmasiHapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <form id="formHapusData" method="POST" action="">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-success">Yakin</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="row rounded shadow-sm">
        <div class="col-md-4 bg-white px-4 py-3 mb-2 rounded-start">
            <!-- Bagian Kiri: QR Code -->
            {{-- <h5 class="text-bold">QR Code</h5>
                    <hr>
            <div class="visible-print text-start mt-4">
                {!! QrCode::size(250)->generate("ID Ruangan: {$mataKuliah->ruangan_id}, {$mataKuliah->id}, {$mataKuliah->nip_dosen}, {$mataKuliah->mk}"); !!}
            </div> --}}
            <!-- Tampilkan QR code atau tautan ke Google Maps -->
<!-- Bagian Kiri: QR Code -->
{{-- @if ($mataKuliah->ruangan_id)
    @php
        $location = \App\Models\Location::find($mataKuliah->ruangan_id); // Ambil informasi lokasi berdasarkan ID ruangan
        $googleMapsUrl = "https://www.google.com/maps/search/?api=1&query={$location->longitude},{$location->latitude}"; // Buat URL untuk Google Maps
    @endphp

    <h5 class="text-bold">QR Code</h5>
    <hr>
    <div class="visible-print text-start mt-4">
        {!! QrCode::size(250)->generate($googleMapsUrl); !!}
    </div>
    <!-- Tambahkan tautan langsung ke Google Maps jika diperlukan -->
    <p><a href="{{ $googleMapsUrl }}" target="_blank">Buka lokasi di Google Maps</a></p>
@endif --}}
@if ($mataKuliah->ruangan_id)
    @php
        $location = \App\Models\Location::find($mataKuliah->ruangan_id); // Ambil informasi lokasi berdasarkan ID ruangan
        $coordinates = "{$location->longitude},{$location->latitude}"; // Gabungkan latitude dan longitude
        $additionalInfo = "{$mataKuliah->id},{$perkuliahan->id},{$mataKuliah->mk}, {$mataKuliah->nip_dosen}"; // Informasi tambahan
        $qrCodeContent = $coordinates . '  |  ' . $additionalInfo; // Gabungkan koordinat dengan informasi tambahan
        $qrCodeUrl = '/generate-qr-code?data=' . urlencode($qrCodeContent); // Generate QR code URL
        $qrCodeImage = QrCode::size(250)->generate($qrCodeContent);

    @endphp

    <h5 class="text-bold">Silahkan Absensi Disini</h5>
    <hr>
    <div id="qrCodeContainer" class="visible-print text-start mt-4">
    <div id="qrCode" class="qr-code" >{{ $qrCode }}</div>
    <div id="qrCode2" class="qr-code">{{ $qrCode2 }}</div>
    <div id="qrCode3" class="qr-code">{{ $qrCode3 }}</div>
    <div id="qrCode4" class="qr-code">{{ $qrCode4 }}</div>
    {{-- {!! $qrCodeImage !!}  --}}
    </div>
@endif
            <!-- Modal untuk menambahkan absensi manual -->
            <div class="modal fade" id="tambahAbsensiModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Absensi Manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahAbsensi" action="{{ url('/absensi/tambah-manual') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="student_id" name="student_id" readonly>
                    </div>
                    {{-- <div class="form-group">
                        <label for="namaMahasiswa">Nama Mahasiswa</label>
                        <select class="namas form-control" id="namas" style="width: 100%" name="student_name"></select>
                    </div> --}}
                    <label for="student_id" class="form-label">Mahasiswa</label>
                    <select name="student_id" id="mhs" style="width: 100%" class="form-select @error('student_id') is-invalid @enderror">
                        <option value="">-Pilih-</option>
                        @foreach ($mahasiswas as $mhs)
                            <option value="{{$mhs->id}}" {{old('student_id') == $mhs->id ? 'selected' : null}}>{{$mhs->nama}} ({{ $mhs->nim }})</option>
                        @endforeach
                    </select>

                    @error('student_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="keterangan" class="mt-3">Keterangan</label>
                            <div class="btn-group-toggle" data-toggle="buttons">
                            <input type="radio" class="btn-check" name="keterangan" id="sakit" value="Sakit"  onclick="setKeterangan(this.value)">
                            <label class="btn tombol btn-danger fw-normal" for="sakit">Sakit</label>
                                        
                            <input type="radio" class="btn-check" name="keterangan" id="izin" value="Izin" onclick="setKeterangan(this.value)">
                            <label class="btn tombol btn-warning fw-normal" for="izin">Izin</label>

                            <input type="radio" class="btn-check" name="keterangan" id="hadir" value="Hadir" onclick="setKeterangan(this.value)">
                            <label class="btn tombol btn-info fw-normal" for="hadir">Hadir</label>
                            </div>
                    </div>
                    <input type="hidden" id="keterangan" name="keterangan" value=""> <!-- Hidden input for 'keterangan' -->
                    <input type="hidden" name="nama_dosen" value="{{ $mataKuliah->nip_dosen }}">
                    <input type="hidden" name="perkuliahan_id" value="{{ $perkuliahan->id }}">
                    <input type="hidden" name="mata_kuliah" value="{{ $mataKuliah->mk }}">
                    <input type="hidden" name="class_id" value="{{ $mataKuliah->id }}">
                    <input type="hidden" name="attended_at" value="{{ now() }}">
                    <button type="submit" class="btn btn-success float-right">Tambah</button>
                </form>

            </div>
            </div>
        </div>
        </div>
        <div class="bg-white mt-5 rounded-start">
             <h5 class="text-bold">Detail Waktu Perkuliahan</h5>
                <hr>
                            <div class="row">
                                <div class="col text-bold"> Ruangan
                                </div>
                                <div class="col">
                                    {{ $mataKuliah->ruangan->nama_ruangan ?? '-' }}
                                </div>
                                <div class="col text-bold"> SKS
                                </div>
                                <div class="col ">
                                    {{ $mataKuliah->sks ?? '-' }} SKS
                                </div>
                            </div>
                            <div class="row mt-1 mb-3">
                                <div class="col text-bold"> Hari
                                </div>
                                <div class="col ">
                                    {{ $hariPerkuliahan }}
                                </div>
                                <div class="col text-bold"> Tanggal
                                </div>
                                <div class="col ">
                                    {{ $mataKuliah->created_at ? $mataKuliah->created_at->format('Y-m-d') : '-' }}
                                </div>
                            </div>
                            <hr/>
                            <div class="row mt-1">
                                <div class="col text-bold"> Jam Mulai
                                </div>
                                <div class="col ">
                                    {{ $mataKuliah->created_at ? $mataKuliah->created_at->format('H:i:s') : '-' }}
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col text-bold "> Sisa Waktu
                                </div>
                                <div class="col "> <h7 id="countdown" class="text-center"></h7>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-6 text-bold" style="color:#ffffff"> Jam
                                </div>
                                <div id="clock" class="col-md-6" style="color: #ffffff">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-md-12">
                                    <form id="closeForm" action="{{ route('tutup', ['id' => $perkuliahan->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button id="closeButton" type="submit" class="btn btn-md text-bold px-3 py-2 rounded w-100 {{ $perkuliahan->status === 'Perkuliahan Selesai' ? 'btn-secondary' : 'bg-danger' }} px-3 py-2 rounded border-0" {{ $perkuliahan->status === 'Perkuliahan Selesai' ? 'disabled' : '' }}>Selesai</button>
                                    </form>
                                </div>
                            </div>
        </div>
        </div>


        <div class="col-md-8 bg-white px-4 py-3 mb-2 rounded-start">
            <!-- Bagian Kanan: Tabel Absensi -->
            <h5 class="text-bold">Absensi Mahasiswa</h5>
            <hr>
          <div class="row absensi mt-4">
            <div class="col-6 pl-3">
                <h6><span>Pertemuan</span> {{ $perkuliahan->nomor_pertemuan ?? '-' }}</h6>
                <h6><span>Mata Kuliah</span> {{ $mataKuliah->mk ?? '-' }}</h6>
                <h6><span>Semester</span> {{ $mataKuliah->semester->semester ?? '-' }} {{ $mataKuliah->semester->tahun_ajaran ?? '-' }}</h6>
            </div>
            <div class="col-6 ">
                @if ($mataKuliah->prodi == !null)
                <h6><span>Program Studi</span> {{ $mataKuliah->prodi->nama_prodi ?? '-' }}</h6>
                @endif
                <h6><span>Dosen</span> {{ $mataKuliah->nip_dosen ?? '-' }}</h6>
                @if ($mataKuliah->kelas == !null)
                <h6><span>Kelas</span> {{ $mataKuliah->kelas->nama_kelas ?? '-' }}</h6>
                @endif
            </div>
          </div>
<hr class="mt-3">

            <div class="mt-3 col-12">
                <div class="table-responsive" id="absensi-mahasiswa">
                    <table class="table text-center table-bordered table-striped" id="datatables">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Tanggal</th>
                                <th class="text-center" scope="col">NIM</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Waktu</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendance as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->attended_at)->format('Y-m-d') }}</td>
                                    <td>{{ $data->student->nim }}</td>
                                    <td>{{ $data->student->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->attended_at)->format('H:i:s') }}</td>
                                    <td class="@if($data->keterangan === 'Sakit') bg-danger text-white @elseif($data->keterangan === 'Izin') bg-warning text-dark @elseif($data->keterangan === 'Hadir') bg-info text-white @else bg-secondary text-dark @endif">{{ $data->keterangan }}</td>
                                    <td>
                                      <button class="badge bg-danger border-0" onclick="setHapusData({{ $data->id }})" data-toggle="modal" data-target="#konfirmasiHapusModal">
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                    </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <button href="#" id="tambahMahasiswa" class="btn btn-success text-bold mt-3 ml-0" data-toggle="modal" data-target="#tambahAbsensiModal" style="margin-top:10px; margin-left:18px;" {{ $perkuliahan->status === 'Perkuliahan Selesai' ? 'disabled' : '' }}>+ Mahasiswa</button>
                </div>
            </div>
    </div>
   
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#mhs').select2({
            placeholder: 'Pilih Mahasiswa',
            allowClear: true
        });
    });

    function setHapusData(id) {
        var form = document.getElementById('formHapusData');
        form.action = '/delete/' + id;
    }

    function store() {
    var studentId = $("#student_id").val();
    var keterangan = $("#keterangan").val();
    $.ajax({
        type: "POST",
        url: "{{ url('/absensi/tambah-manual') }}",
        data: {
            student_id: studentId,
            keterangan: keterangan,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            // Panggil fungsi notif untuk menampilkan notifikasi dan menambahkan data ke tabel
            notif(response);
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}

</script>
@endpush

@push('scripts')
<script>
    var qrCodes = ["qrCode", "qrCode2", "qrCode3", "qrCode4"];
    var currentIndex = 0;

    $("#" + qrCodes[1]).hide();
    $("#" + qrCodes[2]).hide();
    $("#" + qrCodes[3]).hide();


    function changeQRCode() {
            $("#" + qrCodes[currentIndex]).hide(); // Sembunyikan QR code saat ini
            currentIndex = (currentIndex + 1) % qrCodes.length; // Pindah ke QR code berikutnya
            $("#" + qrCodes[currentIndex]).show(); // Tampilkan QR code yang baru
        }
    setInterval(changeQRCode, 10000);
</script>
@endpush

@push('scripts')

<script>
  function notif(data){
    console.log(data);
    Toastify({
      text: data.message,
      className: "info",
      style:{
        background: "#3ed33edc",
      },
      gravity: "top",
      position: "right",
    }).showToast();

    //fill content
    var lastRowIndex = $('#absensi-mahasiswa tbody tr').length + 1;

    var newRow = `<tr>
        <td>${lastRowIndex++}</td>
        <td>${data.tanggal}</td>
        <td>${data.nim}</td>
        <td>${data.nama}</td>
        <td>${data.waktu}</td>
        <td class="${data.keterangan === 'Sakit' ? 'bg-danger text-white' : (data.keterangan === 'Izin' ? 'bg-warning text-dark' : (data.keterangan === 'Hadir' ? 'bg-info text-white' : 'bg-secondary text-dark'))}">${data.keterangan}</td>
        <td>
            <button class="badge bg-danger border-0" onclick="setHapusData(${data.id})" data-toggle="modal" data-target="#konfirmasiHapusModal">
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                    </button>
        </td>
    </tr>`;
    $('#absensi-mahasiswa tbody').append(newRow);
  };
</script>
@endpush

@push('scripts')
<script>
    // Function to set the value of 'keterangan' based on the selected radio button
    function setKeterangan(value) {
        document.getElementById('keterangan').value = value; // Set the value of 'keterangan' input field
    }

    $(document).ready(function() {
        // Fungsi untuk menangani klik pada tombol radio
        $(".btn-group-toggle .btn").click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });

        // Fungsi untuk memperbarui status aktif tombol radio saat halaman dimuat atau saat tombol lain diklik
        function updateActiveRadioButtons() {
            $(".btn-group-toggle .btn").each(function() {
                // Periksa apakah tombol ini adalah tombol aktif
                if ($(this).hasClass('active')) {
                    // Temukan tombol radio yang sesuai berdasarkan ID dan atur status aktif
                    var radioId = $(this).attr('for');
                    $("#" + radioId).prop('checked', true);
                }
            });
        }

        // Panggil fungsi untuk memperbarui status aktif tombol radio saat halaman dimuat
        updateActiveRadioButtons();
    });
</script>
@endpush

@push('scripts')
<script>
        
        $(document).ready(function() {
        // Fungsi untuk memperbarui waktu dengan 'updated_at'
            function updateClockWithUpdatedAt() {
            var updatedAt = new Date("{{ $perkuliahan->updated_at }}"); // Ambil waktu 'updated_at' dari server dan konversi ke objek Date
            var hours = updatedAt.getHours(); // Ambil jam
            var minutes = updatedAt.getMinutes(); // Ambil menit
            var seconds = updatedAt.getSeconds(); // Ambil detik
            var timeString = hours + ":" + (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds; // Format waktu ke "14:14:19"
            document.getElementById('clock').innerHTML = timeString; // Perbarui tampilan waktu
        }

        // Variabel untuk menyimpan interval waktu
        var clockIntervalId;

        // Fungsi untuk memulai interval waktu
        function startClock() {
            updateClock(); // Pertama, perbarui tampilan waktu
            clockIntervalId = setInterval(updateClock, 1000); // Mulai interval waktu dengan memanggil fungsi updateClock setiap detik
        }

        // Fungsi untuk menghentikan interval waktu
        function stopClock() {
            clearInterval(clockIntervalId); // Hentikan interval waktu
        }

        // Fungsi untuk memperbarui waktu aktual
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var timeString = hours + ":" + minutes + ":" + seconds;
            document.getElementById('clock').innerHTML = timeString;
        }

        var statusPerkuliahan = "{{ $perkuliahan->status }}";
        if (statusPerkuliahan === 'Perkuliahan Selesai') {
            updateClockWithUpdatedAt(); // Jika perkuliahan sudah selesai, perbarui waktu dengan 'updated_at'
            stopCountdown();
        } else {
            startClock(); // Jika perkuliahan masih dibuka, mulai interval waktu
        }

        var waktuKelasDibuka = new Date("{{ $perkuliahan->created_at }}").getTime();

        // Ambil durasi SKS dari server
        var sks = {{ $mataKuliah->sks ?? 0 }};

        // Waktu standar untuk setiap SKS (dalam milidetik)
        var waktuPerSKS = 50 * 60 * 1000; // Misalnya, 50 menit per SKS

        // Total waktu perkuliahan (dalam milidetik)
        var totalWaktuPerkuliahan = sks * waktuPerSKS;
        // Fungsi untuk mengubah status menjadi "Perkuliahan Selesai"
        function updateStatusWhenFinished() {
            // Kirim permintaan POST untuk mengubah status menjadi "Perkuliahan Selesai"
            $.ajax({
                type: "POST",
                url: "{{ route('tutup', ['id' => $perkuliahan->id]) }}",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    // Ubah teks dan kelas tombol menjadi 'Perkuliahan Selesai' dan 'btn-secondary'
                    $("#closeButton").text("Selesai").removeClass("bg-danger").addClass("btn-secondary").attr("disabled", true);
                    $("#tambahMahasiswa").text("+ Mahasiswa").removeClass("bg-success").addClass("btn-secondary").attr("disabled", true);
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }

        
        // Fungsi untuk menghitung dan menampilkan waktu mundur
        function countdown() {
            var now = new Date().getTime(); // Waktu sekarang dalam milidetik
            var remainingTime = waktuKelasDibuka + totalWaktuPerkuliahan - now; // Hitung waktu tersisa dalam milidetik

            // Periksa apakah waktu mundur telah mencapai 0
            if (remainingTime <= 0) {
                clearInterval(intervalId); // Hentikan interval jika waktu mundur telah mencapai 0
                document.getElementById("countdown").innerHTML = "Perkuliahan Selesai";
                updateStatusWhenFinished(); // Panggil fungsi untuk memperbarui status saat waktu habis
                stopClock();
            } else {
                var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                // Tampilkan waktu mundur pada elemen dengan id 'countdown'
                document.getElementById("countdown").innerHTML = hours + ":" + minutes + ":" + seconds;
            }
        }

        // Panggil fungsi countdown setiap 1 detik
        var intervalId = setInterval(countdown, 1000);

        // Panggil countdown untuk memastikan waktu mundur segera ditampilkan saat halaman dimuat
        function stopCountdown() {
            clearInterval(intervalId); // Hentikan interval jika waktu mundur telah mencapai 0
        }
        countdown();

        var statusPerkuliahan = "{{ $perkuliahan->status }}";
        if (statusPerkuliahan === 'Perkuliahan Selesai') {
            stopCountdown(); // Jika perkuliahan sudah selesai, mulai interval waktu elapsed
        } else {
            // countdown(); // Jika perkuliahan masih dibuka, hitung waktu elapsed saat ini
        }
    });
</script>
@endpush