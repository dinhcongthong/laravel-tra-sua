<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $fillable = [
        'name',
        'url'
    ];

    public function getUrlAttribute($value) {
        if (is_null($this->name)) {
            return $value;
        }
        return url('/') . $this->name;
    }
}
