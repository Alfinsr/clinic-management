<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientRecordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/patients', [PatientController::class, 'index']);

Route::get('/patients/add', [PatientController::class, 'create']);
Route::post('/patients/store', [PatientController::class, 'store']);


Route::get('/patients/edit/{id}', [PatientController::class, 'edit'])->name('patients.edit');
Route::put('/patients/{id}', [PatientController::class, 'update']);
Route::post('/patients/{patient_id}/records', [PatientRecordController::class, 'store'])->name('patientRecords.store');
Route::get('/patients/{patient_id}/records', [PatientRecordController::class, 'index'])->name('patients.records');
