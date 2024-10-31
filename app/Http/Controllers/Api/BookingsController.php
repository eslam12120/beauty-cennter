<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function getUpcomingBookings(){
        $bookings = Booking::where('status','pending')->get();
        return response()->json($bookings);
    }
}
