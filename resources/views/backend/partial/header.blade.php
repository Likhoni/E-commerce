<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="#!">E-Commerce</a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>

    <!-- Right side content -->
    <ul class="navbar-nav ms-auto">
        @auth
            <!-- Profile Icon and Name -->
            <li class="nav-item dropdown d-flex align-items-center me-4">
                <a class="nav-link d-flex align-items-center" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; align-items: center;">
                    <!-- User Name -->
                    <span style="color: white; margin-right: 10px;">
                       {{auth()->user()->role->name}} : {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </span>
                    @if (auth()->user()->image)
                        <img src="{{ url('images/users/', auth()->user()->image) }}" alt="" class="profile-img"
                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                    @else
                        <i class="fas fa-user fa-fw" style="margin-right: 10px;"></i>
                    @endif
                    <!-- Down arrow icon (chevron) -->
                    <i class="fas fa-chevron-down"></i>
                </a>

                <!-- Dropdown Menu -->
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a href="{{route('user.list')}}" class="dropdown-item" href="#!">View Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </li>
        @endauth
    </ul>
</nav>
