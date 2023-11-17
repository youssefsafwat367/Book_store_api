<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    public $fillable = [
        'short_address',
        'full_address',
        'city',
        'phone'
    ] ;
}
