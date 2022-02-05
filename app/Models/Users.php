<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    use HasFactory;
    protected $table = 'users';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'remember_toke',
        'created_at', 'updated_at'
    ];

}
