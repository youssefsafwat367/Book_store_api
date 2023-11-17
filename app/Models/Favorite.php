<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    public $fillable = [
        'product_id' ,
        'user_id'
    ] ;
     function user(){
        return $this->belongsTo(User::class);
    }
     function product(){
        return $this->belongsTo(Product::class);
    }
    function getCreatedAtAttribute($value)
    {
        return date( ' التاريخ : d/m/y التوقيت : h:m:s ' , strtotime($value)) ;
    }
}
