<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeName extends Model
{
    use HasFactory;

    protected $table = 'committee_name';
    protected $fillable = ['committee_name','pdf'];

    public function members()
    {
        return $this->hasMany(CommitteeMember::class, 'committee_id', 'id');
    }
}