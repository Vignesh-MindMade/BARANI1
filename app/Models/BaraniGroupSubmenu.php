<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaraniGroupSubmenu extends Model
{
    use HasFactory;
    protected $table='baranigroup_submenu';
    protected $fillable=[
        'submenu_name',
        'sort_id'
    ];
    public function pages()
{
    return $this->hasMany(BaraniGroupSubmenuPage::class, 'submenu_id');
}



}
