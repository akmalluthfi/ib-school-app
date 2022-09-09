<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Models\Grade;
use App\Models\Student;
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

Route::get('/test', function () {
    die();
});

Route::apiResource('/grades', GradeController::class);
Route::apiResource('/students', StudentController::class);
// Route::apiResource('/students/${student_id}/subjects', ::class);

Route::fallback(function () {
    return response()->json([
        'message' => 'content not found',
    ], 404);
});
