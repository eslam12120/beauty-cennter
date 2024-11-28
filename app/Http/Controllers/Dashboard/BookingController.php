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
    public function update($id, $i)
    {
        // Fetch all Booking records or filter as needed
        if ($i == 1) {
            Booking::where('id', $id)->update(['status' => 'completed']);
        } else {
            $bookings = Booking::where('id', $id)->update(['status' => 'cancelled']); // Or use pagination like paginate(10) for large datasets
        }
        // Return the view with the bookings data
        return redirect()->back()->with('success', 'Booking Updated successfully');
    }
}
