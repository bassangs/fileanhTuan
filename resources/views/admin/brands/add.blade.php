@extends('admin.layouts.index')

@section('title', 'Thêm hãng')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Thêm hãng</h1>

<!-- DataTales Example -->
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('brand.add') }}" method="POST" enctype="multipart/form-data">

            @csrf
            
            <div class="form-group">
                <label for="name">Tên hãng: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập tên hãng" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="image">Chọn hình ảnh:</label>
                <div class="custom-file">
                    <input type="file" id="image" name="image" accept=".png,.gif,.jpg,.jpeg" required/>
                </div>
            </div>
            <div class="image-preview mb-4" id="imagePreview">
                <img src="" alt="Image Preview" class="image-preview__image" />
                <span class="image-preview__default-text">Hình ảnh</span>
            </div>
            <br />
            <button type="submit" class="btn btn-primary">Thêm</button>
          </form>
    </div>
</div>
@endsection