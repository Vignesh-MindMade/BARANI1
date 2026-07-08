<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewCertficateTitle extends Model
{
    use HasFactory;


    protected $table = 'view_certficate_title';
    protected $fillable = ['title','sort_id'];

    public function certificates()
    {
        return $this->hasMany(ViewCertficate::class, 'view_certficate_title');
    }
}
