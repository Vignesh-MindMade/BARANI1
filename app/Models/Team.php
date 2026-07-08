<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    protected $fillable = ['name','designation','image','role','parent_id'];

     public function children()
    {
        return $this->hasMany(Team::class, 'parent_id')->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(Team::class, 'parent_id');
    }
    
    public function teamTest()
{
    return $this->belongsTo(TeamTest::class);
}

}
