<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualReportTitle extends Model
{
    use HasFactory;

    protected $table = 'annual-report-title';
    protected $fillable = ['title'];
}
