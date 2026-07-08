<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignChair extends Model
{
    use HasFactory;

    protected $table = 'design_chair';
    protected $fillable = ['chair_name', 'contact_info','chair_email','chair_content','chair_quote_author','chair_quote','chair_image'];


  

}