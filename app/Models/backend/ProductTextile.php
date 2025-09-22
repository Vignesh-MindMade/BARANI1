<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTextile extends Model
{
    use HasFactory;

    protected $table ="product_textiles";

    protected $fillable = [
        'catagory_name'
    ];

    public function textiles()
{
    return $this->hasMany(Textile::class, 'product_textile_id');
}

}
