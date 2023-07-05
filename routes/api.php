<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/candidates', [CandidateController::class, 'show']);
Route::post('/candidate', [CandidateController::class, 'store']);
Route::get('/candidate/{id}', [CandidateController::class, 'showById']);
Route::put('/candidate/{id}', [CandidateController::class, 'update']);
Route::delete('/candidate/{id}', [CandidateController::class, 'destroy']);


Route::get('/skills', [SkillController::class, 'show']);
Route::post('/skill', [SkillController::class, 'store']);
Route::get('/skill/{id}', [SkillController::class, 'showById']);
Route::put('/skill/{id}', [SkillController::class, 'update']);
Route::delete('/skill/{id}', [SkillController::class, 'destroy']);

Route::get('/jobs', [JobController::class, 'show']);
Route::post('/job', [JobController::class, 'store']);
Route::get('/job/{id}', [JobController::class, 'showById']);
Route::put('/job/{id}', [JobController::class, 'update']);
Route::delete('/job/{id}', [JobController::class, 'destroy']);
