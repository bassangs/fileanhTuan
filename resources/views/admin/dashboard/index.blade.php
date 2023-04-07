@extends('admin.layouts.index')

@section('title', 'Thống kê')

@section('content')
<!-- Begin Page Content -->
<h1 class="h3 mb-2 text-gray-800">Thống kê</h1>
<!-- Content Row -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Doanh thu hôm nay</div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Doanh thu tháng <?= date('n') ?></div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Doanh thu năm <?= date('Y') ?></div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Số lượng người dùng</div>
                        <div class="h6 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Thống kê doanh thu theo tháng của năm <?= date('Y') ?></h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div id="piechart" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Chờ xác nhận <span class="float-right"></span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar"></div>
                </div>
                <h4 class="small font-weight-bold">Xác nhận <span class="float-right"></span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-primary" role="progressbar"></div>
                </div>
                <h4 class="small font-weight-bold">Hoàn thành <span class="float-right"></span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar"></div>
                </div>
                <h4 class="small font-weight-bold">Hủy <span class="float-right"></span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection