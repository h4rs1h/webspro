<?php

use App\Http\Controllers\ProsesKirimWaController;
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

Route::controller(ProsesKirimWaController::class)->group(function () {
    Route::get('/kirimsp', 'kirimsp');
    Route::get('/run-script', 'runScript')->name('run.script');
    Route::get('/kirimwajob', 'kirimbyJobs')->name('kirimbyJobs');
    Route::get('/kirimbyJobsRere', 'kirimbyJobsRere')->name('kirimbyJobsRere');
});
