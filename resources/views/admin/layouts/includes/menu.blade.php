<!-- Nav Item - Dashboard -->
<li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Thống kê</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Sản phẩm
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item {{ Route::is('brand.list') || Route::is('brand.add.form') || Route::is('brand.edit.form') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
        aria-controls="collapseOne">
        <i class="fas fa-fw fa-table"></i>
        <span>Hãng sản phẩm</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('brand.list') }}">Danh sách</a>
            <a class="collapse-item" href="{{ route('brand.add') }}">Thêm mới</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item {{ Route::is('color.list') || Route::is('color.add.form') || Route::is('color.edit.form') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-table"></i>
        <span>Màu sắc</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('color.list') }}">Danh sách</a>
            <a class="collapse-item" href="{{ route('color.add') }}">Thêm mới</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item {{ Route::is('product.list') || Route::is('product.add.form') || Route::is('product.edit.form') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
        aria-controls="collapseThree">
        <i class="fas fa-fw fa-table"></i>
        <span>Sản phẩm</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('product.list') }}">Danh sách</a>
            <a class="collapse-item" href="{{ route('product.add') }}">Thêm mới</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Người dùng
</div>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item {{ Route::is('user.list') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
        aria-controls="collapseFour">
        <i class="fas fa-fw fa-table"></i>
        <span>Khách hàng</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('user.list') }}">Danh sách</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Mua hàng
</div>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item {{ Route::is('order.list') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
        aria-controls="collapseFive">
        <i class="fas fa-fw fa-table"></i>
        <span>Đơn hàng</span>
    </a>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('order.list') }}">Danh sách</a>
        </div>
    </div>
</li>
