<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     /**
     * Show the user form login
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $result = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], true);

        if ($result) {
            toastr()->success('Đăng nhập thành công');

            return redirect()->route('dashboard');
        } else {
            toastr()->error('Email / Mật khẩu không đúng');
            
            return redirect()->back();
        }
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        toastr()->success('Đăng xuất thành công');

        return redirect()->route('admin.form.login');
    }
}
