<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'product_id', 'quantity', 'amount_paid', 'unit_price', 'date_entered', 'paid'
    ];
}
