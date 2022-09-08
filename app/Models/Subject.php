<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Subject extends Model
{
  protected $fillable = [
    'name',
    'exercises',
    'daily_test',
    'midterm_test',
    'semester_test',
  ];

  public $timestamps = false;
}
