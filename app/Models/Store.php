<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $table = 'store';

    protected $fillable = [
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

    public function getProducts () {
        return $this->hasMany('App\Models\Product', 'store_id', 'id');
    }
}
