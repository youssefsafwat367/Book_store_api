<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function carts()
    {
        return $this->belongsToMany(Cart::class , 'cart_products');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public $fillable =
    [
        'name',
'status',
'description',
'author',
'category_id',
'bestseller',
'image',
'stock',
'price',
'discount',
'number_of_pages',
'code',
'price_after_discount',
    ];
}
