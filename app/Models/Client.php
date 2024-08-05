<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $timestamps = false;
    protected $table = 'user_register';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
        'gender',
        'address',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
