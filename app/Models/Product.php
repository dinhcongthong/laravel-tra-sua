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

    public function getProductOption() {
        return $this->belongsToMany(Option::class, 'product_option', 'product_id', 'option_id')->withPivot('price');
    }

    public function getStore() {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function getStatus () {
        return $this->belongsTo(ProductStatus::class, 'product_status_id', 'id');
    }

    public function getImage() {
        return $this->belongsTo(Gallery::class, 'gallery_id', 'id');
    }
}
