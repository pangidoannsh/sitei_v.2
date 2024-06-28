<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProgressReport\DosenController;
use App\Http\Controllers\ProgressReport\ProgressController;
use App\Http\Controllers\ProgressReport\ProposalController;
use App\Http\Controllers\ProgressReport\SkripsiController;

Route::prefix('progress')->middleware(['auth:web,dosen,mahasiswa'])->group(function () {
    Route::get('/riwayat', [ProgressController::class, 'riwayat'])->name('progress.riwayat'); //halaman riwayat
    Route::get('/proposal/tambah', [ProposalController::class, 'create'])->name('proposal.create'); //halaman pembuatan logbook baru
    Route::get('/skripsi/tambah', [SkripsiController::class, 'create'])->name('skripsi.create'); //halaman pembuatan logbook baru
    Route::get('/proposal/{id}', [ProgressController::class, 'show'])->name('progress.show'); //menampilkan detail logbook proposal
    Route::get('/skripsi/{id}', [ProgressController::class, 'showskripsi']); //menampilkan detail logbook skripsi
    Route::get('/logbookProposal/{id}', [ProgressController::class, 'logbookProposal']); //untuk cetak pdf logbook proposal
    Route::get('/logbookSkripsi/{id}', [ProgressController::class, 'logbookSkripsi']); //untuk cetak pdf logbook skripsi
    Route::get('/detailProposal/{id}', [ProgressController::class, 'detailProposal']);
    Route::get('/detailSkripsi/{id}', [ProgressController::class, 'detailSkripsi']);
    Route::post('/skripsi', [SkripsiController::class, 'store']); //untuk tambah data logbook skripsi
    Route::post('/proposal', [ProposalController::class, 'store']); //untuk tambah data logbook proposal
    Route::put('/proposalupdate', [ProposalController::class, 'update']); //untuk tambah data logbook proposal (lebih dari 1)
    Route::put('/skripsiupdate', [SkripsiController::class, 'skripsiupdate']); //untuk tambah data logbook skripsi (lebih dari 1)
});

// Dosen Route
Route::prefix('dosen')->middleware(['auth:dosen'])->group(function () {
    Route::get('/statistik/{id}', [DosenController::class, 'statistik'])->name('dosen.statistik'); //statistik logbook mahasiswa
    Route::get('/{id}', [DosenController::class, 'show'])->name('dosen.show'); //show detail logbook mahasiswa dari dosen
    Route::put('/addingproposal/{id}', [DosenController::class, 'addproposal'])->name('proposal.add'); //store data persetujuan logbook proposal
    Route::put('/addingskripsi/{id}', [DosenController::class, 'addskripsi']); //store data persetujuan logbook skripsi
    Route::put('/tolakproposal/{id}', [DosenController::class, 'tolak']); //tolak persetujuan logbook proposal
    Route::put('/tolakskripsi/{id}', [DosenController::class, 'tolakskripsi']); //tolak persetujuan logbook skripsi
    Route::post('/tambahketerangan', [DosenController::class, 'addinformation']); //modal persetujuan proposal
    Route::post('/tambahketeranganskripsi', [DosenController::class, 'addinformationskripsi']); //modal persetujuan skripsi
});
