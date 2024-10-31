<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpecialForYou as ModelsSpecialForYou;
use Illuminate\Http\Request;

class SpecialForYou extends Controller
{
    public function getSpecialForYou(){

        $specialForYou = ModelsSpecialForYou::all()->map(function($special){
            $special->imageUrl =   $special->image_url = asset('special_images/' . $special->image);
            return $special;
        });
        return response()->json($specialForYou);
    }
}
