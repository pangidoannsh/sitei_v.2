<?php

use App\Http\Controllers\AbRuanganController;
use App\Http\Controllers\AbsensiController;
use GuzzleHttp\Middleware;
use App\Models\PenjadwalanKP;
use App\Http\Middleware\CekRole;
use App\Models\PenjadwalanSempro;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRController;
use App\Http\Controllers\PLPController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\RiwayatController;
// use App\Http\Controllers\RuanganController;
use App\Http\Controllers\DeveloperController;
// use App\Http\Controllers\JadwalkanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\DosenProfilController;
use App\Http\Controllers\KonsentrasiController;
//M.Seprinaldi
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenilaianKPController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\StaffProfilController;
use App\Http\Controllers\PendaftaranKPController;
use App\Http\Controllers\StatistikController;

use App\Http\Controllers\PenjadwalanKPController;
use App\Http\Controllers\CountdownTimerController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\MahasiswaProfilController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PeminjamanAdminController;
use App\Http\Controllers\PeminjamanDosenController;
use App\Http\Controllers\PenilaianSemproController;
use App\Http\Controllers\UndanganSeminarController;
use App\Http\Controllers\PenilaianSkripsiController;

// INVENTARIS
use App\Http\Controllers\PenjadwalanSemproController;
use App\Http\Controllers\PendaftaranSkripsiController;
use App\Http\Controllers\PenjadwalanSkripsiController;
use App\Http\Controllers\PeminjamanMahasiswaController;
use App\Http\Controllers\PeminjamanPLPController;
use App\Http\Controllers\RekapitulasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include("doc.route.php");
include("mbkm.route.php");
include("pr.route.php");

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/detail-kp/{id}', [QRController::class, 'detailkp']);
    Route::get('/detail-sempro/{id}', [QRController::class, 'detailsempro']);
    Route::get('/detail-skripsi/{id}', [QRController::class, 'detailskripsi']);
    Route::get('/detail-skripsi-final/{id}', [QRController::class, 'detailskripsifinal']);

    Route::get('/detail-undangan-kp/{id}', [QRController::class, 'detail_undangan_kp']);
    Route::get('/detail-undangan-sempro/{id}', [QRController::class, 'detail_undangan_sempro']);
    Route::get('/detail-undangan-sidang/{id}', [QRController::class, 'detail_undangan_sidang']);

    Route::get('/detail-surat-permohonan-pengajuan-topik-skripsi/{id}', [QRController::class, 'detailsuratpermohonanpengajuantopikskripsi']);
    Route::get('/detail-form-pengajuan-topik-skripsi/{id}', [QRController::class, 'detailformpengajuantopikskripsi']);
    Route::get('/detail-surat-permohonan-kp/{id}', [QRController::class, 'detail_surat_permohonan_kp']);
    Route::get('/detail-form-permohonan-kp/{id}', [QRController::class, 'detail_form_permohonan_kp']);

    Route::get('/developer', [DeveloperController::class, 'index']);
    Route::get('/developer/fahril-hadi', [DeveloperController::class, 'fahril']);
    Route::get('/developer/m-seprinaldi', [DeveloperController::class, 'naldi']);
    Route::get('/developer/rahul-ilsa-tajri-mukhti', [DeveloperController::class, 'rahul']);
    Route::get('/developer/ahmad-fajri', [DeveloperController::class, 'ahmad']);
    Route::get('/developer/yabes-maychel', [DeveloperController::class, 'yabes']);
    Route::get('/developer/yasmine', [DeveloperController::class, 'yasmine']);

    Route::group(['middleware' => ['guest:web,dosen,mahasiswa']], function () {
        Route::get('/', [LoginController::class, 'index'])->name("formLogin");
        Route::post('/', [LoginController::class, 'postlogin'])->name('login');
    });

    Route::group(['middleware' => ['auth:dosen,web,mahasiswa']], function () {
        Route::post('/logout', [LoginController::class, 'logout']);
    });



    Route::group(['middleware' => ['auth:mahasiswa']], function () {

        Route::get('/ruanganabsensi', [AbRuanganController::class, 'ruanganabsensimahasiswa'])->name('ruanganmahasiswa');
        Route::get('/absensimahasiswa', [AbRuanganController::class, 'absensimahasiswa']);
        Route::get('/absensimahasiswa/detailabsensi/{class_id}', [AbsensiController::class, 'detailabsensi'])->name('detailabsensi');
        Route::get('/absensimahasiswa/riwayatabsensi', [AbsensiController::class, 'riwayatabsensimahasiswa'])->name('riwayatabsensi');

        Route::get('/usulankp/index', [PendaftaranKPController::class, 'indexusulankp']);

        Route::get('/usulankp/create', [PendaftaranKPController::class, 'createusulankp']);
        Route::post('/usulankp/create', [PendaftaranKPController::class, 'storeusulankp']);
        Route::get('/usulankp-ulang/create', [PendaftaranKPController::class, 'createusulankp_ulang']);
        Route::post('/usulankp-ulang/create', [PendaftaranKPController::class, 'storeusulankp_ulang']);

        Route::get('/usuljudul/index', [PendaftaranSkripsiController::class, 'indexusuljudul']);
        Route::get('/usuljudul/create', [PendaftaranSkripsiController::class, 'createusuljudul']);
        Route::post('/usuljudul/create', [PendaftaranSkripsiController::class, 'storeusuljudul']);
        Route::get('/usuljudul-ulang/create', [PendaftaranSkripsiController::class, 'create_ulang_usuljudul']);
        Route::post('/usuljudul-ulang/create', [PendaftaranSkripsiController::class, 'store_ulang_usuljudul']);



        Route::get('/permohonankp/index', [PendaftaranKPController::class, 'indexpermohonan']);
        Route::get('/permohonankp/create/{id}', [PendaftaranKPController::class, 'createpermohonan']);
        Route::put('/permohonankp/create/{id}', [PendaftaranKPController::class, 'storepermohonan']);

        Route::get('/balasankp/index', [PendaftaranKPController::class, 'indexbalasan']);
        Route::get('/balasankp/create/{id}', [PendaftaranKPController::class, 'createbalasan']);
        Route::put('/balasankp/create/{id}', [PendaftaranKPController::class, 'storebalasan']);

        Route::get('/seminarkp/index', [PendaftaranKPController::class, 'indexsemkp']);
        Route::get('/daftar-semkp/create/{id}', [PendaftaranKPController::class, 'createsemkp']);
        Route::put('/daftar-semkp/create/{id}', [PendaftaranKPController::class, 'storesemkp']);

        Route::get('/kpti10-kp/index', [PendaftaranKPController::class, 'indexkpti_10']);
        Route::get('/kpti10-kp/create/{id}', [PendaftaranKPController::class, 'createkpti_10']);
        Route::put('/kpti10-kp/create/{id}', [PendaftaranKPController::class, 'storekpti_10']);

        Route::get('/daftar-sempro/index', [PendaftaranSkripsiController::class, 'indexsempro']);
        Route::get('/daftar-sempro/create/{id}', [PendaftaranSkripsiController::class, 'createsempro']);
        Route::put('/daftar-sempro/create/{id}', [PendaftaranSkripsiController::class, 'storesempro']);

        Route::get('/daftar-sidang/index', [PendaftaranSkripsiController::class, 'indexsidang']);
        Route::get('/daftar-sidang/create/{id}', [PendaftaranSkripsiController::class, 'createsidang']);
        Route::put('/daftar-sidang/create/{id}', [PendaftaranSkripsiController::class, 'storesidang']);

        Route::get('/perpanjangan-revisi/create/{id}', [PendaftaranSkripsiController::class, 'createperpanjangan_revisi']);
        Route::put('/perpanjangan-revisi/create/{id}', [PendaftaranSkripsiController::class, 'storeperpanjangan_revisi']);

        Route::get('/perpanjangan1-skripsi/create/{id}', [PendaftaranSkripsiController::class, 'createperpanjangan1_skripsi']);
        Route::put('/perpanjangan1-skripsi/create/{id}', [PendaftaranSkripsiController::class, 'storeperpanjangan1_skripsi']);

        Route::put('/perpanjangan2-skripsi/create/{id}', [PendaftaranSkripsiController::class, 'storeperpanjangan2_skripsi']);

        Route::get('/penyerahan-buku-skripsi/create/{id}', [PendaftaranSkripsiController::class, 'createbukti_buku_skripsi']);
        Route::put('/penyerahan-buku-skripsi/create/{id}', [PendaftaranSkripsiController::class, 'storebukti_buku_skripsi']);


        Route::get('/profil-mhs/editpasswordmhs', [MahasiswaProfilController::class, 'editpswmhs']);
        Route::put('/profil-mhs/editpasswordmhs', [MahasiswaProfilController::class, 'updatepswmhs']);
        Route::get('/jadwal', [PenjadwalanController::class, 'jadwal_mahasiswa']);
        Route::get('/jadwal/mahasiswa', [PenjadwalanController::class, 'seminar_mahasiswa']);
        Route::get('/seminar', [PenjadwalanController::class, 'riwayat_mahasiswa']);



        // Route::get('/daftar-kp', [PendaftaranKPController::class, 'index']);

        Route::get('/daftar-kp', [PendaftaranController::class, 'daftarkp_mahasiswa']);

        Route::get('/daftar-kp/create', [PendaftaranKPController::class, 'createusulankp']);
        Route::post('/daftar-kp/create', [PendaftaranKPController::class, 'store']);

        Route::get('/status-kp/create', [PendaftaranKPController::class, 'create']);
        Route::post('/status-kp/create', [PendaftaranKPController::class, 'store']);


        //    INVENTARIS
        Route::get('/inventaris/peminjamanmhs', [PeminjamanMahasiswaController::class, 'index'])->name('peminjaman');
        Route::get('/inventaris/riwayatmhs', [RiwayatController::class, 'riwayatmhs'])->name('riwayatmhs');
        Route::get('/inventaris/delete/{id}', [PeminjamanMahasiswaController::class, 'destroy']);
        Route::get('/inventaris/edit/{id}', [PeminjamanMahasiswaController::class, 'edit']);
        Route::post('/inventaris/update/{id}', [PeminjamanMahasiswaController::class, 'update']);

        Route::get('/inventaris/formpinjam', [UsulanController::class, 'index'])->name('formusulan');
        Route::post('/inventaris/usulan', [UsulanController::class, 'create']);
    });



    Route::group(['middleware' => ['auth:web']], function () {

        Route::get('/matakuliah/create', [MataKuliahController::class, 'create']);
        Route::post('matakuliah/create', [MataKuliahController::class, 'store']);
        Route::get('/matakuliah/edit/{matakuliah:id}', [MatakuliahController::class, 'edit']);
        Route::put('/matakuliah/edit/{matakuliah:id}', [MataKuliahController::class, 'update']);

        Route::post('/delete', [MataKuliahController::class, 'destroy']);
        Route::get('/absensistatistikadmin', [AbsensiController::class, 'absensistatistikadmin'])->name('absensistatistikadmin');

        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi-index');
        // routes/web.php
        Route::get('/open-absensi/{classId}/{mataKuliahId}', 'AbsensiController@showOpenAbsensi');
        // web.php
        Route::get('/qr-code/{classId}', 'QRCodeController@showQRCode')->name('qr-code.show');
        Route::get('/gedung/create', [GedungController::class, 'create'])->name('create');
        Route::post('/gedung/create', [GedungController::class, 'store'])->name('store');
        Route::get('/gedung/edit/{gedung:id}', [GedungController::class, 'edit']);
        Route::put('/gedung/edit/{gedung:id}', [GedungController::class, 'update']);
        Route::post('/gedung/delete', [GedungController::class, 'destroy']);
        Route::get('/gedung/create-ruangan', [AbRuanganController::class, 'create'])->name('create-ruangan');
        Route::post('/gedung/create-ruangan', [AbRuanganController::class, 'store'])->name('store-ruangan');
        Route::get('/gedung/edit-ruangan/{ruangan:id}', [AbRuanganController::class, 'edit'])->name('edit-ruangan');
        Route::put('/gedung/edit-ruangan/{ruangan:id}', [AbRuanganController::class, 'update'])->name('update-ruangan');
        Route::post('/gedung/ruangan/delete', [AbRuanganController::class, 'destroy']);


        Route::get('/kp-skripsi/persetujuan/perpanjangan-revisi/{id}', [PendaftaranSkripsiController::class, 'detailpersetujuan_perpanjangan_revisi']);

        //APPROVAL ADMIN
        Route::put('/usulankp/admin/approve/{id}', [PendaftaranKPController::class, 'approveusulankp_admin']);
        Route::put('/usulankp/admin/tolak/{id}', [PendaftaranKPController::class, 'tolakusulankp_admin']);
        Route::put('/semkp/admin/approve/{id}', [PendaftaranKPController::class, 'approvesemkp_admin']);
        Route::put('/semkp/admin/tolak/{id}', [PendaftaranKPController::class, 'tolaksemkp_admin']);

        Route::put('/daftar-sempro/admin/approve/{id}', [PendaftaranSkripsiController::class, 'approvesempro_admin']);
        Route::put('/daftar-sempro/admin/tolak/{id}', [PendaftaranSkripsiController::class, 'tolaksempro_admin']);
        Route::put('/daftar-sidang/admin/approve/{id}', [PendaftaranSkripsiController::class, 'approvesidang_admin']);
        Route::put('/daftar-sidang/admin/tolak/{id}', [PendaftaranSkripsiController::class, 'tolaksidang_admin']);


        Route::put('/usuljudul/admin/approve/{id}', [PendaftaranSkripsiController::class, 'approveusuljudul_admin']);
        Route::put('/usuljudul/admin/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakusuljudul_admin']);
        Route::put('/persetujuansempro/admin/approve/{id}', [PenjadwalanSemproController::class, 'approve_sempro_admin']);
        Route::put('/persetujuansempro/admin/tolak/{id}', [PenjadwalanSemproController::class, 'tolak_sempro_admin']);

        Route::get('/kerja-praktek/admin/index', [PendaftaranController::class, 'pendaftaran_kp_admin']);
        Route::get('/sempro/admin/index', [PendaftaranController::class, 'pendaftaran_sempro_admin']);
        Route::get('/sidang/admin/index', [PendaftaranController::class, 'pendaftaran_sidang_admin']);
        Route::get('/persetujuan/admin/index', [PendaftaranController::class, 'persetujuan_admin']);
        Route::get('/persetujuan/admin/detail/usulankp/{id}', [PendaftaranController::class, 'detail_persetujuan_admin']);
        Route::get('/persetujuan/admin/detail/kpti10/{id}', [PendaftaranController::class, 'detail_persetujuan_kpti10_admin']);
        Route::get('/persetujuan/admin/detail/usulanjudul/{id}', [PendaftaranController::class, 'detail_persetujuan_usulanjudul_admin']);
        Route::get('/persetujuan/admin/detail/sempro/{id}', [PendaftaranController::class, 'detail_persetujuan_sempro_admin']);
        Route::get('/persetujuan/admin/detail/sidang/{id}', [PendaftaranController::class, 'detail_persetujuan_sidang_admin']);
        Route::get('/sidang/admin/perpanjangan-1/detail/{id}', [PendaftaranController::class, 'detail_perpanjangan_1_admin']);
        Route::get('/sidang/admin/perpanjangan-2/detail/{id}', [PendaftaranController::class, 'detail_perpanjangan_2_admin']);

        Route::get('/profil-staff/editpasswordstaff', [StaffProfilController::class, 'editpswstaff']);
        Route::put('/profil-staff/editpasswordstaff', [StaffProfilController::class, 'updatepswstaff']);

        Route::get('/dosen', [DosenController::class, 'index']);
        Route::get('/dosen/create', [DosenController::class, 'create']);
        Route::post('/dosen/create', [DosenController::class, 'store']);
        Route::get('/dosen/edit/{dosen:id}', [DosenController::class, 'edit']);
        Route::put('/dosen/edit/{dosen:id}', [DosenController::class, 'update']);
        Route::delete('/dosen/{dosen:id}', [DosenController::class, 'destroy']);

        Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create']);
        Route::post('/mahasiswa/create', [MahasiswaController::class, 'store']);
        Route::get('/mahasiswa/edit/{mahasiswa:id}', [MahasiswaController::class, 'edit']);
        Route::put('/mahasiswa/edit/{mahasiswa:id}', [MahasiswaController::class, 'update']);
        Route::delete('/mahasiswa/{mahasiswa:id}', [MahasiswaController::class, 'destroy']);

        Route::get('/role', [RoleController::class, 'index']);
        Route::get('/role/create', [RoleController::class, 'create']);
        Route::post('/role/create', [RoleController::class, 'store']);
        Route::get('/role/edit/{role:id}', [RoleController::class, 'edit']);
        Route::put('/role/edit/{role:id}', [RoleController::class, 'update']);
        Route::delete('/role/{role:id}', [RoleController::class, 'destroy']);

        Route::get('/prodi', [ProdiController::class, 'index']);
        Route::get('/prodi/create', [ProdiController::class, 'create']);
        Route::post('/prodi/create', [ProdiController::class, 'store']);
        Route::get('/prodi/edit/{prodi:id}', [ProdiController::class, 'edit']);
        Route::post('/update/{id}', [ProdiController::class, 'update'])->name('prodi.update');
        // Route::put('/prodi/edit/{prodi:id}', [ProdiController::class, 'update']);
        Route::delete('/prodi/{prodi:id}', [ProdiController::class, 'destroy']);

        Route::get('/konsentrasi', [KonsentrasiController::class, 'index']);
        Route::get('/konsentrasi/create', [KonsentrasiController::class, 'create']);
        Route::post('/konsentrasi/create', [KonsentrasiController::class, 'store']);
        Route::get('/konsentrasi/edit/{konsentrasi:id}', [KonsentrasiController::class, 'edit']);
        Route::put('/konsentrasi/edit/{konsentrasi:id}', [KonsentrasiController::class, 'update']);
        Route::delete('/konsentrasi/{konsentrasi:id}', [KonsentrasiController::class, 'destroy']);

        Route::get('/user', [UserController::class, 'index']);
        Route::get('/user/create', [UserController::class, 'create']);
        Route::post('/user/create', [UserController::class, 'store']);
        Route::get('/user/edit/{user:id}', [UserController::class, 'edit']);
        Route::put('/user/edit/{user:id}', [UserController::class, 'update']);
        Route::delete('/user/{user:id}', [UserController::class, 'destroy']);

        Route::get('/plp', [UserController::class, 'plp_index']);
        Route::get('/plp/create', [UserController::class, 'plp_create']);
        Route::post('/plp/create', [UserController::class, 'plp_store']);
        Route::get('/plp/edit/{user:id}', [UserController::class, 'plp_edit']);
        Route::put('/plp/edit/{user:id}', [UserController::class, 'plp_update']);


        //RESET PASSWORD 
        Route::put('/reset-password/mahasiswa/{id}', [MahasiswaController::class, 'reset_password']);
        Route::put('/reset-password/dosen/{id}', [DosenController::class, 'reset_password']);
        Route::put('/reset-password/user/{id}', [UserController::class, 'reset_password']);
    });


    Route::group(['middleware' => ['auth:dosen']], function () {
        Route::get('/matakuliah', [MataKuliahController::class, 'index'])->name('matakuliah.index');

        // Rute untuk mengupdate jenis perkuliahan
        Route::patch('/matakuliah/update-jenis-perkuliahan/{id}', [MataKuliahController::class, 'updateJenisPerkuliahan'])->name('update.jenis.perkuliahan');
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/open-absensi/{id}', [AbsensiController::class, 'showOpenAbsensi'])->name('showQrCode');
        Route::get('/absensi/open-absensi/{classId}', 'AbsensiController@openAbsensi')->name('absensi');
        Route::get('/absensi/riwayat-absensi', [AbsensiController::class, 'riwayat'])->name('riwayat-absensi');
        Route::get('/absensi/riwayat-absensi/{id}', [AbsensiController::class, 'detailriwayat'])->name('detail-riwayat');
        Route::get('/absensi/ruangan-absensi', [AbRuanganController::class, 'ruanganabsensi'])->name('ruangan-absensi');

        Route::delete('/delete/{id}', [AbsensiController::class, 'destroy'])->name('hapus');
        Route::get('/search/searchmahasiswa', [MahasiswaController::class, 'searchMahasiswa']);
        Route::post('/absensi/tambah-manual', [AbsensiController::class, 'tambahAbsensiManual'])->name('tambah_absensi_manual');
        Route::post('/buka-kelas', [AbsensiController::class, 'bukaKelas'])->name('buka_kelas');
        Route::post('/tutup/{id}', [AbsensiController::class, 'perkuliahan'])->name('tutup');
        Route::get('/absensistatistik', [AbsensiController::class, 'absensistatistik'])->name('absensistatistik');
        Route::get('/absensi/create', [AbsensiController::class, 'create']);
        Route::get('/detail-absensi', [AbsensiController::class, 'showLastAbsensiDetail'])->name('detail_absensi');
        Route::get('/absensi/mahasiswa/{perkuliahanId}', [AbsensiController::class, 'getAbsensiMahasiswa']);

        Route::get('/pendaftaran', [PendaftaranController::class, 'pendaftaran_kp_pembimbing']);
        Route::get('/kerja-praktek', [PendaftaranController::class, 'pendaftaran_kp']);

        Route::get('/kp-skripsi/pembimbing-penguji/riwayat-seminar', [PendaftaranController::class, 'riwayat_seminar_pembimbing_penguji']);
        Route::get('/pembimbing-penguji/riwayat-bimbingan', [PendaftaranController::class, 'riwayat_bimbingan_pembimbing_penguji']);

        Route::get('/skripsi', [PendaftaranController::class, 'pendaftaran_skripsi']);
        Route::get('/persetujuan-kp-skripsi', [PendaftaranController::class, 'persetujuankpskripsi_dosen']);
        Route::get('/kp-skripsi/persetujuan-skripsi', [PendaftaranController::class, 'persetujuanskripsi_dosen']);
        Route::get('/kp-skripsi/persetujuan/suratperusahaan/{id}', [PendaftaranKPController::class, 'detailpersetujuan_balasankp']);
        Route::get('/kp-skripsi/persetujuan/kpti10/{id}', [PendaftaranKPController::class, 'detailpersetujuan_kpti10']);
        Route::get('/pembimbing/kerja-praktek', [PendaftaranController::class, 'pendaftaran_kp_pembimbing']);

        Route::get('/kp-skripsi/persetujuan/usulanjudul/{id}', [PendaftaranSkripsiController::class, 'detailpersetujuan_usulanjudul']);
        Route::get('/kp-skripsi/persetujuan/sempro/{id}', [PendaftaranSkripsiController::class, 'detailpersetujuan_daftarsempro']);
        Route::get('/kp-skripsi/persetujuan/sidang/{id}', [PendaftaranSkripsiController::class, 'detailpersetujuan_daftarsidang']);
        Route::get('/kp-skripsi/persetujuan/perpanjangan-revisi/{id}', [PendaftaranSkripsiController::class, 'detailpersetujuan_perpanjangan_revisi']);
        Route::get('/kp-skripsi/persetujuan/perpanjangan-1/{id}', [PendaftaranSkripsiController::class, 'detailpersetujuan_perpanjangan_1']);
        Route::get('/kp-skripsi/persetujuan/perpanjangan-2/{id}', [PendaftaranSkripsiController::class, 'detailpersetujuan_perpanjangan_2']);
        Route::get('/kp-skripsi/persetujuan/bukti-buku-skripsi/{id}', [PendaftaranSkripsiController::class, 'detailpersetujuan_bukti_buku_skripsi']);
        Route::get('/kp-skripsi/pembimbing/perpanjangan-1/{id}', [PendaftaranSkripsiController::class, 'detail_perpanjangan_1_pemb']);
        Route::get('/kp-skripsi/pembimbing/perpanjangan-2/{id}', [PendaftaranSkripsiController::class, 'detail_perpanjangan_2_pemb']);
        Route::get('/kp-skripsi/pembimbing/perpanjangan-revisi/{id}', [PendaftaranSkripsiController::class, 'detail_perpanjangan_revisi_pemb']);
        Route::get('/kp-skripsi/pembimbing/bukti-buku-skripsi/{id}', [PendaftaranSkripsiController::class, 'detail_bukti_buku_skripsi']);
        Route::get('/kp-skripsi/riwayat/pembimbing/bukti-buku-skripsi/{id}', [PendaftaranSkripsiController::class, 'detail_riwayat_pemb_bukti_buku_skripsi']);


        Route::get('/pembimbing/skripsi', [PendaftaranController::class, 'pendaftaran_skripsi_pembimbing']);

        Route::get('/permohonan-kp/detail/pembimbing/{id}', [PendaftaranController::class, 'detailpermohonankp_pembimbing']);

        Route::get('/daftar-semkp/detail/pembimbing/{id}', [PendaftaranController::class, 'detailusulan_semkp_pembimbing']);

        Route::put('/usulan-semkp/pembimbing/approve/{id}', [PendaftaranKPController::class, 'approveusulan_semkp_pemb']);
        Route::put('/usulan-semkp/pembimbing/tolak/{id}', [PendaftaranKPController::class, 'tolakusulan_semkp_pemb']);

        Route::get('/usuljudul/detail/pembimbing2/{id}', [PendaftaranController::class, 'detailusuljudul_pembimbing2']);

        Route::put('/usulankp/pembimbing/approve/{id}', [PendaftaranKPController::class, 'approveusulankp_pemb']);
        Route::put('/usulankp/pembimbing/tolak/{id}', [PendaftaranKPController::class, 'tolakusulankp_pemb']);


        Route::put('/permohonankp/pembimbing/approve/{id}', [PendaftaranKPController::class, 'approvepermohonankp_pemb']);
        Route::put('/permohonankp-koordinator/pembimbing/tolak/{id}', [PendaftaranKPController::class, 'tolakpermohonankp_pembimbing']);

        Route::put('/usuljudul/pembimbing1/approve/{id}', [PendaftaranSkripsiController::class, 'approveusuljudul_pembimbing']);
        Route::put('/usuljudul/pembimbing1/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakusuljudul_pembimbing']);

        Route::put('/daftarsempro/pembimbing1/approve/{id}', [PendaftaranSkripsiController::class, 'approvedaftarsempro_pembimbing']);
        Route::put('/daftarsempro/pembimbing1/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakdaftarsempro_pembimbing']);

        Route::put('/daftarsidang/pembimbing1/approve/{id}', [PendaftaranSkripsiController::class, 'approvedaftarsidang_pembimbing']);
        Route::put('/daftarsidang/pembimbing1/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakdaftarsidang_pembimbing']);

        Route::put('/daftarsempro/pembimbing2/approve/{id}', [PendaftaranSkripsiController::class, 'approvedaftarsempro_pembimbing2']);
        Route::put('/daftarsempro/pembimbing2/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakdaftarsempro_pembimbing2']);

        Route::put('/daftarsidang/pembimbing2/approve/{id}', [PendaftaranSkripsiController::class, 'approvedaftarsidang_pembimbing2']);
        Route::put('/daftarsidang/pembimbing2/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakdaftarsidang_pembimbing2']);

        Route::put('/usuljudul/pembimbing2/approve/{id}', [PendaftaranSkripsiController::class, 'approveusuljudul_pembimbing2']);
        Route::put('/usuljudul/pembimbing2/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakusuljudul_pembimbing2']);

        Route::put('/selesaiseminar-kp/pembimbing/approve/{id}', [PendaftaranKPController::class, 'approveselesaiseminarkp_pemb']);
        Route::put('/selesaiseminar-kp/pembimbing/tolak/{id}', [PendaftaranKPController::class, 'tolakselesaiseminarkp_pemb']);

        Route::put('/selesaisempro/pembimbing/approve/{id}', [PendaftaranSkripsiController::class, 'approveselesaisempro_pemb']);
        Route::put('/selesaisempro/pembimbing/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakselesaisempro_pemb']);

        Route::put('/lewat-batas-sidang/hapus/{id}', [PendaftaranSkripsiController::class, 'lewat_batas_sidang']);
        Route::put('/lewat-batas-revisi-spesial/hapus/{id}', [PendaftaranSkripsiController::class, 'lewat_batas_revisi_spesial']);
        Route::put('/lewat-batas-penyerahan-skripsi/hapus/{id}', [PendaftaranSkripsiController::class, 'lewat_batas_penyerahan_skripsi']);

        Route::put('/selesaisidang/pembimbing/approve/{id}', [PendaftaranSkripsiController::class, 'approveselesaisidang_pemb']);
        Route::put('/selesaisidang/pembimbing/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakselesaisidang_pemb']);

        Route::put('/perpanjangan1/pembimbing/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan1_pembimbing']);
        Route::put('/perpanjangan1/pembimbing/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan1_pembimbing']);
        Route::put('/perpanjangan2/pembimbing/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan2_pembimbing']);
        Route::put('/perpanjangan2/pembimbing/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan2_pembimbing']);

        Route::put('/perpanjangan-revisi/pembimbing/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan_revisi_pembimbing']);
        Route::put('/perpanjangan-revisi/pembimbing/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan_revisi_pembimbing']);

        // Route::put('/perpanjangan-revisi/pembimbing2/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan_revisi_pembimbing1']);
        // Route::put('/perpanjangan-revisi/pembimbing2/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan_revisi_pembimbing1']);

        Route::get('/pendaftaran/kp', [PendaftaranController::class, 'daftarkp_dosen']);


        Route::put('/pendaftaran-kp/approve/{id}', [PendaftaranKPController::class, 'approve']);
        Route::get('/riwayatkp', [PendaftaranKPController::class, 'riwayat']);
        // Route::get('/nilai-kp/{id}', [PenjadwalanKPController::class, 'nilaikp']);
        // Route::get('/perbaikan-kp/{id}', [PenjadwalanKPController::class, 'perbaikan']);


        Route::get('/profil-dosen', [DosenProfilController::class, 'index']);
        Route::get('/profil-dosen/editfotodsn/{dosen:id}', [DosenProfilController::class, 'editfotodsn']);
        Route::put('/profil-dosen/editfotodsn/{dosen:id}', [DosenProfilController::class, 'updatefotodsn']);
        Route::get('/profil-dosen/editpassworddsn', [DosenProfilController::class, 'editpswdsn']);
        Route::put('/profil-dosen/editpassworddsn', [DosenProfilController::class, 'updatepswdsn']);


        Route::get('/prodi/kp-skripsi/seminar', [PenilaianController::class, 'index']);
        Route::get('/kp-skripsi/seminar-pembimbing-penguji', [PenilaianController::class, 'indexpembimbing']);
        Route::get('/kp-skripsi/riwayat-penilaian-seminar', [PenilaianController::class, 'riwayat']);
        Route::get('/kp-skripsi/riwayat-penilaian-skripsi', [PenilaianController::class, 'riwayatskripsi']);

        Route::get('/penilaian-kp', [PenilaianKPController::class, 'index']);
        Route::get('/penilaian-kp/create/{penjadwalan_kp:id}', [PenilaianKPController::class, 'create']);
        Route::post('/penilaian-kp-pembimbing/create/{penjadwalan_kp:id}', [PenilaianKPController::class, 'store_pembimbing']);
        Route::post('/penilaian-kp-penguji/create/{penjadwalan_kp:id}', [PenilaianKPController::class, 'store_penguji']);

        Route::post('/penilaian-kp-penguji-pembimbing-sama/create/{penjadwalan_kp:id}', [PenilaianKPController::class, 'store_pembimbing_penguji_sama']);
        Route::get('/penilaian-kp/edit/{penjadwalan_kp:id}', [PenilaianKPController::class, 'edit']);
        Route::put('/penilaian-kp-penguji/edit/{penilaian_kp_penguji:id}', [PenilaianKPController::class, 'update_penguji']);
        Route::put('/penilaian-kp-pembimbing/edit/{penilaian_kp_pembimbing:id}', [PenilaianKPController::class, 'update_pembimbing']);

        Route::put('/penilaian-kp-pembimbing-penguji/edit/sama/{penilaian_kp_penguji:penjadwalan_kp_id}', [PenilaianKPController::class, 'update_pembimbing_penguji_sama']);


        Route::put('/penilaian-kp/approve/{id}', [PenjadwalanKPController::class, 'approve']);
        Route::put('/penilaian-kp/tolak/{id}', [PenjadwalanKPController::class, 'tolak']);
        Route::get('/riwayat-penilaian-kp', [PenilaianKPController::class, 'riwayat']);
        Route::get('/nilai-kp/{id}', [PenjadwalanKPController::class, 'nilaikp']);
        Route::get('/perbaikan-kp/{id}', [PenjadwalanKPController::class, 'perbaikan']);

        Route::get('/undangan-kp/{id}', [UndanganSeminarController::class, 'undangan_kp']);
        Route::get('/undangan-sempro/{id}', [UndanganSeminarController::class, 'undangan_sempro']);
        Route::get('/undangan-sidang/{id}', [UndanganSeminarController::class, 'undangan_sidang']);

        Route::get('/penilaian-sempro', [PenilaianSemproController::class, 'index']);
        Route::get('/penilaian-sempro/create/{penjadwalan_sempro:id}', [PenilaianSemproController::class, 'create']);
        Route::post('/penilaian-sempro-pembimbing/create/{penjadwalan_sempro:id}', [PenilaianSemproController::class, 'store_pembimbing']);
        Route::post('/penilaian-sempro-penguji/create/{penjadwalan_sempro:id}', [PenilaianSemproController::class, 'store_penguji']);
        Route::get('/penilaian-sempro/edit/{penjadwalan_sempro:id}', [PenilaianSemproController::class, 'edit']);
        Route::put('/penilaian-sempro-pembimbing/edit/{penilaian_sempro_pembimbing:id}', [PenilaianSemproController::class, 'update_pembimbing']);
        Route::put('/penilaian-sempro-penguji/edit/{penjadwalan_sempro_id:id}', [PenilaianSemproController::class, 'update_penguji']);


        Route::put('/penilaian-sempro/approve/{id}', [PenjadwalanSemproController::class, 'approve']);
        Route::put('/penilaian-sempro/gagal/{id}', [PenjadwalanSemproController::class, 'gagal']);
        Route::get('/riwayat-penilaian-sempro', [PenilaianSemproController::class, 'riwayat']);
        Route::get('/nilai-sempro/{id}', [PenjadwalanSemproController::class, 'nilaisempro']);
        Route::get('/perbaikan-sempro/{id}', [PenjadwalanSemproController::class, 'perbaikan']);
        Route::post('/revisi-proposal/create/{id}', [PenjadwalanSemproController::class, 'revisiproposal']);
        Route::post('/catatansempro/create/{id}', [PenjadwalanSemproController::class, 'catatansempro']);


        Route::get('/penilaian-skripsi', [PenilaianSkripsiController::class, 'index']);
        Route::get('/penilaian-skripsi/create/{penjadwalan_skripsi:id}', [PenilaianSkripsiController::class, 'create']);
        Route::post('/penilaian-skripsi-pembimbing/create/{penjadwalan_skripsi:id}', [PenilaianSkripsiController::class, 'store_pembimbing']);
        Route::post('/penilaian-skripsi-penguji/create/{penjadwalan_skripsi:id}', [PenilaianSkripsiController::class, 'store_penguji']);
        Route::get('/penilaian-skripsi/edit/{penjadwalan_skripsi:id}', [PenilaianSkripsiController::class, 'edit']);
        Route::put('/penilaian-skripsi-pembimbing/edit/{penilaian_skripsi_pembimbing:id}', [PenilaianSkripsiController::class, 'update_pembimbing']);
        Route::put('/penilaian-skripsi-penguji/edit/{penilaian_skripsi_penguji:id}', [PenilaianSkripsiController::class, 'update_penguji']);
        Route::put('/penilaian-skripsi/approve/{id}', [PenjadwalanSkripsiController::class, 'approve']);
        Route::put('/penilaian-skripsi/tolak/{id}', [PenjadwalanSkripsiController::class, 'tolak']);
        Route::get('/riwayat-penilaian-skripsi', [PenilaianSkripsiController::class, 'riwayat']);
        Route::get('/nilai-skripsi/{id}', [PenjadwalanSkripsiController::class, 'nilaiskripsi']);
        Route::get('/perbaikan-skripsi/{id}', [PenjadwalanSkripsiController::class, 'perbaikan']);
        Route::post('/revisi-skripsi/create/{id}', [PenjadwalanSkripsiController::class, 'revisiskripsi']);
        Route::post('/catatanskripsi/create/{id}', [PenjadwalanSkripsiController::class, 'catatanskripsi']);
        Route::put('/nilaijurnal/create/{id}', [PenjadwalanSkripsiController::class, 'nilaijurnal']);



        //    INVENTARIS DOSEN
        Route::get('/inventaris/peminjaman-dosen', [PeminjamanDosenController::class, 'index'])->name('peminjamandsn');
        Route::get('/inventaris/riwayat-dosen', [RiwayatController::class, 'riwayatdsn'])->name('riwayatdsn');
        Route::get('/inventaris/delete-dosen/{id}', [PeminjamanDosenController::class, 'destroydsn']);
        Route::get('/inventaris/edit-dosen/{id}', [PeminjamanDosenController::class, 'editdsn']);
        Route::post('/inventaris/update-dosen/{id}', [PeminjamanDosenController::class, 'updatedsn']);

        Route::get('/inventaris/formpinjam-dosen', [UsulanController::class, 'indexdsn'])->name('formusulandosen');
        Route::post('/inventaris/usulan-dosen', [UsulanController::class, 'createdsn']);
    });




    Route::group(['middleware' => ['auth:web']], function () {

        Route::get('/form', [PenjadwalanController::class, 'index'])->name('form');
        Route::get('/riwayat-penjadwalan', [PenjadwalanController::class, 'riwayat']);
        Route::delete('/clear', [PenjadwalanController::class, 'clear']);

        Route::get('/form-kp', [PenjadwalanKPController::class, 'index']);
        Route::get('/form-kp/create', [PenjadwalanKPController::class, 'create']);
        Route::post('/form-kp/create', [PenjadwalanKPController::class, 'store']);

        Route::delete('/form-kp/{penjadwalan_kp:id}', [PenjadwalanKPController::class, 'destroy']);
        Route::get('/riwayat-penjadwalan-kp', [PenjadwalanKPController::class, 'riwayat']);


        Route::get('/form-sempro', [PenjadwalanSemproController::class, 'index']);
        Route::get('/form-sempro/create', [PenjadwalanSemproController::class, 'create']);
        Route::post('/form-sempro/create', [PenjadwalanSemproController::class, 'store']);
        Route::get('/form-sempro/edit/{penjadwalan_sempro:id}', [PenjadwalanSemproController::class, 'edit']);
        Route::put('/form-sempro/edit/{penjadwalan_sempro:id}', [PenjadwalanSemproController::class, 'update']);
        Route::delete('/form-sempro/{penjadwalan_sempro:id}', [PenjadwalanSemproController::class, 'destroy']);
        Route::get('/riwayat-penjadwalan-sempro', [PenjadwalanSemproController::class, 'riwayat']);
        Route::get('/penilaian-sempro/riwayat-judul/{id}', [PenjadwalanSemproController::class, 'riwayatjudul']);

        Route::get('/form-skripsi', [PenjadwalanSkripsiController::class, 'index']);
        Route::get('/form-skripsi/create', [PenjadwalanSkripsiController::class, 'create']);
        Route::post('/form-skripsi/create', [PenjadwalanSkripsiController::class, 'store']);
        Route::get('/form-skripsi/edit/{penjadwalan_skripsi:id}', [PenjadwalanSkripsiController::class, 'edit']);
        Route::put('/form-skripsi/edit/{penjadwalan_skripsi:id}', [PenjadwalanSkripsiController::class, 'update']);
        Route::delete('/form-skripsi/{penjadwalan_skripsi:id}', [PenjadwalanSkripsiController::class, 'destroy']);
        Route::get('/riwayat-penjadwalan-skripsi', [PenjadwalanSkripsiController::class, 'riwayat']);
        Route::get('/penilaian-skripsi/riwayat-judul/{id}', [PenjadwalanSkripsiController::class, 'riwayatjudul']);


        // INVENTARIS
        Route::get('/inventaris/peminjamanadm', [PeminjamanAdminController::class, 'index'])->name('peminjamanadm');
        Route::get('/inventaris/setuju/{id}', [PeminjamanAdminController::class, 'setuju']);
        Route::get('/inventaris/tolak/{id}', [PeminjamanAdminController::class, 'ditolak']);
        Route::get('/inventaris/kembali/{id}', [PeminjamanAdminController::class, 'kembali']);
        Route::get('/inventaris/riwayatadm', [RiwayatController::class, 'riwayat'])->name('riwayatadm');
        Route::get('/inventaris/stok', [BarangController::class, 'index'])->name('stok');
        Route::post('/inventaris/stokbaru', [BarangController::class, 'create'])->name('stokbaru');
        Route::get('/inventaris/tambahbarang', [BarangController::class, 'addbarang'])->name('tambahbarang');
        Route::delete('/inventaris/deletebarang/{id}', [BarangController::class, 'destroy'])->name('deletebarang');
        Route::get('/inventaris/editbarang/{id}', [BarangController::class, 'edit'])->name('editbarang');
        Route::put('/inventaris/updatebarang/{id}', [BarangController::class, 'update'])->name('updatebarang');

        // PENGATURAN KUOTA BIMBINGAN
        Route::get('/kapasitas-bimbingan/index', [PendaftaranKPController::class, 'kapasitas_index']);
        Route::get('/kapasitas-bimbingan/edit/{id}', [PendaftaranKPController::class, 'kapasitas_bimbingan_edit']);
        Route::post('/kapasitas-bimbingan/edit/{id}', [PendaftaranKPController::class, 'kapasitasbimbingan_store']);
    });

    Route::group(['middleware' => ['auth:web,dosen']], function () {
        Route::get('/ceknilai-kp/{id}', [PenjadwalanKPController::class, 'ceknilaikp']);
        Route::get('/nilai-kp/{id}', [PenjadwalanKPController::class, 'nilaikp']);
        Route::get('/beritaacara-kp/{id}', [PenjadwalanKPController::class, 'beritaacarakp']);

        Route::get('/perbaikan-pengujikp/{id}/{penguji}', [PenjadwalanKPController::class, 'perbaikanpengujikp']);

        Route::get('/nilai-sempro-pembimbing/{id}/{pembimbing}', [PenjadwalanSemproController::class, 'nilaipembimbing']);
        Route::get('/nilai-sempro-penguji/{id}/{penguji}', [PenjadwalanSemproController::class, 'nilaipenguji']);
        Route::get('/nilai-skripsi-pembimbing/{id}/{pembimbing}', [PenjadwalanSkripsiController::class, 'nilaipembimbing']);
        Route::get('/nilai-skripsi-penguji/{id}/{penguji}', [PenjadwalanSkripsiController::class, 'nilaipenguji']);
        Route::get('/perbaikan-pengujisempro/{id}/{penguji}', [PenjadwalanSemproController::class, 'perbaikanpengujisempro']);
        Route::get('/perbaikan-pengujiskripsi/{id}/{penguji}', [PenjadwalanSkripsiController::class, 'perbaikanpengujiskripsi']);
        Route::get('/penilaian-sempro/cek-nilai/{id}', [PenjadwalanSemproController::class, 'ceknilai']);
        Route::get('/penilaian-sempro/beritaacara-sempro/{id}', [PenjadwalanSemproController::class, 'beritaacarasempro']);
        Route::get('/penilaian-skripsi/cek-nilai/{id}', [PenjadwalanSkripsiController::class, 'ceknilai']);
        Route::get('/penilaian-skripsi/draft-ba/{id}', [PenjadwalanSkripsiController::class, 'draft']);
        Route::get('/penilaian-skripsi/beritaacara-skripsi/{id}', [PenjadwalanSkripsiController::class, 'beritaacaraskripsi']);


        Route::put('/sempro/undur/admin/{id}', [PenjadwalanSemproController::class, 'undur_sempro_admin']);
        Route::post('/sempro/undur/admin/{alasan}', [PenjadwalanSemproController::class, 'undur_sempro_admin']);

        Route::put('/sidang/undur/admin/{id}', [PenjadwalanSkripsiController::class, 'undur_sidang_admin']);
        Route::post('/sidang/undur/admin/{alasan}', [PenjadwalanSkripsiController::class, 'undur_sidang_admin']);

        Route::put('/sempro/undur/koordinator/{id}', [PenjadwalanSemproController::class, 'undur_sempro_koordinator']);
        Route::post('/sempro/undur/koordinator/{alasan}', [PenjadwalanSemproController::class, 'undur_sempro_koordinator']);

        Route::put('/sidang/undur/koordinator/{id}', [PenjadwalanSkripsiController::class, 'undur_sidang_koordinator']);
        Route::post('/sidang/undur/koordinator/{alasan}', [PenjadwalanSkripsiController::class, 'undur_sidang_koordinator']);

        // LEWAT BATAS
        Route::put('/lewat-batas-kp/hapus/{id}', [PendaftaranKPController::class, 'pop_up_lewat_batas_kp']);
        Route::put('/lewat-batas-kp/pembimbing/hapus/{id}', [PendaftaranKPController::class, 'pop_up_lewat_batas_kp_pembimbing']);
        Route::put('/lewat-batas-skripsi/hapus/{id}', [PendaftaranSkripsiController::class, 'pop_up_lewat_batas_skripsi']);

        // BERITA ACARA FINAL
        Route::get('/berita-acara-final/{id}', [PendaftaranSkripsiController::class, 'beritaacarafinal']);
    });

    Route::group(['middleware' => ['auth:web,dosen,mahasiswa']], function () {
        Route::get('/surat-permohonan-kp/{id}', [PendaftaranKPController::class, 'suratpermohonankp']);

        Route::get('/form-permohonan-kp/{id}', [PendaftaranKPController::class, 'formpermohonankp']);

        Route::get('/surat-permohonan-pengajuan-topik-skripsi/{id}', [PendaftaranSkripsiController::class, 'suratpermohonanpengajuantopikskripsi']);

        Route::get('/form-pengajuan-topik-skripsi/{id}', [PendaftaranSkripsiController::class, 'formpengajuantopikskripsi']);

        Route::get('/kpti10-kp/detail/{id}', [PendaftaranKPController::class, 'detailkpti_10']);
        Route::get('/kpti10-kp/detail/riwayat/{id}', [PendaftaranKPController::class, 'detail_riwayat_prodi_kpti_10']);
        Route::get('/perpanjangan-revisi/detail/{id}', [PendaftaranSkripsiController::class, 'detailperpanjangan_revisi']);
        Route::get('/perpanjangan-1/detail/{id}', [PendaftaranSkripsiController::class, 'detailperpanjangan_1']);
        Route::get('/perpanjangan-2/detail/{id}', [PendaftaranSkripsiController::class, 'detailperpanjangan_2']);
        Route::get('/bukti-buku-skripsi/detail/{id}', [PendaftaranSkripsiController::class, 'detailbukti_buku_skripsi']);
        Route::get('/bukti-buku-skripsi/riwayat/detail/{id}', [PendaftaranSkripsiController::class, 'detail_riwayat_prodi_bukti_buku_skripsi']);

        Route::get('/statistik', [StatistikController::class, 'index']);

        Route::get('/statistik/bimbingan-kp', [StatistikController::class, 'bimbingan_kp']);

        Route::get('/statistik/bimbingan-skripsi', [StatistikController::class, 'bimbingan_skripsi']);

        Route::get('/statistik/judul-skripsi-terdaftar', [StatistikController::class, 'judul_skripsi_terdaftar']);

        Route::get('/statistik/riwayat-kp', [StatistikController::class, 'riwayat_lokasi_kp']);

        Route::get('/detail/kuota-bimbingan/kp/{nip}', [PendaftaranController::class, 'detail_kuota_bimbingan_kp']);
        Route::get('/detail/lulus-bimbingan/kp/{nip}', [StatistikController::class, 'detail_lulus_bimbingan_kp']);
        Route::get('/detail/lulus-bimbingan/skripsi/{nip}', [StatistikController::class, 'detail_lulus_bimbingan_skripsi']);

        Route::get('/detail/kuota-bimbingan/skripsi/{nip}', [PendaftaranController::class, 'detail_kuota_bimbingan_skripsi']);
        Route::get('/kuota-bimbingan/kp', [PendaftaranController::class, 'kuotabimbingan_kp']);
        Route::get('/kuota-bimbingan/skripsi', [PendaftaranController::class, 'kuotabimbingan_skripsi']);


        Route::get('/daftar-semkp/detail/{id}', [PendaftaranKPController::class, 'detailusulansemkp']);
        Route::get('/daftar-sempro/detail/{id}', [PendaftaranSkripsiController::class, 'detailsempro']);
        Route::get('/daftar-sidang/detail/{id}', [PendaftaranSkripsiController::class, 'detailsidang']);

        Route::get('/perbaikan-pengujikp/{id}/{penguji}', [PenjadwalanKPController::class, 'perbaikanpengujikp']);
        Route::get('/perbaikan-pengujisempro/{id}/{penguji}', [PenjadwalanSemproController::class, 'perbaikanpengujisempro']);
        Route::get('/perbaikan-pengujiskripsi/{id}/{penguji}', [PenjadwalanSkripsiController::class, 'perbaikanpengujiskripsi']);

        Route::get('/surat-permohonankp/{id}', [PendaftaranKPController::class, 'kpti_1']);
    });

    //ADMIN DAN KOORDINATOR

    Route::group(['middleware' => ['auth:dosen', 'cekrole:9,10,11']], function () {
        Route::get('/form-kp/edit/koordinator/{id}', [PenjadwalanKPController::class, 'edit_koordinator']);
        Route::put('/form-kp/edit/koordinator/{penjadwalan_kp:id}', [PenjadwalanKPController::class, 'update_koordinator']);

        Route::get('/form-sempro/edit/koordinator/{penjadwalan_sempro:id}', [PenjadwalanSemproController::class, 'edit_koordinator']);
        Route::put('/form-sempro/edit/koordinator/{penjadwalan_sempro:id}', [PenjadwalanSemproController::class, 'update_koordinator']);

        Route::get('/form-skripsi/edit/koordinator/{penjadwalan_skripsi:id}', [PenjadwalanSkripsiController::class, 'edit_koordinator']);
        Route::put('/form-skripsi/edit/koordinator/{penjadwalan_skripsi:id}', [PenjadwalanSkripsiController::class, 'update_koordinator']);
    });
    Route::group(['middleware' =>  ['auth:web']], function () {
        Route::get('/form-kp/edit/{id}', [PenjadwalanKPController::class, 'edit']);
        Route::put('/form-kp/edit/{penjadwalan_kp:id}', [PenjadwalanKPController::class, 'update']);
    });

    // BATAS

    Route::group(['middleware' => ['auth:dosen', 'cekrole:9,10,11']], function () {

        Route::put('/lewat-batas-balasan/hapus/{id}', [PendaftaranKPController::class, 'lewat_batas_balasan']);

        Route::get('/developer/create', [DeveloperController::class, 'create']);
        Route::post('/developer/create', [DeveloperController::class, 'store']);

        Route::get('/developer/edit/{id}', [DeveloperController::class, 'edit']);
        Route::put('/developer/edit/{id}', [DeveloperController::class, 'update']);

        Route::get('/persetujuan-koordinator', [PenjadwalanController::class, 'persetujuan_koordinator']);
        Route::get('/persetujuan-koordinator/detail/{id}', [PenjadwalanController::class, 'detail_persetujuan_koordinator']);

        Route::get('/riwayat-koordinator', [PenjadwalanController::class, 'riwayat_koordinator']);
        Route::put('/persetujuankp-koordinator/approve/{id}', [PenjadwalanKPController::class, 'approve_koordinator']);
        Route::put('/persetujuankp-koordinator/tolak/{id}', [PenjadwalanKPController::class, 'tolak_koordinator']);

        Route::put('/persetujuanskripsi-koordinator/approve/{id}', [PenjadwalanSkripsiController::class, 'approve_koordinator']);
        Route::put('/persetujuanskripsi-koordinator/tolak/{id}', [PenjadwalanSkripsiController::class, 'tolak_koordinator']);

        Route::put('/usulankp/koordinator/approve/{id}', [PendaftaranKPController::class, 'approveusulankp_koordinator']);
        Route::put('/usulankp/koordinator/tolak/{id}', [PendaftaranKPController::class, 'tolakusulan_koordinator']);
        Route::put('/balasankp/koordinator/approve/{id}', [PendaftaranKPController::class, 'approvebalasankp_koordinator']);
        Route::put('/balasankp/koordinator/tolak/{id}', [PendaftaranKPController::class, 'tolakbalasankp_koordinator']);
        Route::put('/kpti10/koordinator/approve/{id}', [PendaftaranKPController::class, 'approvekpti10_koordinator']);
        Route::put('/kpti10/koordinator/tolak/{id}', [PendaftaranKPController::class, 'tolakkpti10_koordinator']);

        Route::put('/usuljudul/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approveusuljudul']);
        Route::put('/usuljudul/koordinator/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakusuljudul_koordinator']);

        Route::put('/daftarsempro/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approvedaftarsempro_koordinator']);
        Route::put('/daftarsempro/koordinator/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakdaftarsempro_koordinator']);


        Route::put('/perpanjangan2/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan2_koordinator']);
        Route::put('/perpanjangan2/koordinator/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan2_koordinator']);

        Route::put('/perpanjangan-revisi/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan_revisi_koordinator']);
        Route::put('/perpanjangan-revisi/koordinator/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan_revisi_koordinator']);

        Route::put('/buku-skripsi/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approvebuku_skripsi_koordinator']);
        Route::put('/buku-skripsi/koordinator/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakbuku_skripsi_koordinator']);

        Route::put('/daftarsidang/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approvedaftarsidang_koordinator']);
        Route::put('/daftarsidang/koordinator/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakdaftarsidang_koordinator']);

        Route::put('/nilaikpkeluar/koordinator/approve/{id}', [PendaftaranKPController::class, 'approvenilai_keluar_koordinator']);

        Route::put('/nilaiskripsikeluar/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approvelulus_koordinator']);

        Route::put('/usulan-semkp/koordinator/approve/{id}', [PendaftaranKPController::class, 'approveusulan_semkp_koordinator']);
        Route::put('/usulan-semkp/koordinator/tolak/{id}', [PendaftaranKPController::class, 'tolak_semkp_koordinator']);
        Route::put('/daftar-sempro/koordinator/tolak/{id}', [PendaftaranSkripsiController::class, 'tolak_sempro_koordinator']);
        Route::put('/daftar-sempro/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approve_sempro_koordinator']);
        Route::put('/daftar-sidang/koordinator/tolak/{id}', [PendaftaranSkripsiController::class, 'tolak_sidang_koordinator']);
        Route::put('/daftar-sidang/koordinator/approve/{id}', [PendaftaranSkripsiController::class, 'approve_sidang_koordinator']);


        // Route::get('/daftarkp-koordinator/{id}', [PendaftaranController::class, 'daftarkp_koordinator_detail']);

        Route::put('/pendaftarankp-koordinator/approve/{id}', [PendaftaranKPController::class, 'approve_koordinator']);
        Route::put('/perdaftarankp-koordinator/tolak/{id}', [PendaftaranKPController::class, 'tolak_koordinator']);
    });

    // PLP

    Route::group(['middleware' => ['auth:web', 'cekrole:12']], function () {

        // INVENTARIS
        Route::get('/inventaris/peminjaman-plp', [PeminjamanPLPController::class, 'index'])->name('peminjamanplp');
        Route::get('/inventaris/setuju-plp/{id}', [PeminjamanPLPController::class, 'setujuplp']);
        Route::get('/inventaris/tolak-plp/{id}', [PeminjamanPLPController::class, 'ditolakplp']);
        Route::get('/inventaris/kembali-plp/{id}', [PeminjamanPLPController::class, 'kembaliplp']);
        Route::get('/inventaris/riwayat', [RiwayatController::class, 'riwayatplp'])->name('riwayatplp');
        Route::get('/inventaris/stok-plp', [BarangController::class, 'indexplp'])->name('stokplp');
        Route::post('/inventaris/stokbaru-plp', [BarangController::class, 'createplp'])->name('stokbaruplp');
        Route::get('/inventaris/tambahbarang-plp', [BarangController::class, 'addbarangplp'])->name('tambahbarangplp');
        Route::delete('/inventaris/deletebarang-plp/{id}', [BarangController::class, 'destroyplp'])->name('deletebarangplp');
        Route::get('/inventaris/editbarang-plp/{id}', [BarangController::class, 'editplp'])->name('editbarangplp');
        Route::put('/inventaris/updatebarang-plp/{id}', [BarangController::class, 'updateplp'])->name('updatebarangplp');
    });



    Route::group(['middleware' => ['auth:dosen', 'cekrole:6,7,8']], function () {
        //APPROVAL USULAN KP
        Route::put('/usulankp/kaprodi/approve/{id}', [PendaftaranKPController::class, 'approveusulankp_kaprodi']);
        Route::put('/usulankp/kaprodi/tolak/{id}', [PendaftaranKPController::class, 'tolakusulan_kaprodi']);

        Route::get('/persetujuan-kaprodi/detail/{id}', [PenjadwalanController::class, 'detail_persetujuan_kaprodi']);

        Route::put('/usulan-semkp/kaprodi/approve/{id}', [PendaftaranKPController::class, 'approveusulan_semkp_kaprodi']);
        Route::put('/usulan-semkp/kaprodi/tolak/{id}', [PendaftaranKPController::class, 'tolak_semkp_kaprodi']);

        Route::put('/perpanjangan1/kaprodi/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan1_kaprodi']);
        Route::put('/perpanjangan1/kaprodi/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan1_kaprodi']);
        Route::put('/perpanjangan2/kaprodi/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan2_kaprodi']);
        Route::put('/perpanjangan2/kaprodi/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan2_kaprodi']);

        Route::put('/perpanjangan-revisi/kaprodi/approve/{id}', [PendaftaranSkripsiController::class, 'approveperpanjangan_revisi_kaprodi']);
        Route::put('/perpanjangan-revisi/kaprodi/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakperpanjangan_revisi_kaprodi']);


        Route::put('/usuljudul/kaprodi/approve/{id}', [PendaftaranSkripsiController::class, 'approveusuljudul_kaprodi']);
        Route::put('/usuljudul/kaprodi/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakusuljudul_kaprodi']);

        Route::put('/daftarsempro/kaprodi/approve/{id}', [PendaftaranSkripsiController::class, 'approvedaftarsempro_kaprodi']);
        Route::put('/daftarsempro/kaprodi/tolak/{id}', [PendaftaranSkripsiController::class, 'tolakdaftarsempro_kaprodi']);


        Route::put('/daftar-sidang/kaprodi/tolak/{id}', [PendaftaranSkripsiController::class, 'tolak_sidang_kaprodi']);
        Route::put('/daftar-sidang/kaprodi/approve/{id}', [PendaftaranSkripsiController::class, 'approve_sidang_kaprodi']);

        Route::get('/persetujuan-kaprodi', [PenjadwalanController::class, 'persetujuan_kaprodi']);
        Route::get('/riwayat-kaprodi', [PenjadwalanController::class, 'riwayat_kaprodi']);
        Route::put('/persetujuankp-kaprodi/approve/{id}', [PenjadwalanKPController::class, 'approve_kaprodi']);
        Route::put('/persetujuankp-kaprodi/tolak/{id}', [PenjadwalanKPController::class, 'tolak_kaprodi']);
        Route::put('/persetujuansempro-kaprodi/approve/{id}', [PenjadwalanSemproController::class, 'approve_kaprodi']);
        Route::put('/persetujuansempro-kaprodi/tolak/{id}', [PenjadwalanSemproController::class, 'tolak_kaprodi']);
        Route::put('/persetujuanskripsi-kaprodi/approve/{id}', [PenjadwalanSkripsiController::class, 'approve_kaprodi']);
        Route::put('/persetujuanskripsi-kaprodi/tolak/{id}', [PenjadwalanSkripsiController::class, 'tolak_kaprodi']);

        Route::put('/perpanjang-revisi/spesial/kaprodi/{id}', [PendaftaranSkripsiController::class, 'spesial_kaprodi']);
    });
});

Route::group(['middleware' => ['auth:dosen,mahasiswa']], function () {

    Route::get('/kp-skripsi', [PendaftaranKPController::class, 'index']);

    Route::get('/usulan/detail/{id}', [PendaftaranKPController::class, 'detailusulankp']);

    Route::get('/usuljudul/detail/{id}', [PendaftaranSkripsiController::class, 'detailusuljudul']);

    Route::get('/permohonan-kp/detail/{id}', [PendaftaranKPController::class, 'detailpermohonankp']);

    Route::get('/balasan-kp/detail/{id}', [PendaftaranKPController::class, 'detailbalasankp']);

    Route::get('/balasan-kp/index', [PendaftaranKPController::class, 'indexbalasan']);
    Route::get('/balasan-kp/create', [PendaftaranKPController::class, 'create']);
    Route::post('/balasan-kp/create', [PendaftaranKPController::class, 'store']);
});

Route::group(['middleware' => ['auth:dosen,web']], function () {
    Route::post('/update-kesesuaian', [RekapitulasiController::class, 'updateKesesuaian'])->name('update.kesesuaian');
    Route::get('/rekapitulasi-perkuliahan/pdf/{class_id}', [RekapitulasiController::class, 'downloadPDF'])->name('rekapitulasi.pdf');

    Route::get('/matakuliah', [MataKuliahController::class, 'index']);
    Route::get('/matakuliah/riwayat', [MataKuliahController::class, 'riwayat'])->name('riwayat');

    Route::get('/gedung', [GedungController::class, 'index'])->name('gedung');
    Route::get('/gedung/ruangan', [AbRuanganController::class, 'ruangan'])->name('ruangan');
    Route::get('/daftar-perkuliahan/{matakuliah_id}', [MataKuliahController::class, 'detailstatistik'])->name('detail.statistik');

    Route::get('/matakuliah/ruangan-absensi', [AbRuanganController::class, 'ruanganabsensiadmin'])->name('ruangan-absensi-admin');

    Route::get('/absensistatistik/detail-statistik/{class_id}', [AbsensiController::class, 'detailstatistik'])->name('detailStatistik');
    Route::get('/absensistatistik/statistik-ruangan', [AbsensiController::class, 'statistikruangan'])->name('statistik-ruangan');
    Route::get('/download_pdf/{class_id}', [AbsensiController::class, 'download_pdf'])->name('download_pdf_class');
    Route::get('/download_pdf/{matakuliah_id}', [MataKuliahController::class, 'download_pdf'])->name('download_pdf');

    Route::get('/daftar-presensi-mahasiswa/{perkuliahan_id}', [MataKuliahController::class, 'daftarhadir'])->name('daftarhadir');

    Route::get('/usulan/detail/pembimbingprodi/{id}', [PendaftaranController::class, 'detailusulan_pembimbing']);
    Route::get('/suratperusahaan/detail/pembimbingprodi/{id}', [PendaftaranController::class, 'detailbalasan_pembimbing']);
    Route::get('/kpti10/detail/pembimbingprodi/{id}', [PendaftaranController::class, 'detailkpti10_pembimbing']);
    Route::get('/kpti10/detail/riwayat/pembimbingprodi/{id}', [PendaftaranController::class, 'detail_riwayat_kpti10_pembimbing']);

    Route::get('/prodi/riwayat', [PendaftaranController::class, 'riwayat_prodi']);

    Route::get('/kerja-praktek/nilai-keluar', [PendaftaranController::class, 'nilai_keluar']);

    Route::get('/skripsi/nilai-keluar', [PendaftaranController::class, 'lulus']);

    Route::get('/usuljudul/detail/pembimbing/{id}', [PendaftaranController::class, 'detailusuljudul_pembimbing']);

    Route::get('/daftar-sempro/detail/pembimbing/{id}', [PendaftaranController::class, 'detailsempro_pemb']);

    Route::get('/daftar-sidang/detail/pembimbing/{id}', [PendaftaranController::class, 'detailsidang_pemb']);

    Route::get('/kp-skripsi/persetujuan/usulankp/{id}', [PendaftaranKPController::class, 'detailpersetujuan_usulankp']);
    Route::get('/kp-skripsi/persetujuan/semkp/{id}', [PendaftaranKPController::class, 'detailpersetujuan_semkp']);
});
