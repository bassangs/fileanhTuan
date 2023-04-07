<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.list',['users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Order::where('user_id','=',$id)->delete();
        $user->delete();
        return redirect()->back()->with('success','Xóa tài khoản thành công.');
    }

    public function disable($id)
    {
        User::where('id',$id)->update(['status' => 0]);
        return redirect()->back()->with('success','Khóa tài khoản thành công.');
    }

    public function enable($id)
    {
        User::where('id',$id)->update(['status' => 1]);
        return redirect()->back()->with('success','Mở tài khoản thành công.');
    }
}
