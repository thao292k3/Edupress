<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\InstructorEarning;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorStatsController extends Controller
{
    public function instructorEarnings() {
        $instructorId = Auth::id();
        $earnings = InstructorEarning::where('instructor_id', $instructorId)
                    ->with(['course', 'order'])
                    ->latest()
                    ->get();

        $totalEarned = $earnings->sum('instructor_amount');
        $pendingAmount = $earnings->where('status', 'pending')->sum('instructor_amount');

        return view('backend.instructor.earnings.index', compact('earnings', 'totalEarned', 'pendingAmount'));
    }

    public function requestWithdraw(Request $request) {
        $instructor = Auth::user();
        
        $totalEarned = InstructorEarning::where('instructor_id', $instructor->id)
                                        ->where('payment_status', 'paid')
                                        ->sum('instructor_amount');
                                        
        $withdrawn = Withdrawal::where('instructor_id', $instructor->id)
                                ->where('status', 'completed')
                                ->sum('amount');
                                
        $availableBalance = $totalEarned - $withdrawn;

        if ($request->amount > $availableBalance) {
            return back()->with('error', 'Số dư không đủ!');
        }

        Withdrawal::create([
            'instructor_id' => $instructor->id,
            'amount' => $request->amount,
            'bank_info' => $instructor->bank_name . ' - ' . $instructor->bank_account_number,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Yêu cầu rút tiền đã được gửi tới Admin.');
    }
}
