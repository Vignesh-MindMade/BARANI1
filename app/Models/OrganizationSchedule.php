<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationSchedule extends Model
{
    use HasFactory;

    protected $table = 'organization_schedule';
    protected $fillable = ['org_member', 'member_designation','member_committee'];


  

}