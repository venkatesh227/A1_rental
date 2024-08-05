<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    protected $table = 'order_details';
    protected $fillable = ['order_id', 'product_id', 'qty', 'subtotal', 'single_price', 'created_by'];

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function Orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}

