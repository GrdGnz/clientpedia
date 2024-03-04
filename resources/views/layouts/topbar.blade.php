<nav class="sb-topnav navbar navbar-expand navbar-dark marsman-bg-color-primary marsman-border-b-secondary-5">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3">
        <img src="{{ asset('img/logo-white.png') }}" class="img-fluid" />
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control txt-2" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn marsman-btn-secondary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>-->
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-md-3 my-2 my-md-0">
        @if(auth()->user()->role_id == 3)
            <li class="nav-list p-3">
                <a class="text-white" href="{{ route('administrator.user-activities') }}">Activity Log</a>
            </li>
        @endif
        <li class="nav-list p-3"><a class="text-white" href="{{ route('profile') }}">Settings</a></li>
        <li class="nav-list p-3">
            <a class="text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>