<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
       $users=User::get();
        return view('dashboard.index',compact('users'));
    }
    //  public function export_pdf()
    // {
    //     $pdf = Pdf::loadView('dashboard.pdf.report');
    //     return $pdf->download('report.pdf');
    // }

}
