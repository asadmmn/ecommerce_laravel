<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // 'total_amount',
        'status',
     
         'product_id',
         'product_name',
         'quantity',
     'price',
    'b_name',
    'shipping',

    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(Order::class);
    }
}
