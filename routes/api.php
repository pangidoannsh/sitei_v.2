<?php

use App\Http\Controllers\API\AbsensiApiController;
use App\Http\Controllers\API\LocationApiController;
use App\Http\Controllers\API\MahasiswaApiController;
use App\Http\Controllers\API\MataKuliahApiController;
use App\Http\Controllers\API\PendaftaranMataKuliahApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/mahasiswa', [MahasiswaApiController::class, 'index']);
Route::post('/mahasiswa/register', [MahasiswaApiController::class, 'register']);
Route::post('/mahasiswa/login', [MahasiswaApiController::class, 'login']);
Route::get('/mahasiswa/searchmahasiswa', [MahasiswaApiController::class, 'searchMahasiswa']);
Route::post('/mahasiswa/apistore', [AbsensiApiController::class, 'apistore']);
Route::get('/mahasiswa/show', [AbsensiApiController::class, 'show']);
Route::get('/mahasiswa/showbyid/{studentId}', [AbsensiApiController::class, 'showByStudentId']);
Route::get('/mahasiswa/showw/{studentId}', [AbsensiApiController::class, 'showBasedId']);
Route::post('/mahasiswa/daftarmatkul', [PendaftaranMataKuliahApiController::class, 'daftarmatkul']);
Route::get('/mahasiswa/mata-kuliah-mahasiswa/{mahasiswaId}', [PendaftaranMataKuliahApiController::class, 'mataKuliahMahasiswa']);
Route::get('/mahasiswa/matakuliah', [MataKuliahApiController::class, 'matakuliah']);
Route::get('/mahasiswa/locations/{ruangan_id}', [LocationApiController::class, 'getLocationByRuanganId']);

Route::get('/mahasiswa/getAttendanceData/{id}', [AbsensiApiController::class, 'getAttendanceData']);
Route::get('/mahasiswa/getQRCode/{id}', [AbsensiApiController::class, 'getQRCode']);


Route::middleware('auth:sanctum')->get('/mahasiswa/attendance', [AbsensiApiController::class, 'showAttendanceByToken']);
Route::middleware('auth:sanctum')->get('/mahasiswa/attendance/{id}', [AbsensiApiController::class, 'showDetail']);
Route::middleware('auth:sanctum')->get('/mahasiswa/attendancematkul', [AbsensiApiController::class, 'showAttendanceMatakuliah']);
Route::middleware('auth:sanctum')->get('/mahasiswa/attendancematkul/{id}', [AbsensiApiController::class, 'showDetailAttendance']);
Route::middleware('auth:sanctum')->get('/mahasiswa/attendancethen', [AbsensiApiController::class, 'showAttendanceThen']);
Route::middleware('auth:sanctum')->get('/mahasiswa/attendancethen/{id}', [AbsensiApiController::class, 'showDetailThen']);

Route::middleware('auth:sanctum')->get('/mahasiswa/count', [AbsensiApiController::class, 'countAttendanceStatus']);
Route::middleware('auth:sanctum')->get('/mahasiswa/user-detail', [MahasiswaApiController::class, 'getUserDetails']);
