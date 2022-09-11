<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
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
        return new StudentCollection(Student::with('grade')->paginate());
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
        $subject_score = collect();

        foreach ($student->subjects as $subject) {
            // menghitung nilai latihan soal
            $exercises = collect($subject->exercises);
            $total_exercises = 15 / 100 * ($exercises->sum() / $exercises->count());

            // menghitung nilai ulangan harian
            $daily_test = collect($subject->daily_test);
            $total_daily_test = 20 / 100 * ($daily_test->sum() / $daily_test->count());

            // menghitung total nilai
            $score = collect([
                $total_exercises,
                $total_daily_test,
                (25 / 100 * $subject->midterm_test),
                (40 / 100 * $subject->semester_test)
            ]);

            // simpan ke dalam array
            $subject_score->push([
                'name' => $subject->name,
                'score' => (float)number_format($score->sum(), 2),
                'subject_url' => url("api/students/$student->id/subjects/$subject->id")
            ]);
        }

        $data = collect(new StudentResource($student->loadMissing('grade')));
        // tambahkan subject score ke dalam array
        $data->put('subject_score', $subject_score);

        return response()->json([
            'status' => 'OK',
            'data' => $data,
            'error' => null
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
