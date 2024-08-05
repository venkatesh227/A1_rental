<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'subcategory_id',
        'name',
        'slug',
        'title',
        'small_description',
        'description',
        'additional_info',
        'shipping_delivery',
        'price',
        'qty',
        'status',
        'image',
        'created_by',
        'updated_by'
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }



   

}
