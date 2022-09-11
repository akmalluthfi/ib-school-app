<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $student = $this->student;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subject_url' => url("api/students/$student->id/subjects/$this->id"),
            'exercises' => $this->exercises,
            'daily_test' => $this->daily_test,
            'midterm_test' => $this->midterm_test,
            'semester_test' => $this->semester_test,
        ];
    }
}
