<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Product_images extends Model
{
    protected $table = 'Product_images';
    protected $fillable = [
        'product_id',
        'image',
        'created_by',
        'updated_by'
    ];


}
