<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\service;
use Illuminate\Http\Request;

class serviceController extends Controller
{
    public function getAllServices()
    {
        $allServices = service::with('category')->get()->map(function($service)
        {
            $service['date'] = $service->created_at->diffForHumans();
            $service['img_url'] = asset('services_images/' . $service->image);
            return $service;
        });
        return response()->json([
            'services' => $allServices
        ]);
    }
}
