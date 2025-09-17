<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFood extends Model
{
    use HasFactory;


    protected $table ="product_food";

    protected $fillable = [
        'catagory_name'
    ];

    public function food()
{
    return $this->hasMany(Food::class, 'product_food_id');
}


}
