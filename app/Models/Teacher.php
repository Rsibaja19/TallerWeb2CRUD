<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'dni',
        'address',
        'phone',
        'email',
        'salary'
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
