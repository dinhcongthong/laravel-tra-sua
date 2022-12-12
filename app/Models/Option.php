<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'option';

    protected $fillable = ['name', 'option_category_id', 'sort_no'];

    public function getOptionCategory () {
        return $this->belongsTo(OptionCategory::class, 'option_category_id', 'id');
    }

    public function getProductOptions () {
        return $this->hasMany(ProductOption::class, 'option_id', 'id');
    }
}
