<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = 'cart_products';
    public $fillable =
    [
        'product_id',
        'cart_id',
        'quantity',
        'price' ,

    ];
    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
