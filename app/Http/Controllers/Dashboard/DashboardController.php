<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
class DashboardController extends Controller
{
    //
    public function index()
    {
        // $orders=Order::latest()->take(5)->get();;
        return view('dashboard.index');
    }
     public function export_pdf()
    {
        $pdf = Pdf::loadView('dashboard.pdf.report');
        return $pdf->download('report.pdf');
    }

}
