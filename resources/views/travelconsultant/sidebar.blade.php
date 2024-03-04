<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu marsman-bg-color-dark">
        <div class="nav">
            <div class="sb-sidenav-menu-heading text-white">{{ Auth::user()->role['name'] }}</div>
            
            @if (isset($client['id']))

                <a class="nav-link" href="{{ route('travelconsultant.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Assigned Clients
                </a>

                <div class="marsman-bg-color-semidark text-white w-100 text-center py-3 p-1">
                    <span class="txt-2"><strong>{{ strtoupper($client['name']) }}</strong></span>
                </div>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('travelconsultant.basic_info', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                    Basic Info
                </a>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('travelconsultant.pricing', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                    Pricing & Financial
                </a>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('travelconsultant.air', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-plane"></i></div>
                    Air
                </a>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('travelconsultant.hotel', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div>
                    Hotel
                </a>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('travelconsultant.car', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                    Car
                </a>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('travelconsultant.car_transfer', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shuttle-van"></i></div>
                    Car Transfer
                </a>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('travelconsultant.documentation', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-passport"></i></div>
                    Documentation
                </a>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('travelconsultant.reporting_elements', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Reporting Elements
                </a>
            
            @else

                <a class="nav-link" href="{{ route('travelconsultant.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Assigned Clients
                </a>

            @endif

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