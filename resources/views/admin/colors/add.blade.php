@extends('admin.layouts.index')

@section('title', 'Thêm màu sắc')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Thêm màu sắc</h1>

<!-- DataTales Example -->
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('color.add') }}" method="POST" enctype="multipart/form-data">

            @csrf
            
            <div class="form-group">
                <label for="name">Tên màu mắc: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Nhập tên màu sắc" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="hex">Mã màu: <span class="text-danger">*</span></label>
                <input type="color" class="form-control" placeholder="Nhập mã màu" id="hex" name="hex" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
          </form>
    </div>
</div>
@endsection