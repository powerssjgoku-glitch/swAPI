<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\EntregaEstudianteController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\DocumentTagController;
use App\Http\Controllers\DocumentVersionController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return response()->json([
        'status' => 'API funcionando correctamente'
    ]);
});

Route::apiResource('users', UserController::class);
Route::apiResource('asignaturas', AsignaturaController::class);
Route::apiResource('avances', AvanceController::class);
Route::apiResource('entregas-estudiantes', EntregaEstudianteController::class);
Route::apiResource('feedbacks', FeedbackController::class);
Route::apiResource('deliverables', DeliverableController::class);
Route::apiResource('document-tags', DocumentTagController::class);
Route::apiResource('document-versions', DocumentVersionController::class);
Route::apiResource('password-resets', PasswordResetController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('roles', RoleController::class);
