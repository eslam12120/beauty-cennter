<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FavSpecialist;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialistController extends Controller
{

    public function getAllSpecialists(Request $request)
    {
        // Use a query builder to paginate the specialists
        $specialists = Specialist::with(['categories' => function ($q) {
            // Use the app locale for category name
            $q->select('id', 'name_' . app()->getLocale() . ' as name');
        }])
            ->paginate(10); // Perform pagination here

        // Map over the specialists to add the image_url
        $specialists->getCollection()->transform(function ($specialist) {
            $specialist->image_url = asset('special_images/' . $specialist->image);
            return $specialist;
        });
        $specialists->map(function ($specialists) {

            $total = FavSpecialist::where('specialist_id', $specialists->id)->where('user_id', Auth::guard('user-api')->user()->id)->count();
            if ($total == 0) {
                $specialists['is_fav'] = 0;
            } else {
                $specialists['is_fav'] = 1;
            }
        });

        // Return the paginated response
        return response()->json([
            'message' => 'success',
            'data' => $specialists,
        ], 200);
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
