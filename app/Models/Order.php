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
        'total_payment',
        'cus_name',
        'cus_phone',
        'product_name',
        'client_ip',
        'note',
        'order_date',
    ];
}
