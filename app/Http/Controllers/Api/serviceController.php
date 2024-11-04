<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FavServices;
use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class serviceController extends Controller
{
    public function getAllServices(Request $request)
    {
        $lang = $request->lang ; // or 'ar', dynamically set this based on user preference
        $nameColumn = $lang === 'ar' ? 'service_name_ar' : 'service_name_en';
        $allServices = service::select('id', $nameColumn . ' as name', 'price', 'image', 'category_id', 'created_at')
            ->with(['category' => function ($q) {
                $q->select('id', 'name_' . app()->getLocale() . ' as name'); // Use the app locale for category name
            }, 'specialists']) // Include specialists relationship
            ->get()
            ->map(function ($service) {
                // Map over the services to add additional data
                $service['date'] = $service->created_at->diffForHumans();
                $service['img_url'] = asset('services_images/' . $service->image);
                return $service;
            });
        $allServices->map(function ($allServices) {

            $total = FavServices::where('service_id',$allServices->id)->where('user_id', Auth::guard('user-api')->user()->id)->count();
            if($total==0)
            {
                $allServices['is_fav'] = 0;
            }
            else
            {
                $allServices['is_fav'] = 1;
            }
            
        });
        return response()->json([
            'message'=>'success',
            'data' => $allServices
        ],200);
    }

    public function getAllServicesByCatId($catId , Request $request )
    {
        $lang = $request->lang ; // or 'ar', dynamically set this based on user preference
        $nameColumn = $lang === 'ar' ? 'service_name_ar' : 'service_name_en';
        $allCategoryServices = service::select('id', $nameColumn . ' as name', 'price', 'image', 'category_id', 'created_at')->where('category_id', $catId)
            ->with(['category' => function ($q) {
                $q->select('id', 'name_' . app()->getLocale() . ' as name'); // Use the app locale for category name
            }, 'specialists']) // Include specialists relationship
            ->get()
            ->map(function ($service) {
            $service['date'] = $service->created_at->diffForHumans();
            $service['img_url'] = asset('services_images/' . $service->image);
            return $service;
        });
        return response()->json([
            'message'=>'success',
            'data' => $allCategoryServices
        ],200);
    }
}
