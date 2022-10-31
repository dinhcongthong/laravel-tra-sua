<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'qty',
        'price',
        'product_name',
        'product_img_url',
        'note'
    ];

    public function getOrder () {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
}
