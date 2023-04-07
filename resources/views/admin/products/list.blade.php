@extends('admin.layouts.index')

@section('title', 'Danh sách sản phẩm')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Sản phẩm</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Hãng sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th width="90">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>
                                <a href="{{ asset($product->image) }}" target="_blank"><img src="{{ asset($product->image) }}" width=60></a>
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand_title }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ number_format($product->price,-3,',',',') }} VND</td>
                            <td>
                                <a href="{{ route('product.delete',['id' => $product->id]) }}" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Bạn muốn xóa sản phẩm này ?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="{{ route('product.edit.form',['id' => $product->id]) }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="{{ route('product.show',['id' => $product->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @php $count++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
