<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

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

Route::get('/patients/edit/{id}', [PatientController::class, 'edit']);
Route::put('/patients/{id}', [PatientController::class, 'update']);
