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
        return [
            '_id' => $this->id,
            'name' => $this->name,
            'url' => url("api/students/$this->id"),
            // 'grade' => new GradeResource($this->grade)
            'grade' => new GradeResource($this->whenLoaded('grade'))
        ];
    }

    public function with($request)
    {
        return [
            'tasts' => 'sd'
        ];
    }
}
