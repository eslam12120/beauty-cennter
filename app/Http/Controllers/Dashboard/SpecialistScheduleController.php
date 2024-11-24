<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\service;
use App\Models\TimeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecialistScheduleController extends Controller
{
    public function create($id)
    {
        $times = TimeService::where('service_id', $id)->get();
        $result = $times->map(function ($time) use ($id) {
            $start = Carbon::parse($time->start_time);
            $end = Carbon::parse($time->end_time);
            $service_session_time = service::where('id', $id)->first()->session_time ?? null;
            if ($end->lt($start)) {
                $end->addDay();
            }

            $timeSlots = [];
            while ($start->lt($end)) {
                $timeSlots[] = $start->format('H:i:s');
                $start->addMinutes($service_session_time);
            }

            return [
                'id' => $time->id,
                'time_slots' => $timeSlots,
            ];
        });

        return view('time_slots', ['result' => $result]);
    }
}
