<?php

namespace App\Http\Controllers\Api;

use App\Models\service;
use App\Models\Specialist;
use Illuminate\Http\Request;
use App\Models\FavSpecialist;
use App\Http\Controllers\Controller;
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
            if (auth()->check()) {
                $total = FavSpecialist::where('specialist_id', $specialist->id)->where('user_id', Auth::guard('user-api')->user()->id)->count();
                if ($total == 0) {
                    $specialists['is_fav'] = 0;
                } else {
                    $specialists['is_fav'] = 1;
                }
            } else {
                $specialists['is_fav'] = 0;
            }
            return $specialist;
        });
        // Return the paginated response
        return response()->json([
            'message' => 'success',
            'data' => $specialists,
        ], 200);
    }

    public function getSpecialistDataByID($id, Request $request)
    {
        if (!empty($id)) {
            $specialist = Specialist::with([
                'categories' => function ($q) {
                    // Use the app locale for category name
                    $q->select('id', 'name_' . app()->getLocale() . ' as name');
                },
                'services' => function ($query) use ($request) {
                    $query->select(
                        'services.id',
                        'services.price',
                        'services.session_time',
                        $request->lang === 'en' ? 'services.service_name_en as service_name' : 'services.service_name_ar as service_name'
                    );
                }
            ])->find($id);

            if ($specialist) {
                if (auth()->check()) {
                    $total = FavSpecialist::where('specialist_id', $specialist->id)->where('user_id', Auth::guard('user-api')->user()->id)->count();
                    if ($total == 0) {
                        $specialist->is_fav = 0;
                    } else {
                        $specialist->is_fav = 1;
                    }
                } else {
                    $specialist->is_fav = 0;
                }
                $specialist->image_url = asset('special_images/' . $specialist->image);
            }
            if ($specialist != null) {
                return response()->json(['data' => $specialist]);
            } else {
                return response()->json(['error' => 'Specialist Not Found']);
            }
        } else {
            return response()->json(['error' => 'Specialist Id Is Empty']);
        }
    }
}
