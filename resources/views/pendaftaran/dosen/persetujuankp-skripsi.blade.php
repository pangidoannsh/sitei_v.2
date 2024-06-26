@extends('layouts.main')

@php
    use Carbon\Carbon;

@endphp

@section('title')
    SITEI | Persetujuan Kerja Praktek dan Skripsi
@endsection

@section('sub-title')
    Persetujuan Kerja Praktek dan Skripsi
@endsection

@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @include('pendaftaran.dosen.components.persetujuan-table')
    @include('modal.index')
    @include('modal.skripsimodal')
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


@push('scripts')
    @foreach ($pendaftaran_kp as $kp)
        <script>
            //APPROVAL KERJA PRAKTEK
            $('.setujui-usulankp-pembimbing').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Usulan KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju',
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakUsulanKPPembimbing(id) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({

                            title: 'Tolak Usulan KP',
                            html: `
                        <form  action="/usulankp/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                           @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control @error('alasan') is-invalid @enderror" value="{{ old('alasan') }}" name="alasan" rows="4" cols="50" autofocus required></textarea>
                            @error('alasan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <br>
                            <button type="submit"  class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                      
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-usulankp-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Usulan KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });


            function tolakUsulanKPKoordinator(id) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan KP',
                            html: `
                        <form id="reasonForm" action="/usulankp/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-usulankp-kaprodi').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Usulan KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakUsulanKPKaprodi(id) {
                Swal.fire({
                    title: 'Tolak Usulan KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan KP',
                            html: `
                        <form id="reasonForm" action="/usulankp/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }


            $('.setujui-balasankp-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Surat Balasan Peusahaan!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakBalasanKPKoordinator(id) {
                Swal.fire({
                    title: 'Tolak Surat Basalan Perusahaan KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Surat Basalan Perusahaan KP',
                            html: `
                        <form id="reasonForm" action="/balasankp/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-semkp-pembimbing').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Seminar KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemKPPemb(id) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar KP',
                            html: `
                        <form id="reasonForm" action="/usulan-semkp/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('.setujui-semkp-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Seminar KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemKPKoordinator(id) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar KP',
                            html: `
                        <form id="reasonForm" action="/usulan-semkp/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('.setujui-semkp-kaprodi').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Seminar KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemKPKaprodi(id) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar KP',
                            html: `
                        <form id="reasonForm" action="/usulan-semkp/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-selesai-semkp-pembimbing').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Selesai Seminar KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Selesai'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakGagalSemKPPemb(id) {
                Swal.fire({
                    title: 'Gagal Seminar KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Gagal',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Gagal Seminar KP',
                            html: `
                        <form id="reasonForm" action="/selesaiseminar-kp/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-kpti10-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Bukti Penyerahan Laporan KP!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakKPTI10Koordinator(id) {
                Swal.fire({
                    title: 'Tolak KPTI/TE-10/Bukti Penyerahan Laporan KP',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak KPTI/TE-10/Bukti Penyerahan Laporan KP',
                            html: `
                        <form id="reasonForm" action="/kpti10/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-nilai-kp-keluar-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Nilai KP Keluar!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });
        </script>
    @endforeach
@endpush()


<!-- PENDAFTARAN SKRIPSI -->
@push('scripts')
    @foreach ($pendaftaran_skripsi as $skripsi)
        <script>
            //APROVAL SKRIPSI
            $('.setujui-usuljudul-pemb1').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Usulan Judul Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakUsulJudulPemb1(id) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Judul Skripsi',
                            html: `
                        <form id="reasonForm" action="/usuljudul/pembimbing1/tolak/${id}" method="POST">
                        @method('put')
                          @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-usuljudul-pemb2').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Usulan Judul Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakUsulJudulPemb2(id) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Judul Skripsi',
                            html: `
                        <form id="reasonForm" action="/usuljudul/pembimbing2/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-usuljudul-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Usulan Judul Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakUsulJudulKoordinator(id) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Judul Skripsi',
                            html: `
                        <form id="reasonForm" action="/usuljudul/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-usuljudul-kaprodi').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Usulan Judul Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakUsulJudulKaprodi(id) {
                Swal.fire({
                    title: 'Tolak Usulan Judul Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Judul Skripsi',
                            html: `
                        <form id="reasonForm" action="/usuljudul/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }


            //SEMPRO
            $('.setujui-sempro-pemb1').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sempro!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemproPemb1(id) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar Proposal',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar Proposal',
                            html: `
                        <form id="reasonForm" action="/daftarsempro/pembimbing1/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-sempro-pemb2').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sempro!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemproPemb2(id) {
                Swal.fire({
                    title: 'Tolak Usulan Seminar Proposal',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar Proposal',
                            html: `
                        <form id="reasonForm" action="/daftarsempro/pembimbing2/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            $('.setujui-sempro-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sempro!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSemproKoordinator() {
                Swal.fire({
                    title: 'Tolak Usulan Seminar Proposal',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Seminar Proposal',
                            html: `
                        <form id="reasonForm" action="/daftar-sempro/koordinator/tolak/{{ $skripsi->id }}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }


            $('.setujui-selesai-sempro-pemb1').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Selesai Seminar Proposal!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Selesai'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSelesaiSempro(id) {
                Swal.fire({
                    title: 'Gagal Seminar Proposal',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Gagal',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Gagal Seminar Proposal',
                            html: `
                        <form id="reasonForm" action="/selesaisempro/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('.setujui-perpanjangan1-pembimbing').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Perpanjangan 1 Waktu Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakPerpanjangan1Pembimbing(id) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 1 Waktu Skripsi!',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Perpanjangan 1 Waktu Skripsi',
                            html: `
                        <form id="reasonForm" action="/perpanjangan1/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('.setujui-perpanjangan1-kaprodi').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Perpanjangan 1 Waktu Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakPerpanjangan1Kaprodi(id) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 1 Waktu Skripsi!',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Perpanjangan 1 Waktu Skripsi',
                            html: `
                        <form id="reasonForm" action="/perpanjangan1/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }


            $('.setujui-perpanjangan2-pembimbing').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Perpanjangan 2 Waktu Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakPerpanjangan2Pembimbing(id) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 2 Waktu Skripsi!',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Perpanjangan 2 Waktu Skripsi',
                            html: `
                        <form id="reasonForm" action="/perpanjangan2/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('.setujui-perpanjangan2-kaprodi').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Perpanjangan 2 Waktu Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakPerpanjangan2Kaprodi(id) {
                Swal.fire({
                    title: 'Tolak Perpanjangan 2 Waktu Skripsi!',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Perpanjangan 2 Waktu Skripsi',
                            html: `
                        <form id="reasonForm" action="/perpanjangan2/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }



            // DAFTAR SIDANG PEMBIMBING 1
            $('.setujui-sidang-pemb1').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sidang!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSidangPemb1(id) {
                Swal.fire({
                    title: 'Tolak Usulan Sidang Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Sidang Skripsi',
                            html: `
                        <form id="reasonForm" action="/daftarsidang/pembimbing1/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            //DAFTAR SIDANG PEMBIMBING 2
            $('.setujui-sidang-pemb2').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sidang!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSidangPemb2(id) {
                Swal.fire({
                    title: 'Tolak Usulan Sidang Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Sidang Skripsi',
                            html: `
                        <form id="reasonForm" action="/daftarsidang/pembimbing2/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('.setujui-sidang-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sidang!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSidangKoordinator(id) {
                Swal.fire({
                    title: 'Tolak Usulan Sidang Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Sidang Skripsi',
                            html: `
                        <form id="reasonForm" action="/daftar-sidang/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }


            $('.setujui-sidang-kaprodi').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Daftar Sidang!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSidangKaprodi(id) {
                Swal.fire({
                    title: 'Tolak Usulan Sidang Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Usulan Sidang Skripsi',
                            html: `
                        <form id="reasonForm" action="/daftar-sidang/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }


            $('.setujui-selesai-sidang-pemb1').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Selesai Sidang Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Selesai'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakSelesaiSidang(id) {
                Swal.fire({
                    title: 'Gagal Sidang Skripsi',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Gagal',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Gagal Sidang Skripsi',
                            html: `
                        <form id="reasonForm" action="/selesaisidang/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }

            //PERPANJANGAN REVISI

            $('.setujui-perpanjangan-revisi-pembimbing').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Perpanjangan Revisi Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakPerpanjanganRevisiPembimbing(id) {
                Swal.fire({
                    title: 'Tolak Perpanjangan Revisi Skripsi!',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Perpanjangan Revisi Skripsi',
                            html: `
                        <form id="reasonForm" action="/perpanjangan-revisi/pembimbing/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('.setujui-perpanjangan-revisi-kaprodi').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Perpanjangan Revisi Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakPerpanjanganRevisiKaprodi(id) {
                Swal.fire({
                    title: 'Tolak Perpanjangan Revisi Skripsi!',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Perpanjangan Revisi Skripsi',
                            html: `
                        <form id="reasonForm" action="/perpanjangan-revisi/kaprodi/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }



            $('.setujui-buku-skripsi-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Setujui Bukti Penyerahan Buku Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });

            function tolakBukuSkripsiKoordinator(id) {
                Swal.fire({
                    title: 'Tolak Bukti Penyerahan Buku Skripsi!',
                    text: 'Apakah Anda Yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Tolak',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Tolak Bukti Penyerahan Buku Skripsi',
                            html: `
                        <form id="reasonForm" action="/buku-skripsi/koordinator/tolak/${id}" method="POST">
                        @method('put')
                            @csrf
                            <label for="alasan">Alasan Penolakan :</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="4" cols="50" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-danger p-2 px-3">Kirim</button>
                            <button type="button" onclick="Swal.close();" class="btn btn-secondary p-2 px-3">Batal</button>
                        </form>
                    `,
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('.setujui-lulus-koordinator').submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Lulus Skripsi!',
                    text: "Apakah Anda Yakin?",
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: 'grey',
                    confirmButtonText: 'Setuju'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            });






            //  $('.setujui-perpanjangan-revisi-pemb1').submit(function(event) {
            //     event.preventDefault();
            //     Swal.fire({
            //         title: 'Setujui Perpanjangan Revisi Skripsi!',
            //         text: "Apakah Anda Yakin?",
            //         icon: 'question',
            //         showCancelButton: true,
            //         cancelButtonText: 'Batal',
            //         confirmButtonColor: '#28a745',
            //         cancelButtonColor: 'grey',
            //         confirmButtonText: 'Setuju'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             event.currentTarget.submit();
            //         }
            //     })
            // });

            // $('.tolak-perpanjangan-revisi-pemb1').submit(function(event) {
            //     event.preventDefault();
            //     Swal.fire({
            //         title: 'Tolak Perpanjangan Revisi Skripsi!',
            //         text: "Apakah Anda Yakin?",
            //         icon: 'question',
            //         showCancelButton: true,
            //         cancelButtonText: 'Batal',
            //         confirmButtonColor: '#dc3545',
            //         cancelButtonColor: 'grey',
            //         confirmButtonText: 'Tolak'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             event.currentTarget.submit();
            //         }
            //     })
            // });
            //   //PEMBIMBING 2
            // $('.setujui-perpanjangan-revisi-pemb2').submit(function(event) {
            //     event.preventDefault();
            //     Swal.fire({
            //         title: 'Setujui Perpanjangan Revisi Skripsi!',
            //         text: "Apakah Anda Yakin?",
            //         icon: 'question',
            //         showCancelButton: true,
            //         cancelButtonText: 'Batal',
            //         confirmButtonColor: '#28a745',
            //         cancelButtonColor: 'grey',
            //         confirmButtonText: 'Setuju'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             event.currentTarget.submit();
            //         }
            //     })
            // });

            // $('.tolak-perpanjangan-revisi-pemb2').submit(function(event) {
            //     event.preventDefault();
            //     Swal.fire({
            //         title: 'Tolak Perpanjangan Revisi Skripsi!',
            //         text: "Apakah Anda Yakin?",
            //         icon: 'question',
            //         showCancelButton: true,
            //         cancelButtonText: 'Batal',
            //         confirmButtonColor: '#dc3545',
            //         cancelButtonColor: 'grey',
            //         confirmButtonText: 'Tolak'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             event.currentTarget.submit();
            //         }
            //     })
            // });
        </script>
    @endforeach
@endpush()


@if (Str::length(Auth::guard('dosen')->user()) > 0)
    @if (Auth::guard('dosen')->user()->role_id == 6 ||
            Auth::guard('dosen')->user()->role_id == 7 ||
            Auth::guard('dosen')->user()->role_id == 8 ||
            Auth::guard('dosen')->user()->role_id == 9 ||
            Auth::guard('dosen')->user()->role_id == 10 ||
            Auth::guard('dosen')->user()->role_id == 11)
        @push('scripts')
            @foreach ($penjadwalan_skripsis as $skripsi)
                <script>
                    // PERSETUJUAN SIDANG KOORDINATOR DAN KAPRODI
                    $('.tolak-persetujuan-sidang-koordinator').submit(function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Tolak Seminar Sidang Skripsi?',
                            text: "Apakah Anda Yakin? Data Akan dikembalikan ke Ketua Penguji",
                            icon: 'question',
                            showCancelButton: true,
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: 'grey',
                            confirmButtonText: 'Tolak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                event.currentTarget.submit();
                            }
                        })
                    });

                    $('.setujui-persetujuan-sidang-koordinator').submit(function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Setujui Seminar Sidang Skripsi?',
                            text: "Apakah Anda Yakin? Data tidak bisa dikembalikan",
                            icon: 'question',
                            showCancelButton: true,
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: 'grey',
                            confirmButtonText: 'Setuju'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                event.currentTarget.submit();
                            }
                        })
                    });

                    $('.tolak-persetujuan-sidang-kaprodi').submit(function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Tolak Seminar Sidang Skripsi?',
                            text: "Apakah Anda Yakin? Data Akan dikembalikan ke Ketua Penguji",
                            icon: 'question',
                            showCancelButton: true,
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#dc3545',
                            cancelButtonColor: 'grey',
                            confirmButtonText: 'Tolak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                event.currentTarget.submit();
                            }
                        })
                    });

                    $('.setujui-persetujuan-sidang-kaprodi').submit(function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Setujui Seminar Sidang Skripsi?',
                            text: "Apakah Anda Yakin? Data tidak bisa dikembalikan",
                            icon: 'question',
                            showCancelButton: true,
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: 'grey',
                            confirmButtonText: 'Setuju'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                event.currentTarget.submit();
                            }
                        })
                    });
                </script>
            @endforeach
        @endpush()
    @endif
@endif
