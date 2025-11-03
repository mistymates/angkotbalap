<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'unit_category');
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
