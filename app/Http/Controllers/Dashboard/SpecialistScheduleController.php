<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\service;
use App\Models\TimeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialist;
use App\Models\Time;
use App\Models\TimeSpecialist;
use Illuminate\Support\Facades\DB;

class SpecialistScheduleController extends Controller
{
    public function index()
    {
        // Fetch all records from TimeService model
       $timeServices = TimeSpecialist::all();

        // Return view with all records
        return view('dashboard.specialist_time.index', compact('timeServices'));
    } 

    public function create()
    {
        $services = service::all(); // جميع الخدمات
        $specialists = Specialist::all();
        return view('dashboard.specialist_time.create', compact('services','specialists'));
    }



    public function getAvailableDays(Request $request)
    {
        $id = $request->input('service_id');

        // استرجاع الأوقات والأيام
        $times = TimeService::where('service_id', $id)
        ->join('times', 'time_services.time_id', '=', 'times.id') // الربط مع جدول times
        ->select('time_services.time_id', 'times.name') // جلب الـday_name
        ->get();

        return response()->json(['result' => $times]);
    }

    public function getAvailableTimes(Request $request)
    {
        $serviceId = $request->input('service_id');
        $day = $request->input('day'); // إذا كان اليوم مدخلًا

        // جلب وقت البداية والنهاية بناءً على الخدمة واليوم
        $times = TimeService::where('service_id', $serviceId)
            ->where('time_id', $day) // التحقق من أن اليوم مرتبط بالخدمة
            ->get();

        $result = $times->map(function ($time) use ($serviceId) {
            $start = Carbon::parse($time->start_time);
            $end = Carbon::parse($time->end_time);

            $serviceSessionTime = Service::where('id', $serviceId)->first()->session_time ?? null;

            // التأكد أن وقت النهاية بعد وقت البداية
            if ($end->lt($start)) {
                $end->addDay();
            }

            // تقسيم الأوقات بناءً على وقت الجلسة
            $timeSlots = [];
            while ($start->lte($end)) {
                $timeSlots[] = $start->format('H:i:s');
                $start->addMinutes($serviceSessionTime);
            }

            return [
                'id' => $time->id,
                'time_slots' => $timeSlots,
            ];
        });

        return response()->json(['result' => $result]);
    }
    // public function getSpecialistsByService(Request $request)
    // {
    //     $serviceId = $request->service_id;

    //     // استرجاع المتخصصين بناءً على الخدمة
    //     $specialists = Specialist::where('service_id', $serviceId)->get();

    //     return response()->json(['specialists' => $specialists]);
    // }
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'specialist' => 'required|exists:specialists,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $exists = DB::table('service_specialities')
        ->where('specialist_id', $request->specialist)
        ->where('service_id', $request->service_id)
        ->exists();

        if (!$exists) {
            return redirect()->route('schedule.create')->
            with(['error' => 'this specialist didnot work in this service']);
        }

        // تخزين البيانات في جدول time_specialists
        $timeSpecialist = new TimeSpecialist();
        $timeSpecialist->service_id = $request->service_id;
        $timeSpecialist->specialist_id = $request->specialist;
        $timeSpecialist->time_id = $request->day;
        $timeSpecialist->start_time = $request->start_time;
        $timeSpecialist->end_time = $request->end_time;
        $timeSpecialist->save();

        return redirect()->route('schedule.index')->with('success', 'Specialist time has been successfully saved.');
    }
    public function destroy($id)
    {
        // Find the record by ID and delete it
        $timeSpecialist = TimeSpecialist::find($id);

        if ($timeSpecialist) {
            $timeSpecialist->delete();
            return redirect()->route('schedule.index')->with('success', 'Time service deleted successfully.');
        }

        return redirect()->route('schedule.index')->with('error', 'Time service not found.');
    }
    public function edit($id)
    {
        $schedule = TimeSpecialist::findOrFail($id); // Fetch the schedule by its ID
        $services = Service::all(); // Get all services
        $specialists = Specialist::all(); // Get all specialists
        $days = TimeService::where('service_id', $schedule->service_id)->get(); // Fetch days based on the selected service

        return view('dashboard.specialist_time.edit', compact('schedule', 'services', 'specialists', 'days'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'specialist' => 'required|exists:specialists,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule = TimeSpecialist::findOrFail($id); // Find the schedule by ID
        $schedule->service_id = $request->service_id;
        $schedule->specialist_id = $request->specialist;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->save(); // Update the schedule in the database

        return redirect()->route('schedule.index')->with('success', 'Schedule updated successfully!');
    }


}
