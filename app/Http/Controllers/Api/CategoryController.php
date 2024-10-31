<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(){
        $categories = Category::all()->map(function ($category) {
            $category->image_url = asset('categories_images/' . $category->image);
            return $category;
        });

        return response()->json($categories);
    }
}
