<?php

namespace App\Http\Controllers\Backend;

use App\Exports\RevenueExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RevenueController extends Controller
    {
        public function index() {
            
            $totalRevenue = Payment::where('status', 'completed')->sum('total_amount');

            $orders = Payment::latest()->paginate(10);

            return view('backend.admin.revenue.index', compact('totalRevenue', 'orders'));
        }

        public function exportExcel() {

            return Excel::download(new RevenueExport, 'doanh-thu-' . date('d-m-Y') . '.xlsx');
        }


}
