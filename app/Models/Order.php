<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id'
        ,'user_id'
        ,'customer_id',
        'code',
        'total',
        'date',
        'created_at',
        'update_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function order_details()
    {
        return $this->hasmany(OrderDetail::class);
    }
    
}
