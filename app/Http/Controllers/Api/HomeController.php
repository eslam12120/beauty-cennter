<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SpecialForYou as ModelsSpecialForYou;
use App\Models\Specialist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function Home(Request $request)
    {
        $specialForYou = ModelsSpecialForYou::take(5)->latest()->get()->map(function($special) {
            // Set only image_url
            $special->image_url = asset('special_images/' . $special->image);
            return $special;
        });

        $lang = $request->lang; // or default to 'ar' based on user preference
        $nameColumn = $lang === 'ar' ? 'name_ar' : 'name_en';

        $categories = Category::select('id', $nameColumn . ' as name','image')->take(5)->latest()->get()
            ->map(function ($category) {
                $category->image_url = asset('categories_images/' . $category->image);
                return $category;
            });

        $specialists = Specialist::with(['categories' => function ($q) use ($lang) {
            $q->select('id', 'name_' . $lang . ' as name','image');
        }])
            ->take(5)->latest()->get()
            ->map(function ($specialist) {
                $specialist->image_url = asset('special_images/' . $specialist->image);
                return $specialist;
            });

        return response()->json([
            'message' => 'success',
            'special_for_you' => $specialForYou,
            'specialists' => $specialists,
            'categories' => $categories
        ], 200);
    }

    public function turn_notify(Request $request){
         User::where('id' , Auth::id())->update(
             [
                 'is_notify_offer' => $request->is_notify_offer,
                 'is_notify_booking' => $request->is_notify_booking,
             ]
         );
        return response()->json([
            'message' => 'success',
        ], 200);
    }
}
