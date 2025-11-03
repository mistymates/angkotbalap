<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\BorrowingHistory;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = auth()->user()->borrowings()->with('unit')->paginate(10);
        return view('user.borrowings.index', compact('borrowings'));
    }

    public function returnUnit(Request $request, Borrowing $borrowing)
    {
        // Ensure the borrowing belongs to the authenticated user
        if ($borrowing->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'actual_return_date' => 'required|date|after_or_equal:' . $borrowing->borrow_date,
        ]);

        $borrowing->update([
            'actual_return_date' => $request->actual_return_date,
            'status' => 'returned',
        ]);

        $borrowing->unit->update(['status' => 'available']);

        // Calculate fine
        $expected = Carbon::parse($borrowing->expected_return_date);
        $actual = Carbon::parse($request->actual_return_date);
        $fine = 0;
        if ($actual->gt($expected)) {
            $daysOverdue = $expected->diffInDays($actual);
            $fine = $daysOverdue * 10000; // Assume 10k per day
        }
        $borrowing->update(['fine_amount' => $fine]);

        BorrowingHistory::create([
            'borrowing_id' => $borrowing->id,
            'action' => 'return',
            'date' => now(),
            'notes' => 'Returned by user',
        ]);

        return redirect()->route('user.borrowings.index')->with('success', 'Unit returned successfully.');
    }

    public function create()
    {
        $availableUnits = Unit::where('status', 'available')->get();
        return view('user.borrowings.create', compact('availableUnits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_ids' => 'required|array|min:1|max:2',
            'unit_ids.*' => 'exists:units,id',
            'expected_return_date' => 'required|date|after:today',
        ]);

        // Check if user has active borrowings
        $activeCount = auth()->user()->borrowings()->where('status', 'borrowed')->count();
        if ($activeCount + count($request->unit_ids) > 2) {
            return back()->withErrors(['unit_ids' => 'You can borrow maximum 2 units at a time.']);
        }

        // Check if units are available
        foreach ($request->unit_ids as $unitId) {
            $unit = Unit::find($unitId);
            if ($unit->status !== 'available') {
                return back()->withErrors(['unit_ids' => 'One or more selected units are not available.']);
            }
        }

        // Check return date not more than 5 days
        $borrowDate = Carbon::now();
        $expected = Carbon::parse($request->expected_return_date);
        if ($borrowDate->diffInDays($expected) > 5) {
            return back()->withErrors(['expected_return_date' => 'Maximum borrowing period is 5 days.']);
        }

        foreach ($request->unit_ids as $unitId) {
            $unit = Unit::find($unitId);
            $borrowing = Borrowing::create([
                'user_id' => auth()->id(),
                'unit_id' => $unitId,
                'borrow_date' => $borrowDate,
                'expected_return_date' => $request->expected_return_date,
                'status' => 'borrowed',
            ]);

            $unit->update(['status' => 'borrowed']);

            BorrowingHistory::create([
                'borrowing_id' => $borrowing->id,
                'action' => 'borrow',
                'date' => $borrowDate,
                'notes' => 'Borrowed by user',
            ]);
        }

        return redirect()->route('user.borrowings.index')->with('success', 'Borrowing request submitted successfully.');
    }
}
