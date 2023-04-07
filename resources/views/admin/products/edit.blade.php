@extends('admin.layouts.index')

@section('title', 'Cập nhật sản phẩm')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Cập nhật sửa phẩm</h1>

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('product.edit',['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="brand_id">Hãng sản phẩm: <span class="text-danger">*</span></label>
                <select class="form-control" name="brand_id" id="brand_id">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Tên sản phẩm: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="price">Giá tiền: <span class="text-danger">*</span></label>
                <input type="number" class="form-control" placeholder="Nhập giá tiền" id="price" name="price" value="{{ $product->price }}" min=1 required>
            </div>
            <div class="form-group">
                <label for="qty">Số lượng: <span class="text-danger">*</span></label>
                <input type="number" class="form-control" placeholder="Nhập số lượng" id="qty" name="qty" value="{{ $product->qty }}" min=1 required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả sản phẩm:</label>
                <textarea class="form-control" id="description" name="description">{!! $product->description !!}</textarea>
            </div>
            <div class="form-group">
                <label for="color">Màu sắc: <span class="text-danger">*</span></label>
                <select class="form-control" name="colors[]" id="color" size="4" multiple>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}" {{ in_array($color->id, explode(',', $product->colors)) ? 'selected' : '' }}>{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Chọn hình ảnh:</label>
                <div class="custom-file">
                    <input type="file" id="image" name="image" accept=".png,.gif,.jpg,.jpeg" />
                </div>
            </div>
            <div class="image-preview mb-4" id="imagePreview">
                <img src="{{ asset($product->image) }}" alt="Image Preview" class="image-preview__image" style="display:block;" />
                <span class="image-preview__default-text" style="display:none;">Hình ảnh</span>
            </div>
            <br />
            <button type="submit" class="btn btn-primary">Cập nhật</button>
          </form>
    </div>
</div>
@endsection