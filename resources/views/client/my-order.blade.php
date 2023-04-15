@extends('client.layouts.template')

@section('title', 'Đơn hàng của tôi')

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{  asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Đơn hàng của tôi</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th>Mã đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->count() > 0)
                            @foreach ($orders as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ \App\Models\User::find($row->user_id)->name }}</td>
                                    <td>{{ number_format($row->total,-3,',',',') }} VND</td>
                                    <td>{{ date('d/m/Y H:i:s',strtotime($row->created_at)) }}</td>
                                    <td>
                                        @if ($row->status === 0)
                                            {{ 'Chờ xác nhận' }}
                                        @elseif ($row->status === 1)
                                            {{ 'Xác nhận' }}
                                        @elseif ($row->status === 2)
                                            {{ 'Hoàn thành' }}
                                        @elseif ($row->status === 3)
                                            {{ 'Hủy' }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('my.order.show', ['id' => $row->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" align="center">Hiện chưa có đơn hàng</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
@stop