<?php

namespace App\Http\Controllers;

use App\Http\Resources\GradeResource;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Grade::all()->map(function ($grade) {
            $grade['url'] = url()->current() . "/$grade->id";
            return $grade;
        }), 200);
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
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        $students = $grade->students()->get(['name'])->map(function ($student) {
            return [
                '_id' => $student->id,
                'name' => $student->name,
                'url' => url("api/students/$student->id"),
            ];
        });

        $grade['students'] = $students;

        return response()->json($grade, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
