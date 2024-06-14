<?php

use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\Mbkm\ApprovalController;
use App\Http\Controllers\Mbkm\LogbookController;
use App\Http\Controllers\Mbkm\MbkmController;
use App\Http\Controllers\Mbkm\PenilaianMbkmController;
use App\Http\Controllers\Mbkm\SertifikatMbkmController;
use App\Http\Controllers\ProgramMbkmController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:dosen,web,mahasiswa']], function () {
    Route::prefix('/mbkm')->group(function () {

        Route::group(['middleware' => ['auth:mahasiswa']], function () {
            Route::get('/mahasiswa', [MbkmController::class, 'mahasiswaIndex'])->name('mbkm');
            Route::get('/mahasiswa/create', [MbkmController::class, 'create'])->name('mbkm.create');
            Route::get('/mahasiswa/riwayat', [MbkmController::class, 'mahasiswaRiwayat'])->name('mbkm.riwayat');
            Route::post('/usulan', [MbkmController::class, 'store'])->name('mbkm.store');
            Route::post('/uploaded/{mbkm:id}', [MbkmController::class, 'uploaded'])->name('mbkm.uploaded');

            Route::get('/{mbkm:id}/sertifikat/create', [SertifikatMbkmController::class, 'create'])->name('mbkm.sertif.create');
            Route::post('/sertifikat/create', [SertifikatMbkmController::class, 'store'])->name('mbkm.sertif.store');
            Route::post('/sertifikat/create/konversi', [SertifikatMbkmController::class, 'storekonversi'])->name('mbkm.sertif.storekonversi');
            Route::get('/sertifikat/create/{id}/delete', [SertifikatMbkmController::class, 'destroykonversi'])->name('mbkm.sertif.destroykonversi');

            Route::post("logbook/{id}", [LogbookController::class, 'store'])->name("mbkm.logbook.store");

            Route::get('/undur-diri/{mbkm:id}', [MbkmController::class, 'undurDiri'])->name('mbkm.undurdiri');
            Route::post('/undur-diri/{mbkm:id}', [MbkmController::class, 'storeUndurDiri'])->name('mbkm.undurdiri.store');

            Route::get('penilaian-mbkm/{id}/delete', [PenilaianMbkmController::class, 'delete'])->name("penilaian.delete");
        });

        Route::group(['middleware' => ['auth:dosen']], function () {
            Route::get('/prodi', [MbkmController::class, 'prodiIndex'])->name('mbkm.prodi');
            Route::get('/berjalan', [MbkmController::class, 'mbkmBerjalan'])->name('mbkm.prodi.berjalan');
            Route::get('/riwayat', [MbkmController::class, 'prodiRiwayat'])->name('mbkm.prodi.riwayat');
            Route::post('/prodi/approve/{mbkm:id}', [ApprovalController::class, 'approveUsulan'])->name('mbkm.prodi.approveusulan');
            Route::get('/prodi/approvekonversi/{mbkm:id}', [ApprovalController::class, 'konversi'])->name('mbkm.prodi.konversi');
            Route::post('/prodi/approvekonversi/{mbkm:id}', [ApprovalController::class, 'approveKonversi'])->name('mbkm.prodi.approvekonversi');
            Route::post('/prodi/approvepengunduran/{mbkm:id}', [ApprovalController::class, 'approvePengunduran'])->name('mbkm.prodi.approvepengunduran');
            Route::put('/prodi/tolakusulan/{mbkm:id}', [ApprovalController::class, 'tolakUsulan'])->name('mbkm.prodi.tolakusulan');
            Route::put('/prodi/tolakkonversi/{mbkm:id}', [ApprovalController::class, 'tolakKonversi'])->name('mbkm.prodi.tolakkonversi');
        });

        Route::group(['middleware' => ['auth:web']], function () {
            // staff
            Route::get('/staff', [MbkmController::class, 'staffIndex'])->name('mbkm.staff');
            Route::get('/staff/riwayat', [MbkmController::class, 'staffRiwayat'])->name('mbkm.staff.riwayat');

            Route::post('/staff/approve/{id}', [ApprovalController::class, 'approveStaff'])->name('mbkm.staff.approve');
            Route::get('/staff-print', [MbkmController::class, 'print'])->name('staff.print');
            Route::get('{mbkm:id}/donwload-konversi-pdf', [MbkmController::class, 'downloadPdf'])->name('mbkm.pdf');
        });
        Route::get("{mbkmId}/logbook", [LogbookController::class, 'index'])->name("mbkm.logbook");
        Route::get('/{mbkm:id}', [MbkmController::class, 'detail'])->name('mbkm.detail');
        Route::delete('/{mbkm:id}', [MbkmController::class, 'destroy'])->name('mbkm.destroy');
    });
    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('/program-mbkm', [ProgramMbkmController::class, 'index'])->name('program-mbkm');
        Route::post('/program-mbkm', [ProgramMbkmController::class, 'store'])->name('program-mbkm.store');
        Route::delete('/program-mbkm/{id}', [ProgramMbkmController::class, 'delete'])->name('program-mbkm.delete');

        Route::get('/matkul', [MataKuliahController::class, 'index'])->name('matkul');
        Route::get('/matkul/create', [MataKuliahController::class, 'create'])->name('matkul.create');
        Route::post('/matkul', [MataKuliahController::class, 'store'])->name('matkul.store');
        Route::get('/matkul/{id}/edit', [MataKuliahController::class, 'edit'])->name('matkul.edit');
        Route::put('/matkul/{id}', [MataKuliahController::class, 'update'])->name('matkul.update');
        Route::delete('/matkul/{id}', [MataKuliahController::class, 'destroy'])->name('matkul.delete');
    });
});
