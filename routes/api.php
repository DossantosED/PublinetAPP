<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DisplayController;
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

// Métodos de Company
Route::post('companies', [CompanyController::class,'store']);
Route::put('companies/{company_id}', [CompanyController::class,'update']);
Route::get('companies', [CompanyController::class,'index']);
Route::get('companies/{company_id}', [CompanyController::class,'show']);
Route::delete('companies/{company_id}', [CompanyController::class,'destroy']);
Route::get('companies/{company_id}/displays', [CompanyController::class,'getDisplays']);

// Métodos de Display
Route::post('displays', [DisplayController::class,'store']);
Route::put('displays/{display_id}', [DisplayController::class,'update']);
Route::get('displays', [DisplayController::class,'index']);
Route::get('displays/{display_id}', [DisplayController::class,'show']);
Route::delete('displays/{displays_id}', [DisplayController::class,'destroy']);

Route::post('updateimage/{displays_id}', [DisplayController::class,'updateImage']);

