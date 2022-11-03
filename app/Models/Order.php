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
        'updated_at'
    ];

    public function getOrderItems () {
        return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');
    }

    public function getPaymentMethod () {
        return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id', 'id');
    }

    public function getStatus () {
        return $this->belongsTo('App\Models\OrderStatus', 'order_status_id', 'id');
    }

    public function getUpdatedAtAttribute ($value) {
        return date('Y-m-d H:i:s', strtotime($value));
    }
}
