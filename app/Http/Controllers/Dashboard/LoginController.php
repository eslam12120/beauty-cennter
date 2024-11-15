<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\AdminGuardTrait;
use App\Http\Requests\AdminLoginRequest;

use Illuminate\Http\Request;



class LoginController extends Controller
{
    //
    use AdminGuardTrait;

    public function login()
    {
        return view('dashboard.auth.login');
    }


    public function check(AdminLoginRequest $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        $guard=$this->getGuard();
       if ($guard->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);


    }

    public function logout()
    {
        $guard=$this->getGuard();

        $guard->logout();


        return redirect()->route('admin.login');


    }




}
