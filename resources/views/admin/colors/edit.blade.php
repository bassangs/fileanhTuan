@extends('admin.layouts.index')

@section('title', 'Cập nhật màu sắc')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Cập nhật màu sắc</h1>

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('color.edit', ['id' => $color->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="name">Tên màu sắc: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập tên màu sắc" id="name" name="name" value="{{ $color->name }}" required>
            </div>
            <div class="form-group">
                <label for="hex">Mã màu: <span class="text-danger">*</span></label>
                <input type="color" class="form-control" placeholder="Nhập mã màu" id="hex" name="hex" value="{{ $color->hex }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
          </form>
    </div>
</div>
@endsection