<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOEM extends Model
{
    use HasFactory;

    protected $table ="product_oem";

    protected $fillable = [
        'catagory_name'
    ];

    public function oem()
{
    return $this->hasMany(OEM::class, 'product_oem_id');
}

}
