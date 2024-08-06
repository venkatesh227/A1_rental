<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class ProductImages extends Model
{
    public $timestamps = false;
    protected $table = 'product_images';
    protected $fillable = [
        'id',
        'product_id',
        'image',
        'created_by',
        'updated_by'
    ];
}
