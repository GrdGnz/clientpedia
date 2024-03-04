<nav class="sb-sidenav accordion sb-sidenav-dark marsman-bg-color-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading text-white">{{ Auth::user()->role['name'] }}</div>
            <a class="nav-link" href="{{ route('administrator.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
                Users
            </a>

            <a class="nav-link" href="{{ route('administrator.clients') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                Clients
            </a>

            <a class="nav-link" href="{{ route('administrator.create.user') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                Create User
            </a>
            <a class="nav-link" href="{{ route('administrator.create.client') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                Create Client
            </a>

            <a class="nav-link" href="{{ route('administrator.assign.clients') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-people-arrows"></i></div>
                Asign Clients to TC
            </a>

            <a class="nav-link" href="{{ route('administrator.assign.clients.accountmanager') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-people-arrows"></i></div>
                Asign Clients to AM
            </a>

            <a class="nav-link" href="{{ route('administrator.categories') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                Categories
            </a>

            <a class="nav-link" href="{{ route('administrator.sources') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-lightbulb"></i></div>
                Sources
            </a>

            <a class="nav-link" href="{{ route('administrator.airlines') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-plane"></i></div>
                Airlines
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer marsman-border-t-pri-3 marsman-bg-color-secondary">
        <div class="small txt-semidark">Logged in as:</div>
        <strong class="txt-dark">{{ Auth::user()->name }}</strong>
        @if ($lastLoginDate)
            <div class="txt-semidark">Time logged: {{ $lastLoginDate->format('Y-m-d H:i:s') }}</div>
         @endif
    </div>
</nav>
