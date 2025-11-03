<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowingHistory extends Model
{
    protected $fillable = [
        'borrowing_id',
        'action',
        'date',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}
