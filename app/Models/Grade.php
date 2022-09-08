<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'name', 'capacity'
    ];

    public $timestamps = false;

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
