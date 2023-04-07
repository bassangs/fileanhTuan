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
            return redirect()->route('auth.show.login')->with('success', 'Đăng ký thành công');
        }else {
            return redirect()->back()->with('invalid', 'Mật khẩu không trùng khớp');
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
        try {
            $result = Auth::attempt(['email' => $request->email, 'password' => $request->password], true);
            if ($result) {
                return redirect()->route('client.home');
            } else {
                return redirect()->back()->withInput()->with('invalid', 'Email/Mật khẩu không đúng');
            }
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
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
        return redirect()->route('auth.show.login')->with('success', 'Đăng xuất thành công');
    }

    public function resetPass()
    {
        return view('client.auth.reset_password');
    }

    /**
     * Send mail link
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendLink(Request $request)
    {
        $check = User::where('email',$request->input('email'))->exists();
        if ($check) {
            $token = Str::random(30);
            PasswordReset::create([
                'email'    => $request->input('email'),
                'token'    => $token
            ]);
            Mail::to($request->input('email'))->send(new SendLink($token));
            return redirect()->back()->with('success','Gửi link thành công, vui lòng kiểm tra hộp thư của bạn.');
        } else {
            return redirect()->back()->with('invalid','Mail không tồn tại trong hệ thống.');
        }
    }

    /**
     * Show password change form
     * 
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function showChangePassword($token)
    {
        $user = PasswordReset::where('token', '=', $token)->first();
        return view('client.auth.change_password',['email' => $user['email']]);
    }

    /**
     * Update password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        
        if($request->input('password') === $request->input('repassword')){
            User::where('email',$request->input('email'))->update(['password' => bcrypt($request->input('password'))]);
            if(Auth::check()){
                Auth::logout();
            }
            return redirect()->route('auth.show.login')->with('success','Đổi mật khẩu thành công.');
        }else{
            return redirect()->back()->with('invalid','Mật khẩu không trùng khớp.');
        }
    }
}
