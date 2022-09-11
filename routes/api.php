<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\Grade;
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
    $grade = Grade::all()->first();

    foreach ($grade->students as $student) {
        var_dump($student->name);
    }

    dd($grade->students);
});

Route::apiResource('/grades', GradeController::class)->except('destroy');
Route::apiResource('/students', StudentController::class)->except([
    'store', 'update', 'destroy'
]);
Route::apiResource('/students/{student}/subjects', SubjectController::class)->except([
    'update', 'destroy'
]);

Route::fallback(function () {
    return response()->json([
        'message' => 'Not Found.',
    ], 404);
});
