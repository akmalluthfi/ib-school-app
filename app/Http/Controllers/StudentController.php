<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StudentResource::collection(Student::all()->take(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // hitung nilai permapel
        // hasil 
        /*
            subjects: [
                {name: 'math', nilai: 88}, 
                {name: 'art', nilai: 90}
            ]

            subjects: {
                math: 12, 
                art: 23
            } 
        */

        $result_score = collect();

        foreach ($student->subjects as $subject) {
            $exercises = collect($subject->exercises);
            $total_exercises = 15 / 100 * ($exercises->sum() / $exercises->count());

            $daily_test = collect($subject->daily_test);
            $total_daily_test = 20 / 100 * ($daily_test->sum() / $daily_test->count());

            $score = collect([
                $total_exercises,
                $total_daily_test,
                (25 / 100 * $subject->midterm_test),
                (40 / 100 * $subject->semester_test)
            ]);

            $result_score->push([
                'name' => $subject->name,
                'score' => (float)number_format($score->sum(), 2),
                'subject_url' => url("api/students/$student->id/subjects/$subject->id")
            ]);
        }

        $grade = $student->grade;

        return response()->json([
            'name' => $student->name,
            'grade' => $grade->name,
            'grade_url' => url("api/grades/$grade->id"),
            'subjects' => $result_score
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
