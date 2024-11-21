<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\service;
use App\Models\Time;
use App\Models\TimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
     public function index()
    {
        $services = service::with('category')->get();
        return view('dashboard.services.index', compact('services'));
    }

    // Show the form for creating a new service
    public function create()
    {
        $categories = Category::all(); // Assuming a Category model exists
        $times=Time::where('is_opened',1)->where('start_time','!=',null)->get();
        return view('dashboard.services.create', compact('categories','times'));
    }

    // Store a newly created service in the database
    public function store(Request $request)
    {
       
        $request->validate([
            'service_name_en' => 'required|string|max:255',
            'service_name_ar' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'session_time' => 'required|integer',// End time must be after start time
        ]);

       
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = "category-" . uniqid() . ".$ext";
            $image->move(public_path('services_images'), $imageName);
      
        }

        $services=service::create(
            [
                'service_name_en' => $request->input('service_name_en'),
                'service_name_ar' => $request->input('service_name_ar'),
                'category_id' => $request->input('category_id'),
                'price' => $request->input('price'),
                'image' => $imageName,
                'session_time' => $request->input('session_time'),
            ]
        );
        // if ($request->has('days')) {
        foreach ($request->input('days') as $day) {
            if (!empty($day['start_time']) && !empty($day['end_time'])) {
                TimeService::create([
                    'time_id' => $day['time_id'],
                    'start_time' => $day['start_time'],
                    'end_time' => $day['end_time'],
                    'service_id' => $services->id,
                ]);
            }
        }
        // }

        return redirect()->route('services.index')->with('success', 'Service created successfully');
    }

    // Show the form for editing the specified service
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        // Fetch all available categories for the category dropdown
        $categories = Category::all();

        // Fetch the times (weekly schedule) for the service
        $times = Time::all(); // Assuming you have a `Time` model for days

        // Fetch the service's existing weekly schedule
        $serviceTimes = TimeService::where('service_id', $service->id)->get();

        // Pass the data to the view
        return view('dashboard.services.edit', compact('service', 'categories', 'times', 'serviceTimes'));
    }

    // Update the specified service in the database
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'service_name_en' => 'required|string|max:255',
            'service_name_ar' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'session_time' => 'required|integer',
           
        ]);

        // Find the service by ID
        $service = Service::findOrFail($id);

        // Update the service details
        $service->service_name_en = $request->service_name_en;
        $service->service_name_ar = $request->service_name_ar;
        $service->category_id = $request->category_id;
        $service->price = $request->price;
        $service->session_time = $request->session_time;

        // Check if there's a new image uploaded
        if ($request->hasFile('image')) {
            // Remove old image if exists
            if ($service->image) {
                Storage::delete('public/services_images/' . $service->image);
            }

            // Store the new image
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = "category-" . uniqid() . ".$ext";
            $image->move(public_path('services_images'), $imageName);
            $service->image = $imageName;
        }

        // Save the service details
        $service->save();

        // Update the weekly schedule (if any changes)
        if ($request->has('days')) {
            foreach ($request->days as $dayData) {
                // Check if there's a start_time and end_time for this day
                if (isset($dayData['start_time']) && isset($dayData['end_time'])) {
                    // Find or create the ServiceTime record for this day
                    $serviceTime = TimeService::updateOrCreate(
                        ['service_id' => $service->id, 'time_id' => $dayData['time_id']],
                        ['start_time' => $dayData['start_time'], 'end_time' => $dayData['end_time']]
                    );
                }
            }
        }

        // Redirect back to the service index with a success message
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }


    // Remove the specified service from the database
    public function destroy($id)
    {
        $service = service::findOrFail($id);
        TimeService::where('service_id', $service->id)->delete();
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }

    //
}
