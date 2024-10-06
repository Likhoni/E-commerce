<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>

                <a class="nav-link" href="{{route('homepage')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-tachometer-alt" style="color: #1E90FF;"></i>
                    </div>
                    Dashboard
                </a>

                <a class="nav-link collapsed" href="{{route('admin.category.list')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-th-large" style="color: #6f42c1;"></i>
                    </div>
                    Category
                </a>

                <a class="nav-link collapsed" href="{{route('admin.product.list')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-box" style="color: #28a745;"></i>
                    </div>
                    Product
                </a>

                <a class="nav-link collapsed" href="{{route('admin.customer.list')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-user" style="color: #FFC107;"></i>
                    </div>
                    Customer
                </a>

                <a class="nav-link collapsed" href="#">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-shopping-cart" style="color: #17a2b8;"></i>
                    </div>
                    Order
                </a>

                <a class="nav-link collapsed" href="#">
                    <div class="sb-nav-link-icon" style="color: #e83e8c;">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    Order Details
                </a>


                <a class="nav-link collapsed" href="#">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-credit-card" style="color: #4CAF50;"></i>
                    </div>
                    Payment
                </a>

                <hr class="text-white my-2">
                <div class="sb-sidenav-menu-heading">External</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-heart" style="color: #FF69B4;"></i>
                    </div>
                    Wish-List
                </a>

                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <div class="sb-nav-link-icon">
                            <i class="fas fa-tags" style="color: #FF5733;"></i> <!-- Orange Brand Icon -->
                        </div>
                        <span class="nav-link-text ms-1"><b><em>Brand</em></b></span>
                    </a>
                </li>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-chart-bar" style="color: #4682B4;"></i> <!-- Steel Blue Report Icon -->
                    </div>
                    Report
                </a>

                <a class="nav-link collapsed" href="#">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-percentage" style="color: #FF6347;"></i>
                    </div>
                    Discount
                </a>

                <a class="nav-link collapsed" href="{{route('admin.role.list')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-user" style="color: #FF6347;"></i>
                    </div>
                    Role
                </a>

                <a class="nav-link collapsed" href="{{route('admin.user.list')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-user" style="color: #FF6347;"></i>
                    </div>
                    User
                </a>

                <a class="nav-link collapsed" href="#">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-cog" style="color: #808080;"></i> <!-- Grey Setting Icon -->
                    </div>
                    Setting
                </a>

                <a class="nav-link collapsed" href="{{route('admin.logout')}}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-sign-out-alt" style="color: #DC143C;"></i> <!-- Red Sign Out Icon -->
                    </div>
                    Sign-Out
                </a>

            </div>
        </div>
    </nav>
</div>