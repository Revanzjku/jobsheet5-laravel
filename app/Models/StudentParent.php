<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    use HasFactory;

    protected $fillable = ['parent_name', 'contact'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
