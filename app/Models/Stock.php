<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stock';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'product_id', 'quantity', 'amount_paid', 'date_entered', 'id'
    ];
}
