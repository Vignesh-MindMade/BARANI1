<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrusteMessage extends Model
{
    use HasFactory;

    protected $table = 'trustee_message';
    protected $fillable = ['name', 'position','image','mobile','quote','email','message','link','author','bg_image'];
    

}
