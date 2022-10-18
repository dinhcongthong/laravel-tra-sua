<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $fillable = [
        'store_id',
        'crawl_id',
        'name',
        'description',
        'gallery_id',
        'price',
        'discount',
        'product_status_id',
    ];

    public function getStore() {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }

    public function getImage() {
        return $this->belongsTo('App\Models\Gallery', 'gallery_id', 'id');
    }
}
