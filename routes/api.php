<?php

use App\Http\Controllers\API\ResourceController;
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

Route::get('/resources', [ResourceController::class, 'handleGetResources']);

Route::post('/resource/html/save', [ResourceController::class, 'handleSaveHtml']);
Route::post('/resource/pdf/save', [ResourceController::class, 'handleSavePdf']);
Route::post('/resource/link/save', [ResourceController::class, 'handleSaveLink']);

Route::put('/resource/html/{id}/update', [ResourceController::class, 'handleUpdateHtml']);
Route::post('/resource/pdf/{id}/update', [ResourceController::class, 'handleUpdatePdf']);
Route::put('/resource/link/{id}/update', [ResourceController::class, 'handleUpdateLink']);

Route::delete('/resource/{id}/delete', [ResourceController::class, 'handleDeleteResource']);
