<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'code', 'size', 'abbrev'
    ];
}
