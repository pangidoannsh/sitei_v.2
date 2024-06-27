<nav class="navbar navbar-expand-lg main-header fixed-top bayangan">
    <div class="container judul">
        <div class="sia-jte">
            <a>
                <img src="/assets/dist/img/unri.png" alt="" width="30" height="30"
                    class="d-inline-block mr-2">
            </a>
            @if (Str::length(Auth::guard('web')->user()) > 0)
                <a class="navbar-brand mt-1 " href="/">SITEI
                @elseif (Str::length(Auth::guard('dosen')->user()) > 0)
                    <a class="navbar-brand mt-1 " href="/persetujuan-kp-skripsi">SITEI
                    @elseif (Str::length(Auth::guard('mahasiswa')->user()) > 0)
                        <a class="navbar-brand mt-1 " href="/">SITEI
            @endif
            </a>
        </div>

        <span class="navbar-toggler navbar-light bg-white border border-white" role="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-bars fs-1 fa-lg"></i>
        </span>

        {{-- Wrapper Menus --}}
        <div class="collapse navbar-collapse navbar-toggler-collapse rounded-bottom" id="navbarSupportedContent">
            <ul class="navbar-nav">
                {{-- Menu Dosen --}}
                @if (Str::length(Auth::guard('dosen')->user()) > 0)
                    {{-- PENGUMUMAN --}}
                    @if (in_array(Auth::guard('dosen')->user()->role_id, [5, 6, 7, 8]))
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" id="pengumumanDropdown" role="button"
                                data-bs-toggle="dropdown" class="nav-link ">
                                <span class="fw-bold {{ Request::is('pengumuman*') ? 'text-success' : '' }}">
                                    PENGUMUMAN
                                </span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="pengumumanDropdown">
                                <li class="nav-item">
                                    <a href="{{ route('pengumuman') }}"
                                        class="nav-link {{ Request::is('pengumuman') || Request::is('pengumuman/arsip') ? 'text-success' : '' }}">Dosen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('pengumuman/pengelola*') ? 'text-success' : '' }}"
                                        href="{{ route('pengumuman.pengelola') }}">Pengelola</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pengumuman*') ? 'text-success' : '' }} "
                                aria-current="page" href="{{ route('pengumuman') }}">PENGUMUMAN</a>
                        </li>
                    @endif
                    {{-- END PENGUMUMAN --}}

                    {{-- MENU KP/SKRIPSI --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            KP/SKRIPSI
                        </a>
                        <div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <li>
                                    <a class="nav-link {{ Request::is('persetujuan-kp-skripsi*') ? 'text-success' : '' }} {{ Request::is('persetujuan-koordinator*') ? 'text-success' : '' }}{{ Request::is('riwayat-koordinator*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/persetujuan-kp-skripsi">Persetujuan</a>
                                </li>


                                <li>
                                    <a class="nav-link" href="/pembimbing/skripsi"
                                        class="dropdown-item mb-1 {{ Request::is('pembimbing/skripsi*') ? 'text-success' : '' }} {{ Request::is('pembimbing/kerja-praktek*') ? 'text-success' : '' }}">Bimbingan</a>
                                </li>


                                <li>
                                    <a class="nav-link" href="/kp-skripsi/seminar-pembimbing-penguji"
                                        class="dropdown-item mb-1 {{ Request::is('kp-skripsi*') ? 'text-success' : '' }} ">Seminar</a>
                                </li>

                                <li>
                                    <a class="nav-link" href="/pembimbing-penguji/riwayat-bimbingan"
                                        class="dropdown-item mb-1 {{ Request::is('pembimbing-penguji*') ? 'text-success' : '' }} ">Riwayat</a>
                                </li>
                                <li><a class="nav-link" href="/statistik"
                                        class="dropdown-item mb-1 {{ Request::is('statistik*') ? 'text-success' : '' }}">Statistik</a>
                                </li>
                                @if (Str::length(Auth::guard('dosen')->user()) > 0)
                                    @if (Auth::guard('dosen')->user()->role_id == 5 ||
                                            Auth::guard('dosen')->user()->role_id == 9 ||
                                            Auth::guard('dosen')->user()->role_id == 10 ||
                                            Auth::guard('dosen')->user()->role_id == 11 ||
                                            Auth::guard('dosen')->user()->role_id == 6 ||
                                            Auth::guard('dosen')->user()->role_id == 7 ||
                                            Auth::guard('dosen')->user()->role_id == 8)
                                        <li><a class="nav-link" href="/prodi/kp-skripsi/seminar"
                                                class="dropdown-item mb-1 {{ Request::is('prodi*') ? 'text-success' : '' }} {{ Request::is('kerja-praktek*') ? 'text-success' : '' }} {{ Request::is('skripsi*') ? 'text-success' : '' }}">Pengelola</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </li>

                    {{-- END KP/SKRIPSI --}}

                    {{-- MENU INVENTARIS --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('inventaris*') ? 'text-success' : '' }} " aria-current="page"
                            href="/inventaris/peminjaman-dosen">INVENTARIS</a>
                    </li>
                    {{-- MENU MBKM --}}
                    @if (in_array(Auth::guard('dosen')->user()->role_id, [6, 7, 8]))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('mbkm*') ? 'text-success' : '' }} " aria-current="page"
                                href="{{ route('mbkm.prodi') }}">MBKM</a>
                        </li>
                    @endif
                    {{-- MENU ABSENSI --}}
                    <li class="nav-item">
                        <a href="/absensi"
                            class="nav-link  {{ Request::is('absensi') ? 'text-success' : '' }} 
                        {{ Request::is('absensi/riwayat-absensi') ? 'text-success' : '' }} 
                         {{ Request::is('daftar-perkuliahan/*') ? 'text-success' : '' }} 
                          {{ Request::is('absensi/ruangan-absensi*') ? 'text-success' : '' }} 
                           {{ Request::is('absensi/open-absensi/*') ? 'text-success' : '' }} 
                            {{ Request::is('matakuliah') ? 'text-success' : '' }} 
                             {{ Request::is('matakuliah/riwayat*') ? 'text-success' : '' }}">
                            ABSENSI
                        </a>
                    </li>
                    {{-- MENU DOKUMEN --}}
                    @if (in_array(Auth::guard('dosen')->user()->role_id, [5, 6, 7, 8]))
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" id="dokumenDropdown" role="button"
                                data-bs-toggle="dropdown" class="nav-link ">
                                <span class="fw-bold {{ Request::is('distribusi-dokumen*') ? 'text-success' : '' }}">
                                    DOK/ARSIP
                                </span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dokumenDropdown">
                                <li class="nav-item">
                                    <a href="{{ route('doc.index') }}"
                                        class="nav-link {{ Request::is('distribusi-dokumen') ? 'text-success' : '' }}">Dosen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('distribusi-dokumen/pengelola*') ? 'text-success' : '' }}"
                                        href="{{ route('pengelola') }}">Pengelola</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown baru">
                            <a href="{{ route('doc.index') }}"
                                class="nav-link {{ Request::is('distribusi-dokumen*') ? 'text-success' : '' }}">
                                DOK/ARSIP
                            </a>
                        </li>
                    @endif
                @endif

                {{-- Menu PLP --}}
                @if (Str::length(Auth::guard('web')->user()) > 0 && Auth::guard('web')->user()->role_id == 12)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pengumuman*') ? 'text-success' : '' }} "
                            aria-current="page" href="{{ route('pengumuman') }}">PENGUMUMAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('inventaris*') ? 'text-success' : '' }} "
                            aria-current="page" href="/inventaris/peminjaman-plp">INVENTARIS</a>
                    </li>
                    <li class="nav-item dropdown baru">
                        <a href="{{ route('doc.index') }}"
                            class="nav-link {{ Request::is('distribusi-dokumen*') ? 'text-success' : '' }}">
                            DOK/ARSIP
                        </a>
                    </li>
                @endif

                {{-- Menu Mahasiswa --}}

                @if (Str::length(Auth::guard('mahasiswa')->user()) > 0)
                    {{-- MENU PENGUMUMAN --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pengumuman*') ? 'text-success' : '' }} "
                            aria-current="page" href="{{ route('pengumuman') }}">PENGUMUMAN</a>
                    </li>
                    {{-- MENU KP/SKRIPSI --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            KP/SKRIPSI
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('kp-skripsi*') ? 'text-success' : '' }}  {{ Request::is('usulankp*') ? 'text-success' : '' }} {{ Request::is('permohonankp*') ? 'text-success' : '' }} {{ Request::is('balasankp*') ? 'text-success' : '' }} {{ Request::is('seminarkp*') ? 'text-success' : '' }} {{ Request::is('usulan-semkp*') ? 'text-success' : '' }} {{ Request::is('kpti10-kp*') ? 'text-success' : '' }} {{ Request::is('usuljudul*') ? 'text-success' : '' }}  "
                                    aria-current="page" href="/kp-skripsi">Usulan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('jadwal*') ? 'text-success' : '' }} "
                                    aria-current="page" href="/jadwal">Seminar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('seminar*') ? 'text-success' : '' }} "
                                    aria-current="page" href="/seminar">Download</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('statistik*') ? 'text-success' : '' }} "
                                    aria-current="page" href="/statistik">Statistik</a>
                            </li>
                        </ul>
                    </li>
                    {{-- MENU INVENTARIS --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('inventaris*') ? 'text-success' : '' }} "
                            aria-current="page" href="/inventaris/peminjamanmhs">INVENTARIS</a>
                    </li>
                    {{-- MENU MBKM --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('mbkm*') ? 'text-success' : '' }} " aria-current="page"
                            href="{{ route('mbkm') }}">MBKM</a>
                    </li>

                    {{-- MENU ABSENSI --}}
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('absensimahasiswa*') ? 'text-success' : '' }} {{ Request::is('ruanganabsensi*') ? 'text-success' : '' }}"
                            aria-current="page" href="/absensimahasiswa">ABSENSI</a>
                    </li>

                    {{-- MENU DOKUMEN --}}
                    <li class="nav-item dropdown baru">
                        <a id="dokumendropdown" href="{{ route('doc.index') }}"
                            class="nav-link {{ Request::is('distribusi-dokumen*') ? 'text-success' : '' }}">
                            DOK/ARSIP
                        </a>
                    </li>
                @endif

                {{-- Menu Admin --}}
                @if (Str::length(Auth::guard('web')->user()) > 0)
                    {{-- Admin Prodi --}}
                    @if (in_array(Auth::guard('web')->user()->role_id, [2, 3, 4]))
                        {{-- MENU PENGUMUMAN --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pengumuman*') ? 'text-success' : '' }} "
                                aria-current="page" href="{{ route('pengumuman') }}">PENGUMUMAN</a>
                        </li>
                        {{-- MENU KP/SKRIPSI --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                KP/SKRIPSI
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('sempro*') ? 'text-success' : '' }}{{ Request::is('daftar-sempro*') ? 'text-success' : '' }}{{ Request::is('persetujuan*') ? 'text-success' : '' }}{{ Request::is('skripsi*') ? 'text-success' : '' }}{{ Request::is('usulan*') ? 'text-success' : '' }}{{ Request::is('daftar-semkp*') ? 'text-success' : '' }}{{ Request::is('suratperusahaan*') ? 'text-success' : '' }}{{ Request::is('usuljudul*') ? 'text-success' : '' }}{{ Request::is('daftar-sidang*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/persetujuan/admin/index">Persetujuan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('form*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/form">Seminar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('kerja-praktek*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/kerja-praktek/admin/index">Data
                                        KP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('sidang*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/sidang/admin/index">Data
                                        Skripsi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('prodi*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/prodi/riwayat">Riwayat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('statistik*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/statistik">Statistik</a>
                                </li>

                            </ul>
                        </li>
                        {{-- MENU INVENTARIS --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('inventaris*') ? 'text-success' : '' }}"
                                aria-current="page" href="/inventaris/peminjamanadm">INVENTARIS</a>
                        </li>
                        {{-- MENU MBKM --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('mbkm*') ? 'text-success' : '' }} " aria-current="page"
                                href="{{ route('mbkm.staff') }}">MBKM</a>
                        </li>
                        {{-- MENU DOKUMEN --}}
                        <li class="nav-item dropdown baru">
                            <a id="dokumendropdown" href="{{ route('doc.index') }}"
                                class="nav-link {{ Request::is('distribusi-dokumen*') ? 'text-success' : '' }}">
                                DOK/ARSIP
                            </a>
                        </li>
                    @endif

                    {{-- Admin Jurusan --}}
                    @if (Auth::guard('web')->user()->role_id == 1)
                        {{-- MENU PENGUMUMAN --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('pengumuman*') ? 'text-success' : '' }} "
                                aria-current="page" href="{{ route('pengumuman') }}">PENGUMUMAN</a>
                        </li>
                        {{-- MENU KP/SKRIPSI --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                KP/SKRIPSI
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('form*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/form">Seminar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('kerja-praktek*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/kerja-praktek/admin/index">Data
                                        KP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('sidang*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/sidang/admin/index">Data
                                        Skripsi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('riwayat-penjadwalan*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/prodi/riwayat">Riwayat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('statistik*') ? 'text-success' : '' }}"
                                        aria-current="page" href="/statistik">Statistik</a>
                                </li>

                            </ul>
                        </li>
                        {{-- MENU INVENTARIS --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('inventaris*') ? 'text-success' : '' }}"
                                aria-current="page" href="/inventaris/peminjamanadm">INVENTARIS</a>
                        </li>

                        {{-- MENU DOKUMEN --}}
                        <li class="nav-item dropdown baru">
                            <a id="dokumendropdown" href="{{ route('doc.index') }}"
                                class="nav-link {{ Request::is('distribusi-dokumen*') ? 'text-success' : '' }}">
                                DOK/ARSIP
                            </a>
                        </li>
                        <li class="nav-item baru">
                            <a class="nav-link {{ Request::is('matakuliah') ? 'text-success' : '' }} {{ Request::is('matakuliah/create') ? 'text-success' : '' }} {{ Request::is('matakuliah/riwayat') ? 'text-success' : '' }} {{ Request::is('matakuliah/ruangan-absensi') ? 'text-success' : '' }}"
                                href="/matakuliah">ABSENSI</a>
                        </li>
                        {{-- MENU DATA --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                DATA
                            </a>
                            <div>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li class="nav-item"><a href="/prodi"
                                            class="dropdown-item nav-link {{ Request::is('prodi*') ? 'text-success' : '' }}">Program
                                            Studi</a></li>
                                    <li class="nav-item"><a href="/konsentrasi"
                                            class="dropdown-item nav-link {{ Request::is('konsentrasi*') ? 'text-success' : '' }}">Konsentrasi</a>
                                    </li>
                                    <li class="nav-item"><a
                                            href="/semester"class="dropdown-item nav-link  {{ Request::is('semester*') ? 'text-success' : '' }}">Semester
                                            (TA)</a></li>
                                    <li class="nav-item"><a href="/kapasitas-bimbingan/index"
                                            class="dropdown-item nav-link  {{ Request::is('kapasitas-bimbingan*') ? 'text-success' : '' }}">Kuota
                                            Bimbingan</a></li>
                                    <li class="nav-item"><a
                                            href="/logo"class="dropdown-item nav-link  {{ Request::is('logo*') ? 'text-success' : '' }}">Logo
                                            Sertifikat</a></li>
                                    <li class="nav-item"><a href="#"
                                            class="dropdown-item cursor-default nav-link"><b>AKUN</b></a>
                                    </li>
                                    <li class="nav-item"><a href="/dosen"
                                            class="dropdown-item nav-link {{ Request::is('dosen*') ? 'text-success' : '' }}"><span
                                                class="ml-2">- Dosen </span></a></li>
                                    <li class="nav-item"><a href="/user"
                                            class="dropdown-item nav-link {{ Request::is('user*') ? 'text-success' : '' }}"><span
                                                class="ml-2">- Tendik </span></a></li>
                                    <li class="nav-item"><a href="/plp"
                                            class="dropdown-item nav-link {{ Request::is('plp*') ? 'text-success' : '' }}"><span
                                                class="ml-2">- PLP </span></a></li>
                                    <li class="nav-item"><a href="/role"
                                            class="dropdown-item nav-link {{ Request::is('role*') ? 'text-success' : '' }}"><span
                                                class="ml-2">- Hak Akses </span></a></li>
                                    <li class="nav-item"><a href="/gedung"
                                            class="dropdown-item nav-link {{ Request::is('gedung') ? 'text-success' : '' }} {{ Request::is('gedung/ruangan') ? 'text-success' : '' }} {{ Request::is('gedung/create') ? 'text-success' : '' }} {{ Request::is('gedung/edit') ? 'text-success' : '' }} {{ Request::is('gedung/ruangan') ? 'text-success' : '' }}"><span
                                                class="ml-2">- Gedung</a></li>


                                </ul>
                            </div>
                        </li>
                    @endif

                    {{-- MENU ABSENSI --}}
                    @if (Auth::guard('web')->check() && in_array(Auth::guard('web')->user()->role_id, [2, 3, 4, 5]))
                        <li class="nav-item baru">
                            <a class="nav-link {{ Request::is('matakuliah') ? 'text-success' : '' }} {{ Request::is('matakuliah/create') ? 'text-success' : '' }} {{ Request::is('matakuliah/edit') ? 'text-success' : '' }} {{ Request::is('matakuliah/riwayat') ? 'text-success' : '' }} {{ Request::is('matakuliah/ruangan-absensi') ? 'text-success' : '' }}"
                                href="/matakuliah">ABSENSI</a>
                        </li>
                    @endif
                @endif


                @if (Str::length(Auth::guard('web')->user()) > 0)
                    @if (Auth::guard('web')->user()->role_id == 2)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                DATA
                            </a>
                            <div>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <li class="nav-item"><a class="nav-link" href="/mahasiswa"
                                            class="dropdown-item mb-1 {{ Request::is('mahasiswa*') ? 'text-success' : '' }}">Mahasiswa</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif

                @if (Str::length(Auth::guard('web')->user()) > 0)
                    @if (Auth::guard('web')->user()->role_id == 3)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                DATA
                            </a>
                            <div>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <li class="nav-item"><a class="nav-link" href="/mahasiswa"
                                            class="dropdown-item mb-1 {{ Request::is('mahasiswa*') ? 'text-success' : '' }}">Mahasiswa</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif

                @if (Str::length(Auth::guard('web')->user()) > 0)
                    @if (Auth::guard('web')->user()->role_id == 4)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                DATA
                            </a>
                            <div>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <li class="nav-item"><a href="/mahasiswa"
                                            class="dropdown-item nav-link {{ Request::is('mahasiswa*') ? 'text-success' : '' }}">Mahasiswa</a>
                                    </li>
                                    <li class="nav-item"><a href="#"
                                            class="dropdown-item cursor-default nav-link"><b>Backup
                                                File</b></a> </li>
                                    <li class="nav-item"><a
                                            href="https://drive.google.com/drive/folders/1BXXXZdm36DWkm69hI6EZdNznXaGClwL9"
                                            target="_blank" class="dropdown-item nav-link"><span class="ml-2">-
                                                Seminar KP </span></a></li>
                                    <li class="nav-item"><a
                                            href="https://drive.google.com/drive/folders/1CHKVAqnQqgxeONsETBhuQWbasaVcGcdT"
                                            target="_blank" class="dropdown-item nav-link"><span class="ml-2">-
                                                SemPro </span></a></li>
                                    <li class="nav-item"><a
                                            href="https://drive.google.com/drive/folders/1BIsESymd0P8k0UBcnDehn70ymNvl4rbi"
                                            target="_blank" class="dropdown-item nav-link"><span class="ml-2">-
                                                Sidang Skripsi </span></a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        AKUN
                    </a>
                    <div>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if (Str::length(Auth::guard('dosen')->user()) > 0)
                                @if (Auth::guard('dosen')->user())
                                    <li>
                                        <a class="nav-link dropdown-item " href="">
                                            <b>{{ Auth::guard('dosen')->user()->nama }}</b>
                                        </a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a class="nav-link dropdown-item {{ Request::is('profil-dosen*') ? 'text-success' : '' }}"
                                            href="/profil-dosen/editpassworddsn/">
                                            Ubah Password
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @if (Str::length(Auth::guard('mahasiswa')->user()) > 0)
                                @if (Auth::guard('mahasiswa')->user())
                                    <li>
                                        <a class="nav-link dropdown-item " href="">
                                            <b>{{ Auth::guard('mahasiswa')->user()->nama }}</b>
                                        </a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a class="nav-link dropdown-item {{ Request::is('profil-mhs*') ? 'text-success' : '' }}"
                                            href="/profil-mhs/editpasswordmhs/">
                                            Ubah Password
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @if (Str::length(Auth::guard('web')->user()) > 0)
                                @if (Auth::guard('web')->user())
                                    <li>
                                        <a class="nav-link dropdown-item " href="">
                                            <b>{{ Auth::guard('web')->user()->nama }}</b>
                                        </a>
                                    </li>
                                    <hr>
                                    <li>
                                        <a class="nav-link dropdown-item {{ Request::is('profil-staff*') ? 'text-success' : '' }}"
                                            href="/profil-staff/editpasswordstaff/">
                                            Ubah Password
                                        </a>
                                    </li>
                                @endif
                            @endif

                            <form action="/logout" method="POST">
                                @csrf
                                <li>
                                    <button type="submit" class="nav-link dropdown-item">
                                        Keluar
                                    </button>
                                </li>
                            </form>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
