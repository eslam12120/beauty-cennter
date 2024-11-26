<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\service;
use App\Models\Specialist;
use App\Models\TimeSpecialist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Specialist::orderBy('id', 'DESC')->paginate(14);
        return view('dashboard.specialists.index', compact('specialists'));
    }

    public function create()
    {
        $categories=Category::get();
        $services=service::get();
        return view('dashboard.specialists.create',compact('categories','services'));
    }

    public function store(Request $request)
    {
        // try {

            $request->validate([
                'name' => 'required',
                'image' => 'required',
                'category_id'=>'required',
                'services' => 'required|array',
                'services.*' => 'exists:services,id',
              
            ]);
            DB::beginTransaction();

            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = "specialist-" . uniqid() . ".$ext";
                $image->move(public_path('special_images'), $imageName);
            }

            $specialist=Specialist::create([
                'name' => $request->name,
                'image' => $imageName,
                'category_id'=>$request->category_id,
                'rate'=>0,
                // If you have other fields, add them here
            ]);
        // Attach Services with Timestamps
        foreach ($request->services as $serviceId) {
            DB::table('service_specialities')->insert([
                'specialist_id' => $specialist->id,
                'service_id' => $serviceId,
                
            ]);
        }
            DB::commit();
            return redirect()->route('specialist.index')->with(['success' => 'Specialist added successfully']);
        // } catch (\Exception $ex) {
        //     DB::rollback();
        //     return redirect()->route('specialist.index')->with(['error' => 'Error occurred. Please try again']);
        // }
    }

    public function edit($id)
    {
        $services = Service::all();
        $categories = Category::get();
        $specialist = Specialist::find($id);
        $specialistServices = DB::table('service_specialities')
        ->where('specialist_id', $id)
        ->pluck('service_id') // Fetch service IDs
        ->toArray();

        if (!$specialist) {
            return redirect()->route('specialist.index')->with(['error' => 'Specialist not found']);
        }

        return view('dashboard.specialists.edit', compact('specialist','categories','services', 'specialistServices'));
    }

    public function update($id, Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'image' => 'nullable',
                'category_id' => 'required',
                'services' => 'required|array', 
                'services.*' => 'exists:services,id',
            ]);
            $specialist = Specialist::find($id);

            if (!$specialist) {
                return redirect()->route('specialist.index')->with(['error' => 'Specialist not found']);
            }

            $imageName = $specialist->image;
            

            $specialist->update([
                'name' => $request->name,
                'image' => $imageName,
                'category_id' => $request->category_id,
            ]);
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($specialist->image) {
                    Storage::delete($specialist->image);
                }

            // Store the new image and get the path
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $filename = "specialist-" . uniqid() . ".$ext";
            $image->move(public_path('special_images'), $filename);
                // Update the user's image path
                $specialist->image = $filename;
                $specialist->save();
            }
            foreach ($request->services as $serviceId) {
                DB::table('service_specialities')->updateOrInsert(
                    [
                        'specialist_id' => $id,
                        'service_id' => $serviceId,
                    ],
                   
                );
            }

            return redirect()->route('specialist.index')->with(['success' => 'Specialist updated successfully']);
        } catch (\Exception $ex) {
            return redirect()->route('specialist.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }

    public function destroy($id)
    {
        try {
            $specialist = Specialist::find($id);

            if (!$specialist) {
                return redirect()->route('specialist.index')->with(['error' => 'Specialist not found']);
            }

            $specialist->delete();

            return redirect()->route('specialist.index')->with(['success' => 'Specialist deleted successfully']);
        } catch (\Exception $ex) {
            return redirect()->route('specialist.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }
}

