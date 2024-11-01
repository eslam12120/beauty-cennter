<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{

    public function getAllSpecialists(){
        $specialists = Specialist::all()->map(function ($specialist){
            $specialist->image_url = asset('special_images/' . $specialist->image);
            $specialist->name_en = $specialist->categories->name_en;
            return $specialist;
        });
        return response()->json($specialists->paginate(10));
    }

    public function getSpecialistDataByID($id)
    {
        if(!empty($id))
        {
            $specialist = Specialist::with('services')->find($id);
            if($specialist != null){
                return response()->json($specialist);
            }
            else
            {
                return response()->json(['error' => 'Specialist Not Found']);
            }
        }
        else{
            return response()->json(['error' => 'Specialist Id Is Empty']);
        }
    }
}
