<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowingHistory;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = BorrowingHistory::with(['borrowing.user', 'borrowing.unit'])->paginate(10);
        return view('admin.histories.index', compact('histories'));
    }
}
