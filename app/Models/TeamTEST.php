<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTEST extends Model
{
    use HasFactory;

    protected $table = 'team_tests';

    protected $fillable = [
        'manging_director_name',           // ← keep typo if DB has it
        'manging_director_designation',
        'manging_director_image',

        'works_director_name',
        'works_director_designation',
        'works_director_image',

        'technical_director_name',
        'technical_director_designation',
        'technical_director_image',

        'director_name',
        'director_designation',
        'director_image',

        'gm_operations_one_name',
        'gm_operations_one_designation',
        'gm_operations_one_image',

        'gm_operations_two_name',
        'gm_operations_two_designation',
        'gm_operations_two_image',

        'works_director_and_technical_director_name',
        'works_director_and_technical_director_designation',
        'works_director_and_technical_director_image',
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}