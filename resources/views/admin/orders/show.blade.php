@extends('admin.layouts.index')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Chi tiết đơn hàng</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if ($order->status !== 3)
                <form method="POST" action="{{ route('order.edit', ['id' => $order->id]) }}" style="margin-bottom: 1rem;">
                    @csrf
                    <select name="status" class="status" style="padding:0.4rem 0;outline:none;">
                        @if ($order->status === 0)
                            <option value="1">Xác nhận</option>
                            <option value="4">Hủy đơn hàng</option>
                        @elseif ($order->status === 1)
                            <option value="2">Đang vận chuyển</option>
                        @elseif ($order->status === 2)
                            <option value="3">Hoàn thành</option>
                        @endif
                    </select>
                    <button class="btn btn-primary" type="submit" name="submit">Cập nhật</button>
                </form>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>STT</th>
                            <th>Dòng xe</th>
                            <th>Màu sắc</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders_detail as $key => $row)
                            <tr class="even gradeC" align="center">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ \App\Models\Color::find($row->color_id)->name }}</td>
                                <td>{{ $row->qty }}</td>
                                <td>{{ number_format($row->price, -3, ',', ',') }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
