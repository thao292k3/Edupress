<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PayController extends Controller
{
     public function index() {
        $payrolls = Payment::with('order')->latest()->get();
        return view('backend.admin.pay.index', compact('payrolls'));
    }
}
