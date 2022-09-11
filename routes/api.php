<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
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
    $grade = Grade::all()->first();

    foreach ($grade->students as $student) {
        var_dump($student->name);
    }

    dd($grade->students);
});

// // show all subject from student id
// Route::get('/students/{student}/subjects', [SubjectController::class, 'index']);
// // show detail subject from student id
// Route::get('/students/{student}/subjects/{subject}', [SubjectController::class, 'show']);

Route::apiResource('/grades', GradeController::class);
Route::apiResource('/students', StudentController::class);

Route::apiResource('/students/{student}/subjects', SubjectController::class);

// Route::fallback(function () {
//     return response()->json([
//         'message' => 'Not Found.',
//     ], 404);
// });
