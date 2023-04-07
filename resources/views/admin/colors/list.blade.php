@extends('admin.layouts.index')

@section('title', 'Danh sách màu sắc')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Màu sắc</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Màu</th>
                        <th>Tên màu sắc</th>
                        <th>Mã màu</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach ($colors as $color)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>
                                <div style="background-color: {{ $color->hex }};width: 50px;height:50px;border-radius: 100%;"></div>
                            </td>
                            <td>{{ $color->name }}</td>
                            <td>{{ $color->hex }}</td>
                            <td>
                                <a href="{{ route('color.delete', ['id' => $color->id]) }}" class="btn btn-danger btn-circle btn-sm" onclick="return confirm('Bạn có muốn xóa màu sắc này ?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="{{ route('color.edit.form', ['id' => $color->id]) }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-pen"></i>
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
