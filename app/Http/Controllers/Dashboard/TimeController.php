<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    //
    
    public function index()
    {
       
        $times = Time::all();  
        return view('dashboard.times.index', compact('times'));
    }

    public function updateMultiple(Request $request)
    {
    
        $days = $request->days;

     
        foreach ($days as $dayId => $data) {
            $timeSchedule = Time::find($dayId);

            if ($timeSchedule) {
                $timeSchedule->start_time = $data['start_time'];
                $timeSchedule->end_time = $data['end_time'];
                $timeSchedule->is_opened = $data['is_opened'];
                $timeSchedule->save(); // حفظ التحديثات
            }
        }

        return redirect()->route('time.index')->with('success', 'Time Schedules updated successfully.');
    }
}
