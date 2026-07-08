<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewCertficate extends Model
{
    use HasFactory;

    protected $table = 'view_certficate';
    protected $fillable = ['view_certficate_title', 'image'];

    
    public function title()
    {
        return $this->belongsTo(ViewCertficateTitle::class, 'view_certficate_title');
    }
}
