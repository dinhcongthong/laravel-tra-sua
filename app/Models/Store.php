<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';

    protected $filable = [
        'name',
        'address',
        'note',
        'store_status_id',
        'gallery_id'
    ];

    public function getImage() {
        return $this->belongsTo('App\Models\Gallery', 'gallery_id', 'id');
    }

    public function getStatus () {
        return $this->belongsTo('App\Models\StoreStatus', 'store_status_id', 'id');
    }
}
