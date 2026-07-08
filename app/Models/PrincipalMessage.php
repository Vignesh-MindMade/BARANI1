<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalMessage extends Model
{
    use HasFactory;
    protected $table = 'principal_message';
    protected $fillable = ['name', 'description', 'file','number','mail','quotes','author','team_iap_title','team_iap_name','team_iap_description','team_iap_file'];

}

