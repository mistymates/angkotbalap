<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_category');
    }
}
