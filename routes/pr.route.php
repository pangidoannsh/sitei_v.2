<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProgressReport\DosenController;
use App\Http\Controllers\ProgressReport\ProgressController;
use App\Http\Controllers\ProgressReport\ProposalController;
use App\Http\Controllers\ProgressReport\SkripsiController;

Route::prefix('progress')->middleware(['auth:web,dosen,mahasiswa'])->group(function () {
    Route::get('/riwayat', [ProgressController::class, 'riwayat'])->name('progress.riwayat');
    Route::get('/proposal/tambah', [ProposalController::class, 'create'])->name('proposal.create');
    Route::get('/skripsi/tambah', [SkripsiController::class, 'create'])->name('skripsi.create');
    Route::get('/proposal/{id}', [ProgressController::class, 'show'])->name('progress.show');
    Route::get('/skripsi/{id}', [ProgressController::class, 'showskripsi']);
    Route::get('/logbookProposal/{id}', [ProgressController::class, 'logbookProposal']);
    Route::get('/logbookSkripsi/{id}', [ProgressController::class, 'logbookSkripsi']);
    Route::get('/detailProposal/{id}', [ProgressController::class, 'detailProposal']);
    Route::get('/detailSkripsi/{id}', [ProgressController::class, 'detailSkripsi']);
    Route::post('/skripsi', [SkripsiController::class, 'store']);
    Route::post('/proposal', [ProposalController::class, 'store']);
    Route::put('/proposalupdate', [ProposalController::class, 'update']);
    Route::put('/skripsiupdate', [SkripsiController::class, 'skripsiupdate']);
    Route::get('/statistik', [ProgressController::class, 'statistik']);
});

// Dosen Route
Route::prefix('dosen')->middleware(['auth:dosen'])->group(function () {
    Route::get('/statistik/{id}', [DosenController::class, 'statistik'])->name('dosen.statistik');
    Route::get('/skripsi/{id}', [DosenController::class, 'showskripsi']);
    Route::get('/{id}', [DosenController::class, 'show'])->name('dosen.show');
    Route::put('/addingproposal/{id}', [DosenController::class, 'addproposal'])->name('proposal.add');
    Route::put('/addingskripsi/{id}', [DosenController::class, 'addskripsi']);
    Route::put('/tolakproposal/{id}', [DosenController::class, 'tolak']);
    Route::put('/tolakskripsi/{id}', [DosenController::class, 'tolakskripsi']);
    Route::post('/tambahketerangan', [DosenController::class, 'addinformation']);
    Route::post('/tambahketeranganskripsi', [DosenController::class, 'addinformationskripsi']);
});
