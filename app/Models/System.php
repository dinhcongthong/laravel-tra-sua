<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $table = 'system';

    protected $fillable = [
        'system_name',
        'time_start_open',
        'time_end_open',
        'status'
    ];
}
