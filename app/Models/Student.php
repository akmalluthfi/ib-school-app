<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'grade_id'
    ];

    public $timestamps = false;

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function subjects()
    {
        return $this->embedsMany(Subject::class);
    }
}
