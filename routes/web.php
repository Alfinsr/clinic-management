<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientRecordController;

// Halaman login dan logout hanya untuk guest (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// Halaman yang memerlukan login untuk mengakses
Route::middleware(['auth'])->group(function () {
    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/patients/add', [PatientController::class, 'create']);
    Route::post('/patients/store', [PatientController::class, 'store']);
    Route::get('/patients/edit/{id}', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::post('/patients/{patient_id}/records', [PatientRecordController::class, 'store'])->name('patientRecords.store');
    Route::get('/patients/{patient_id}/records', [PatientRecordController::class, 'index'])->name('patients.records');
    Route::middleware(['auth'])->post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// routes/web.php
