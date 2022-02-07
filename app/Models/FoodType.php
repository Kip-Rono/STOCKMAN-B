<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    use HasFactory;
    protected $table = 'food_type';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'code', 'type', 'abbrev', 'unit_price'
    ];
}
