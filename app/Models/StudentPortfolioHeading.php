<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPortfolioHeading extends Model
{
    use HasFactory;

    protected $table = 'student_portfolio_heading';
    protected $fillable = ['heading'];

}
