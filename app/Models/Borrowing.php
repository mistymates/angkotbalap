<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id',
        'unit_id',
        'borrow_date',
        'expected_return_date',
        'actual_return_date',
        'status',
        'fine_amount',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'expected_return_date' => 'date',
        'actual_return_date' => 'date',
        'fine_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function histories()
    {
        return $this->hasMany(BorrowingHistory::class);
    }
}
