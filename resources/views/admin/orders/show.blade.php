@extends('admin.layouts.index')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Đơn đặt hàng
                <small>Chi tiết</small>
            </h1>
        </div>
        @if ($order->status !== 3)
            <form method="POST" action="{{ route('order.edit', ['id' => $order->id]) }}" style="margin-bottom: 3rem;">
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
                <button type="submit" name="submit">Cập nhật</button>
            </form>
        @endif
        <table class="table table-striped table-bordered table-hover" id="menu-table">
            <thead>
                <tr align="center">
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders_detail as $row)
                <tr class="even gradeC" align="center">
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>{{ number_format($row->price,-3,',',',') }} VND</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection