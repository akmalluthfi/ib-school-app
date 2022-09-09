<?php

namespace App\Http\Controllers;

use App\Models\Student;

class SubjectController extends Controller
{
    public function index(Student $student)
    {
        $grade = $student->grade;
        $subjects = $student->subjects->map(function ($subject) use ($student) {
            return [
                'subject_url' => url("api/students/$student->id/subjects/$subject->id"),
                'name' => $subject->name,
                'exercises' => $subject->exercises,
                'daily_test' => $subject->daily_test,
                'midterm_test' => $subject->midterm_test,
                'semester_test' => $subject->semester_test
            ];
        });

        return response()->json([
            'name' => $student->name,
            'student_url' => url("api/students/$student->id"),
            'grade' => $grade->name,
            'grade_url' => url("api/grades/$grade->id"),
            'subjects' => $subjects
        ], 200);
    }

    public function show(Student $student, $subject_id)
    {
        $subject = $student->subjects()->find($subject_id);
        return response()->json($subject, 200);
    }
}
