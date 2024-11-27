<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\SpecialForYou;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SpecialForYouController extends Controller
{
    public function index()
    {
        $banners = SpecialForYou::paginate(8);
        return view('dashboard.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('dashboard.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',

        ]);
        try {

            DB::beginTransaction();
            $banner = $request->file('image');
            $ext = $banner->getClientOriginalExtension();
            $banner_name = "banner-" . uniqid() . ".$ext";
            $banner->move(public_path('special_images/'), $banner_name);

            SpecialForYou::create([
                'image' =>  $banner_name,

            ]);

            DB::commit();
            return redirect()->route('admin.banners.index')->with(['success' => 'تمت الاضافة بنجاح ']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.banners.index')->with(['error' => 'error']);
        }
    }

    public function delete($id)
    {
        try {

            $banner = SpecialForYou::find($id);

            if (!$banner)

                return redirect()->route('admin.banners.index')->with(['error' => 'not found']);

            DB::beginTransaction();

            $banner->delete();
            DB::commit();

            return redirect()->route('admin.banners.index')->with(['success' => 'تم الحذف بنجاح ']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.banners.index')->with(['error' => 'error please try again']);
        }
    }
}
