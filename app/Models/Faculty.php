<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
    ];
    
    protected $table = 'facultystaff';


    public function department()
    {
        return $this->belongsTo(FacultyDepartment::class, 'department_id');
    }
}