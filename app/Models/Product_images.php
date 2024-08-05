<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Product_images extends Model
{
    public $timestamps = false;
    protected $table = 'Product_images';
    protected $fillable = [
        'id',
        'product_id',
        'image',
        'created_by',
        'updated_by'
    ];
}
