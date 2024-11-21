<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //
    public function index()
    {
        // Fetch all Booking records or filter as needed
        $bookings = Booking::paginate(10); // Or use pagination like paginate(10) for large datasets

        // Return the view with the bookings data
        return view('dashboard.booking.index', compact('bookings'));
    }
}
