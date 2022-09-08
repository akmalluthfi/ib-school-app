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
    $grades = Grade::all();

    $students = $grades->first()->students()->get();

    // foreach ($students as $student) {
    //     var_dump($student->name);
    // }

    $subjects = ['Math', 'Biology', 'Chemistry', 'Geography', 'Art', 'English'];

    foreach ($subjects as $subject) {
        var_dump($subject);
    }

    die();

    // return response()->json([
    //     'name' => 'test'
    // ]);
});

Route::apiResource('/grade', GradeController::class);
Route::apiResource('/student', StudentController::class);

Route::fallback(function () {
    return response()->json([
        'message' => 'content not found',
    ], 404);
});
