<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'departments',
    ];
    
    protected $table = 'faculty_departments';  

public function faculties()
{
    return $this->hasMany(Faculty::class, 'department_id');
}
}
