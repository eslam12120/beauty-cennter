<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\service;
use App\Models\Specialist;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function categorySpecialistSearch(Request $request){
        $categories = Category::where('name_en','LIKE','%'.$request->search.'%')->orWhere('name_ar','LIKE','%'.$request->search.'%')->get();
        $specialists = Specialist::where('name','LIKE','%'.$request->search.'%')
        ->get();
        return response()->json([
            'message'=>'success',
            'categories' => $categories,
            'specialists' => $specialists
        ]);
    }
    public function specialistSearch(Request $request){
        $specialists = Specialist::where('name','LIKE','%'.$request->search.'%')->get();
        return response()->json([
            'message'=>'success',
            'data' => $specialists
        ]);
    }
    public function servicesSearch(Request $request)
    {
        $services = service::when($request->search, function ($query, $search) {
            $query->where('service_name_en', 'LIKE', '%' . $search . '%')
                ->orWhere('service_name_ar', 'LIKE', '%' . $search . '%');
        })->get();
        return response()->json([
            'message'=>'success',
            'data' => $services
        ]);
    }
}
