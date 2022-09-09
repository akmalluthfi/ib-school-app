<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $student =  [
            '_id' => $this->id,
            'name' => $this->name,
            'url' => url("api/students/$this->id"),
        ];

        if (isset($this->grade)) {
            $student['grade'] = $this->grade->name;
            $student['grade_url'] = url("api/grades/$this->grade->id");
        }

        return $student;
    }
}
