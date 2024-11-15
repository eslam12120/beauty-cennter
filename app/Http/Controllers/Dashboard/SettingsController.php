<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
       $setting=Setting::first();

        return view('dashboard.all_settings.setting',compact('setting'));
    }
    public function update(Request $request, Setting $setting)
    {
        $name=$setting->logo;
        if($request->hasFile('logo'))
        {

        $photo=$request->file('logo');
        $ext=$photo->getClientOriginalName();
        $name="logo-".uniqid().".$ext";
        $photo->move(public_path('images/setting'),$name);
        }
        $setting->name_ar = $request->name_ar;
        $setting->name_en = $request->name_en;
        $setting->address_ar = $request->address_ar;
        $setting->address = $request->address_en;
        $setting->phone = $request->phone;
        $setting->commercial_number= $request->commercial_number;
        $setting->tax_percentage = $request->tax_percentage;
        $setting->tax_number = $request->tax_number;
        $setting->lat = $request->lat;
        $setting->long = $request->long;
        $setting->shipping_price = $request->shipping_price;
        $setting->allowed_distance = $request->allowed_distance;
        $setting->invoice_validity= $request->invoice_validity;
        $setting->logo=$name;

        $setting->save();
        return redirect(route('admin.settings.index'));
    }
}
