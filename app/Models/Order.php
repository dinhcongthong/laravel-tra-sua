<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'order_status_id',
        'payment_method_id',
        'total_payment',
        'customer_name',
        'customer_phone',
        'client_ip',
        'note',
        'order_date',
    ];

    public function getOrderItems () {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }
}
