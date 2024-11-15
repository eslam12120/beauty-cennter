<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;

class ProfileController extends Controller
{
    //

    public function editProfile()
    {

        $admin = Admin::find(auth('admin')->user()->id);

        // $admin=Admin::where('id',auth('admin')->id())->first();

        return view('dashboard.profile.edit',compact('admin'));

    }

    public function updateProfile(ProfileRequest $request)

    {

        try {

            $admin = Admin::find(auth('admin')->user()->id);

            //has ممكن تبقي فاضيه
            //filled لازم قيمه
            if ($request->filled('password')) 
            {
                $request->merge(['password' => bcrypt($request->password)]);
            }
           //هحذفهم علشان هم راجعين في الrequest
            unset($request['id']);
            unset($request['password_confirmation']);
           //end
            $admin->update($request->all());
          
            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطا ما يرجي المحاولة فيما بعد']);

        }


    }
}
