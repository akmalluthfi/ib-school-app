<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
{
    /**
     * __construct
     *
     * @param  mixed $resource
     * @param  bool $withRelations
     * @return void
     */
    public function __construct($resource, private $withRelations = false)
    {
        parent::__construct($resource);
    }

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
            'teacher' => $this->teacher,
            'capacity' => $this->students->count(),
            'grade_url' => url("api/grades/$this->id"),
            'students' => StudentResource::collection($this->when($this->withRelations, $this->students)),
        ];
    }
}
