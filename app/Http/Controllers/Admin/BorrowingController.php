<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\BorrowingHistory;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    // display list
     
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'unit'])->paginate(10);
        return view('admin.borrowings.index', compact('borrowings'));
    }

    // form creating new 
     
    public function create()
    {

    }

    // Store a newly created resource in storage.
     
    public function store(Request $request)
    {
        
    }

    // display specified
    public function show(Borrowing $borrowing)
    {
        return view('admin.borrowings.show', compact('borrowing'));
    }

    //  form  editing
     
    public function edit(string $id)
    {

    }

    // update resource in storage
     
    public function update(Request $request, string $id) 
    {
    }

    // remove resource from storage
     
    public function destroy(string $id)
    {
        //
    }

    public function returnUnit(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'actual_return_date' => 'required|date|after_or_equal:' . $borrowing->borrow_date,
        ]);

        $borrowing->update([
            'actual_return_date' => $request->actual_return_date,
            'status' => 'returned',
        ]);

        $borrowing->unit->update(['status' => 'available']);

        // calculate fine
        $expected = Carbon::parse($borrowing->expected_return_date);
        $actual = Carbon::parse($request->actual_return_date);
        $fine = 0;
        if ($actual->gt($expected)) {
            $daysOverdue = $expected->diffInDays($actual);
            $fine = $daysOverdue * 10000; //  10k per day
        }
        $borrowing->update(['fine_amount' => $fine]);

        BorrowingHistory::create([
            'borrowing_id' => $borrowing->id,
            'action' => 'return',
            'date' => now(),
            'notes' => 'Returned by admin',
        ]);

        return redirect()->route('admin.borrowings.index')->with('success', 'Unit returned successfully.');
    }
}
