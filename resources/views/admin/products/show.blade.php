@extends('admin.layouts.index')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Chi tiết sản phẩm</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <td><img src="{{ asset($product->image) }}" width="200"></td>
                </tr>
                <tr>
                    <th>Mô tả sản phẩm</th>
                    <td>{!! $product->description ?? 'N/A' !!}</td>
                </tr>
                <tr>
                    <th>Hãng sản phẩm</th>
                    <td>{{ \App\Models\Brand::find($product->brand_id)->name }}</td>
                </tr>
                <tr>
                    <th>Giá tiền</th>
                    <td>{{ number_format($product->price,-3,',',',') }} VND</td>
                </tr>
                <tr>
                    <th>Số lượng</th>
                    <td>{{ $product->qty }}</td>
                </tr>
                <tr>
                    <th>Màu sắc</th>
                    <td>
                        @php
                            $colors = [];
                            foreach (explode(',', $product->colors) as $item) {
                                $colors[] = \App\Models\Color::find($item)->name;
                            }

                            echo implode(', ', $colors);
                        @endphp
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection