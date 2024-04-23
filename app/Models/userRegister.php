<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRegister extends Model
{
    protected $table = 'user_register';
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'gender',
        'address',
        'created_by',
        'updated_by'
    ];
}
