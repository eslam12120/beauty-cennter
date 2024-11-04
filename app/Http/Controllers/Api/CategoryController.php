<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\service;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(Request $request){
        $lang = $request->lang ; // or 'ar', dynamically set this based on user preference
        $nameColumn = $lang === 'ar' ? 'name_ar' : 'name_en';
        $categories = Category::select('id' ,$nameColumn . ' as name')->get()
            ->map(function ($category) {
            $category->image_url = asset('categories_images/' . $category->image);
            return $category;
        });
        $categories->map(function ($categories) {

            $total = service::where('category_id', $categories->id)->count();
            
                $categories['number_of_servieces'] = $total;
           
        });

        return response()->json([

            'status' => '200',
            'message' => 'success',
            'data' =>  $categories,
        ]);
    }
}
