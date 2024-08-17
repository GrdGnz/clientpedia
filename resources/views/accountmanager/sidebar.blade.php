<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu marsman-bg-color-dark" id="menuDiv">
        <div class="nav">
            <div class="sb-sidenav-menu-heading text-white">{{ Auth::user()->role['name'] }}</div>

            <a class="nav-link" href="{{ route('accountmanager.clients.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                Manage Clients
            </a>
            <a class="nav-link" href="{{ route('accountmanager.clients.create') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>
                Create Client
            </a>
            <a class="nav-link" href="{{ route('accountmanager.assign') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-hands-helping"></i></div>
                Assign Client
            </a>


            @if (isset($client['id']))
                <div class="marsman-bg-color-semidark text-white w-100 text-center py-3 p-1">
                    <span class="txt-2"><strong>{{ strtoupper($client['name']) }}</strong></span>
                </div>

                <a class="nav-link" href="{{ route('accountmanager.clients.show', $client) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                    Info
                </a>

                <a class="nav-link" href="{{ route('accountmanager.clients.contact.create', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-phone-square"></i></div>
                    Contacts
                </a>

                <a class="nav-link" href="{{ route('accountmanager.clients.approver.create', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-phone-square"></i></div>
                    Approvers
                </a>

                <a class="nav-link" href="{{ route('accountmanager.clients.booker.create', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-phone-square"></i></div>
                    Bookers
                </a>

                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePricingAndFinancial" aria-expanded="false" aria-controls="collapsePricingAndFinancial">
                    <div class="sb-nav-link-icon"><i class="fas fa-money-bill"></i></div>
                    Pricing And Financial
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse bg-secondary" id="collapsePricingAndFinancial" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSummaryOfFees" aria-expanded="false" aria-controls="collapseSummaryOfFees">
                            Summary of Fees
                        </a>
                        <div class="collapse" id="collapseSummaryOfFees" aria-labelledby="headingSummaryOfFees" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('accountmanager.clients.pricingmodel', ['clientId' => $client['id']]) }}">
                                    @if(isset($page) && $page == 'standardServices')
                                        <span class="text-white">Standard Services</span>
                                    @else
                                        Standard Services
                                    @endif
                                </a>
                                <a class="nav-link" href="{{ route('accountmanager.clients.onlineservices', ['clientId' => $client['id']]) }}">
                                    @if(isset($page) && $page == 'onlineServices')
                                        <span class="text-white">Online Services</span>
                                    @else
                                        Online Services
                                    @endif
                                </a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.fare_reference', ['clientId' => $client['id']]) }}">
                            @if(isset($page) && $page == 'fareReference')
                                <span class="text-white">Fare Reference</span>
                            @else
                                Fare Reference
                            @endif
                        </a>

                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.invoice_attachment', ['clientId' => $client['id']]) }}">
                            @if(isset($page) && $page == 'invoiceAttachment')
                                <span class="text-white">Invoice Attachment</span>
                            @else
                                Invoice Attachment
                            @endif
                        </a>
                    </nav>
                </div>

                <!-- AIR -->
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAir" aria-expanded="false" aria-controls="collapseAir">
                    <div class="sb-nav-link-icon"><i class="fas fa-plane"></i></div>
                    Air
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse bg-secondary" id="collapseAir" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.booking_process', ['clientId' => $client['id'], 'categoryId' => 1]) }}">
                            Booking Process
                        </a>

                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.travel_policy', ['clientId' => $client['id']]) }}">
                            Travel Policy
                        </a>

                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.preferred_airlines', ['clientId' => $client['id']]) }}">
                            Preferred Airlines
                        </a>

                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.travel_security', ['clientId' => $client['id']]) }}">
                            Travel Security
                        </a>
                    </nav>
                </div>
                <!-- HOTEL -->
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHotel" aria-expanded="false" aria-controls="collapseHotel">
                    <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div>
                    Hotel
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse bg-secondary" id="collapseHotel" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.booking_process', ['clientId' => $client['id'], 'categoryId' => 2]) }}">
                            Booking Process
                        </a>

                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.hotel_corporate_code', ['clientId' => $client['id']]) }}">
                            Hotel Corporate Code
                        </a>
                    </nav>
                </div>
                <!-- CAR -->
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCar" aria-expanded="false" aria-controls="collapseCar">
                    <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                    Car
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse bg-secondary" id="collapseCar" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.booking_process', ['clientId' => $client['id'], 'categoryId' => 3]) }}">
                            Booking Process
                        </a>
                    </nav>
                </div>
                <!-- CAR TRANSFER -->
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCarTransfer" aria-expanded="false" aria-controls="collapseCarTransfer">
                    <div class="sb-nav-link-icon"><i class="fas fa-shuttle-van"></i></div>
                    Car Transfer
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse bg-secondary" id="collapseCarTransfer" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.booking_process', ['clientId' => $client['id'], 'categoryId' => 4]) }}">
                            Booking Process
                        </a>
                    </nav>
                </div>
                <!-- DOCUMENTATION -->
                <a class="nav-link" href="#bottom" data-bs-toggle="collapse" data-bs-target="#collapseDocumentation" aria-expanded="false" aria-controls="collapseDocumentation">
                    <div class="sb-nav-link-icon"><i class="fas fa-passport"></i></div>
                    Documentation
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse bg-secondary" id="collapseDocumentation" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="{{ route('accountmanager.clients.booking_process', ['clientId' => $client['id'], 'categoryId' => 5]) }}">
                            Booking Process
                        </a>
                    </nav>
                </div>

                <a class="nav-link marsman-bg-color-semidark" href="{{ route('accountmanager.clients.reporting_elements', ['clientId' => $client['id']]) }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Reporting Elements
                </a>
            @endif
        </div>
    </div>

    <div class="sb-sidenav-footer marsman-border-t-secondary-3 marsman-bg-color-secondary">
        <div class="small txt-semidark">Logged in as:</div>
        <strong class="txt-dark">{{ Auth::user()->name }}</strong>
        @if (isset($lastLoginDate))
            <div class="txt-semidark">Time logged: {{ $lastLoginDate }}</div>
         @endif
    </div>
</nav>

<script>
    $(document).ready(function(){

        // Function to scroll to the last visible item in the submenu
        function scrollToLastVisibleSubmenuItem(submenu) {
            var lastVisibleSubmenuItem = $(submenu).find('.nav-link:visible:last');

            if (lastVisibleSubmenuItem.length) {
                // If there is a visible submenu item, scroll to the last visible item
                var menuDiv = document.getElementById('menuDiv');
                menuDiv.scrollTop = lastVisibleSubmenuItem[0].offsetTop;
            }
        }

        // Check the current page and adjust the collapse behavior
        @if(isset($page))
            var page = '{{ $page }}';
            // If on "Standard Services" or "Online Services", expand the "Summary of Fees" submenu
            if (['standardServices', 'onlineServices'].includes(page)) {
                $('#collapsePricingAndFinancial').collapse('show');
                $('#collapseSummaryOfFees').collapse('show');
                scrollToLastVisibleSubmenuItem(this);
            } else if (['fareReference', 'invoiceAttachment'].includes(page)) {
                $('#collapsePricingAndFinancial').collapse('show');
                scrollToLastVisibleSubmenuItem(this);
            } else {
                // Ensure that it is collapsed on other pages
                $('#collapsePricingAndFinancial').collapse('hide');
                $('#collapseSummaryOfFees').collapse('hide');
            }
        @endif

    });
</script>

<a name="bottom" id="bottom"></a>

