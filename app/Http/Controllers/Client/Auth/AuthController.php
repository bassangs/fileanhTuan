<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use App\Mail\SendLink;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin() {
        return view('client.auth.login');
    }

    public function showRegister() {
        return view('client.auth.register');
    }

    /**
     * Register account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if($request->password === $request->repassword) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'sex' => $request->sex,
                'phone' => $request->phone,
            ]);
            toastr()->success('Đăng ký thành công');

            return redirect()->route('auth.show.login');
        }else {
            toastr()->error('Mật khẩu không trùng khớp');

            return redirect()->back();
        }
    }

    /**
     * Login account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $result = Auth::attempt(['email' => $request->email, 'password' => $request->password], true);
        if ($result) {
            toastr()->success('Đăng nhập thành công');

            return redirect()->route('client.home');
        } else {
            toastr()->error('Email / Mật khẩu không đúng');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        toastr()->success('Đăng xuất thành công');

        return redirect()->route('auth.show.login');
    }

    public function changeAccount()
    {
        $user = User::find(Auth::user()->id);
        return view('client.auth.change_account', compact('user'));
    }

    public function postChangeAccount(Request $request)
    {
        $user = Auth::user();
        if ($request->email !== $user->email && User::where('email', $request->email)->exists()) {
            toastr()->error('Email đã tồn tại trong hệ thống');
            return redirect()->back();
        } else {
            $user->email = $request->email;
        }
        $user->name = $request->name;
        $user->sex = $request->sex;
        $user->phone = $request->phone;
        $user->save();
        toastr()->success('Cập nhật thành công');

        return redirect()->back();
    }
}
