<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapabilitiesMenu extends Model
{
    use HasFactory;

    protected $table='capabilities_menu';

    protected $fillable=[
        'id',
        'menu_name',
        'sort_id'
    ];
public $timestamps = false;
    public function pages()
    {
        return $this->hasMany(
            CapabilitiesSubmenuPages::class,
            'menu_id'
        );
    }

}
 