<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            $grade['url'] = url("api/grades/$grade->id");
            $grade['capacity'] = $grade->students()->count();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:grades|max:255',
            'teacher' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Grade::create($validator->validated());

        return response()->json([
            'message' => 'Created'
        ], 201);
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
            return new StudentResource($student);
        });

        $grade['students'] = $students;
        $grade['capacity'] = $students->count();

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
        $rules = [
            'name' => ['required', 'max:255'],
            'teacher' => 'required|max:255'
        ];

        if ($request->name !== $grade->name) {
            $rules['name'][] = 'unique:grades';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $grade->update($validator->validated());

        return response()->json($grade);
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
