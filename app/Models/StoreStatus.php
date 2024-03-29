<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreStatus extends Model
{
    use HasFactory;

    protected $table = 'store_status';

    protected $fillable = ['id', 'name', 'color_class'];
}
