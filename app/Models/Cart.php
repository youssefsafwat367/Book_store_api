<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(Product::class ,'cart_products' );
    }
    public function cart_products()
    {
        return $this->hasMany(CartProduct::class);
    }
        public $fillable = [
        'quantity',
        'user_id',
        'product_id',
        'price',
        'total' ,
        '',

    ];
}
