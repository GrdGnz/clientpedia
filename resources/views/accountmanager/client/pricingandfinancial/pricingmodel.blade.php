@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('accountmanager.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <div class="w-100 my-3">
                <a class="btn marsman-btn-secondary marsman-border-primary-1 txt-1" href="{{ route('accountmanager.clients.index') }}">Back to Client List</a>
            </div>

            <div class="h3">PRICING MODEL - {{ $client['name'] }}</div>
            <hr class="w-100" />

            <p class="h5">Standard Schedule of Fees</p>

            <table class="table table-bordered">
                <thead class="marsman-bg-color-primary text-white txt-2">
                    <tr>
                        <th>Services</th>
                        <th>Measure</th>
                        <th>Currency</th>
                        <th>Standard Office Hours</th>
                        <th>After Office Hours</th>
                    </tr>
                </thead>
                    <tr>
                        <td colspan="5" class="text-center marsman-bg-color-darkgray txt-2">STANDALONE TICKETING AND RELATED SERVICES</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="marsman-bg-color-lightgray txt-2">Domestic Travel:</td>
                    </tr>
                    <tr>
                        <td>GDS Booking</td>
                        <td class="text-center">per ticket</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">500</td>
                        <td class="text-center">800</td>
                    </tr>
                    <tr>
                        <td>Non-GDS / Online Ticket Purchase</td>
                        <td class="text-center">per ticket</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">600</td>
                        <td class="text-center">900</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="marsman-bg-color-lightgray txt-2">International Travel:</td>
                    </tr>
                    <tr>
                        <td>GDS Booking Short Haul</td>
                        <td class="text-center">per ticket</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">1800</td>
                        <td class="text-center">2100</td>
                    </tr>
                    <tr>
                        <td>GDS Booking Long Haul /  Online Ticket Purchase</td>
                        <td class="text-center">per ticket</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">2000</td>
                        <td class="text-center">2300</td>
                    </tr>
                    <tr>
                        <td>Itinerary for Visa Purpose only (w/o ticket)</td>
                        <td class="text-center">per itinerary</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">500</td>
                        <td class="text-center">800</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="marsman-bg-color-lightgray txt-2">Ticket Changes:</td>
                    </tr>
                    <tr>
                        <td>Rebooking & Reissuance of ticket / itinerary</td>
                        <td class="text-center">per transaction</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">As new transaction</td>
                        <td class="text-center">As new transaction</td>
                    </tr>
                    <tr>
                        <td>Refund Processing (Domestic)</td>
                        <td class="text-center">per ticket</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">500</td>
                        <td class="text-center">n/a</td>
                    </tr>
                    <tr>
                        <td>Refund Processing (International)</td>
                        <td class="text-center">per ticket</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">1800</td>
                        <td class="text-center">n/a</td>
                    </tr>
                    <tr>
                        <td>Same day cancellation / Voiding (Domestic)<br>Up to 3pm only & depending on the ticket restrictions</td>
                        <td class="text-center">per ticket</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">500</td>
                        <td class="text-center">n/a</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center marsman-bg-color-darkgray txt-2">HOTEL, CAR & TRAVEL INSURANCE</td>
                    </tr>
                    <tr>
                        <td>Hotel Booking for Visa Application (w/o ticket)</td>
                        <td class="text-center">per itinerary</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">500</td>
                        <td class="text-center">750</td>
                    </tr>
                    <tr>
                        <td>Hotel/Car via GDS</td>
                        <td class="text-center">per room / car</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">700</td>
                        <td class="text-center">950</td>
                    </tr>
                    <tr>
                        <td>Hotel/Car via non-GDS</td>
                        <td class="text-center">per room / car</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">800</td>
                        <td class="text-center">1050</td>
                    </tr>
                    <tr>
                        <td>Travel Insurance only (without ticket)</td>
                        <td class="text-center">per policy</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">300</td>
                        <td class="text-center">550</td>
                    </tr>
                    <tr>
                        <td>Travel Insurance (with ticket)</td>
                        <td class="text-center">per policy</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">Included</td>
                        <td class="text-center">300</td>
                    </tr>
                    <tr>
                        <td>Bill Back</td>
                        <td class="text-center">per transaction</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">2% of total cost but not lower than 1000</td>
                        <td class="text-center">2% of total cost but not lower than 1000</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center marsman-bg-color-darkgray txt-2">TRAVEL DOCUMENTATION - VISA</td>
                    </tr>
                    <tr>
                        <td>Visa Application</td>
                        <td class="text-center">per transaction</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">2000</td>
                        <td class="text-center">n/a</td>
                    </tr>
                    <tr>
                        <td>Expedite Visa Filing (surcharge to visa application service fee)</td>
                        <td class="text-center">per transaction</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">2500</td>
                        <td class="text-center">n/a</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center marsman-bg-color-darkgray txt-2">OTHER SERVICES</td>
                    </tr>
                    <tr>
                        <td>Invoice reprint / Certified True Copy of Invoices</td>
                        <td class="text-center">per invoice</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">300</td>
                        <td class="text-center">n/a</td>
                    </tr>
                    <tr>
                        <td>Additional Baggage</td>
                        <td class="text-center">per pax</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">500</td>
                        <td class="text-center">800</td>
                    </tr>
                    <tr>
                        <td>Choice Seat Arrangement</td>
                        <td class="text-center">per pax</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">500</td>
                        <td class="text-center">800</td>
                    </tr>
                    <tr>
                        <td>Web Check-in</td>
                        <td class="text-center">per pax</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">500</td>
                        <td class="text-center">800</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center marsman-bg-color-darkgray txt-2">VIP SERVICES</td>
                    </tr>
                    <tr>
                        <td>Booking of airport assistance in Metro Manila (on top of the actual cost of airport representatives)</td>
                        <td class="text-center">per pax / representative</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">1900</td>
                        <td class="text-center">2200</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center marsman-bg-color-darkgray txt-2">ADHOC SERVICES</td>
                    </tr>
                    <tr>
                        <td>Assistance in Meetings, Group & Events (Booking of Venue/Activities/others)</td>
                        <td class="text-center">per service agreement</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">Separate Service Agreement <br>& Endorsed to respective department</td>
                        <td class="text-center">Separate Service Agreement <br>& Endorsed to respective department</td>
                    </tr>
                    <tr>
                        <td>Cultural Assimilation Tours for Expats</td>
                        <td class="text-center">per service agreement</td>
                        <td class="text-center">PHP</td>
                        <td class="text-center">Separate Service Agreement <br>& Endorsed to respective department</td>
                        <td class="text-center">Separate Service Agreement <br>& Endorsed to respective department</td>
                    </tr>
                <tbody>

                </tbody>
            </table>
        </main>
    </div>
</div>
@endsection
