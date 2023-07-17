<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
        ->get(['products.*', 'brands.name as brand_title']);

        return view('admin.products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $colors = Color::all();

        return view('admin.products.add', compact('brands', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/products', $request->image->getClientOriginalName());
                $request->obj->storeAs('/public/objs/products', $request->obj->getClientOriginalName());
                Product::create([
                   'name' => $request->name,
                   'price' => $request->price,
                   'brand_id' => $request->brand_id,
                   'image' => '/storage/images/products/' . $request->image->getClientOriginalName(),
                   'description' => $request->description,
                   'qty' => $request->qty,
                   'colors' => implode(', ', $request->colors),
                   'obj' => '/storage/objs/products/' .  $request->obj->getClientOriginalName()
                ]);
                toastr()->success('Thêm thành công');

                return redirect()->route('product.list');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::all();
        $colors = Color::all();
        $product = Product::find($id);

        return view('admin.products.edit', compact('brands', 'colors', 'product'));
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
        ini_set('post_max_size', '1000M');
        ini_set('upload_max_filesize', '1000M');
        $product = Product::find($id);
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/products', $request->image->getClientOriginalName());
                $product->image = '/storage/images/products/' .  $request->image->getClientOriginalName();
            }
        }
        if ($request->hasFile('obj')) {
            //  Let's do everything here
            if ($request->file('obj')->isValid()) {
                $request->obj->storeAs('/public/objs/products', $request->obj->getClientOriginalName());
                $product->obj = '/storage/objs/products/' .  $request->obj->getClientOriginalName();
            }
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->colors = implode(', ', $request->colors);
        $product->save();
        toastr()->success('Cập nhật thành công');

        return redirect()->route('product.list');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        toastr()->success('Xóa thành công');

        return redirect()->route('product.list');
    }

    public function show($id)
    {
        $product = Product::find($id); 
        return view('admin.products.show', compact('product'));
    }
}
