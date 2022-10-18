<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject_has_student extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'student_id'
    ];
}
