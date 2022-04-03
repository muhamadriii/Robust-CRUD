<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'qty',
        'price',
        'subtotal',
        'created_at',
        'update_at',
    ];

    public function order(){
        return $this->belongsto(Order::class);
    }public function product(){
        return $this->belongsto(Product::class);
    }
}
