<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionCategory extends Model
{
    use HasFactory;

    protected $table = 'option_categories';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function getOptions() {
        return $this->hasMany('App\Models\Option', 'option_category_id', 'id');
    }
}
