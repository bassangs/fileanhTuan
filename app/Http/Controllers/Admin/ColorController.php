<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();

        return view('admin.colors.list', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Color::create([
            'name' => $request->name,
            'hex' => $request->hex
        ]);
        toastr()->success('Thêm thành công');

        return redirect()->route('color.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = Color::find($id);

        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        $color->name = $request->name;
        $color->hex = $request->hex;
        $color->save();
        toastr()->success('Cập nhật thành công');

        return redirect()->route('color.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();
        toastr()->success('Xóa thành công');

        return redirect()->route('color.list');
    }

    public function updateStatus($id, $status)
    {
        $color = Color::find($id);
        $color->status = $status;
        $color->save();
        toastr()->success('Cập nhật thành công');

        return redirect()->route('color.list');
    }
}