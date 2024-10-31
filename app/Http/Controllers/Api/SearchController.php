<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\service;
use App\Models\Specialist;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function categorySpecialistSearch($search){
        $categories = Category::where('name_en','LIKE','%'.$search.'%')->get();
        $specialists = Specialist::where('name','LIKE','%'.$search.'%')
        ->orWhere('rate','LIKE','%'.$search.'%')->get();

        return response()->json([
            'categories' => $categories,
            'specialists' => $specialists
        ]);
    }
    public function specialistSearch($search){
        $specialists = Specialist::where('name','LIKE','%'.$search.'%')
        ->orWhere('rate','LIKE','%'.$search.'%')->get();
        return response()->json([
            'specialists' => $specialists
        ]);
    }
    public function servicesSearch($search)
    {
        $services = service::where('service_name_en', 'LIKE','%' . $search . '%')
        ->orWhere('service_name_ar', 'LIKE','%' . $search . '%')
        ->orWhere('price',$search)
        ->get();
        return response()->json([
            'services' => $services
        ]);
    }
}
