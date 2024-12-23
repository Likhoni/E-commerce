<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>

                @if (checkPermission('homepage'))   
                    <a class="nav-link" href="{{ route('homepage') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt" style="color: #1E90FF;"></i>
                        </div>
                        Dashboard
                    </a>
                @endif

                @if (checkPermission('group.list'))
                    <a class="nav-link collapsed" href="{{ route('group.list') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-layer-group" style="color: #6f42c1;"></i>
                        </div>
                        Group
                    </a>
                @endif
                @if (checkPermission('category.list'))
                    <a class="nav-link collapsed" href="{{ route('category.list') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-th-large" style="color: #6f42c1;"></i>
                        </div>
                        Category
                    </a>
                @endif
                @if (checkPermission('brand.list'))
                    <a class="nav-link collapsed " href="{{ route('brand.list') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tags" style="color: #FF5733;"></i> <!-- Orange Brand Icon -->
                        </div>
                        Brand
                    </a>
                @endif
                @if (checkPermission('product.list'))
                    <a class="nav-link collapsed" href="{{ route('product.list') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-box" style="color: #28a745;"></i>
                        </div>
                        Product
                    </a>
                @endif
                @if (checkPermission('customer.list'))
                    <a class="nav-link collapsed" href="{{ route('customer.list') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-user-tag" style="color: #FFC107;"></i>
                        </div>
                        Customer
                    </a>
                @endif
                @if (checkPermission('order.list'))
                    <a class="nav-link collapsed" href="{{ route('order.list') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-shopping-cart" style="color: #17a2b8;"></i>
                        </div>
                        Order
                    </a>
                @endif
                
                    <a class="nav-link collapsed" href="#">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-credit-card" style="color: #4CAF50;"></i>
                        </div>
                        Payment
                    </a>

                    <hr class="text-white my-2">
                    <div class="sb-sidenav-menu-heading">External</div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-heart" style="color: #FF69B4;"></i>
                        </div>
                        Wish-List
                    </a>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-chart-bar" style="color: #4682B4;"></i> <!-- Steel Blue Report Icon -->
                        </div>
                        Report
                    </a>
                    @if (checkPermission('discount.list'))
                        <a class="nav-link collapsed" href="{{ route('discount.list') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-percentage" style="color: #FF6347;"></i>
                            </div>
                            Discount
                        </a>
                    @endif
                    @if (checkPermission('role.list'))
                        <a class="nav-link collapsed" href="{{ route('role.list') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-id-badge" style="color: #4CAF50;"></i>
                            </div>
                            Role
                        </a>
                    @endif
                    @if (checkPermission('user.list'))
                        <a class="nav-link collapsed" href="{{ route('user.list') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-user" style="color: #4682B4;"></i>
                            </div>
                            User
                        </a>
                    @endif
                    <a class="nav-link collapsed" href="#">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-cog" style="color: #808080;"></i> <!-- Grey Setting Icon -->
                        </div>
                        Setting
                    </a>
                    @if (checkPermission('logout'))
                        <a class="nav-link collapsed" href="{{ route('logout') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-sign-out-alt" style="color: #DC143C;"></i> <!-- Red Sign Out Icon -->
                            </div>
                            Sign-Out
                        </a>
                    @endif

            </div>
        </div>
    </nav>
</div>
