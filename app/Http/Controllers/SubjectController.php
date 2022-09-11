<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\SubjectResource;
use App\Rules\UniqueRelation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        return response()->json([
            'status' => 'OK',
            'data' => SubjectResource::collection($student->subjects),
            'error' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Student $student, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                new UniqueRelation($student->subjects())
            ],
            'exercises' => 'required|array|size:4',
            'exercises.*' => 'required|integer|min:0|max:100',
            'daily_test' => 'required|array|size:2',
            'daily_test.*' => 'required|integer|min:0|max:100',
            'midterm_test' => 'required|integer|min:0|max:100',
            'semester_test' => 'required|integer|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Validation Error',
                'data' => null,
                'error' => $validator->errors()
            ], 422);
        }

        $subject = $student->subjects()->create($validator->validated());

        return response()->json([
            'status' => 'Created',
            'data' => $subject,
            'error' => null
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student, $subject_id)
    {
        return response()->json([
            'status' => 'OK',
            'data' => new SubjectResource($student->subjects()->find($subject_id)),
            'error' => null
        ]);
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
