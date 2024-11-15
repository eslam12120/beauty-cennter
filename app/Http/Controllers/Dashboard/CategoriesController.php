<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(14);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = "category-" . uniqid() . ".$ext";
                $image->move(public_path('images/categories'), $imageName);
            }

            $category = Category::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'image' => $imageName,
            ]);

            DB::commit();
            return redirect()->route('category.index')->with(['success' => 'Category added successfully']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('category.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }

    public function edit($id)
    {
        $category = Category::orderBy('id', 'DESC')->find($id);

        if (!$category) {
            return redirect()->route('category.index')->with(['error' => 'Category not found']);
        }

        return view('dashboard.categories.edit', compact('category'));
    }

    public function update($id, CategoryRequest $request)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return redirect()->route('category.index')->with(['error' => 'Category not found']);
            }

            $imageName = $category->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = "category-" . uniqid() . ".$ext";
                $image->move(public_path('images/categories'), $imageName);
            }

            $category->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'image' => $imageName,
            ]);

            return redirect()->route('category.index')->with(['success' => 'Category updated successfully']);
        } catch (\Exception $ex) {
            return redirect()->route('category.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category) {
                return redirect()->route('category.index')->with(['error' => 'Category not found']);
            }

            $category->delete();

            return redirect()->route('category.index')->with(['success' => 'Category deleted successfully']);
        } catch (\Exception $ex) {
            return redirect()->route('category.index')->with(['error' => 'Error occurred. Please try again']);
        }
    }
}
