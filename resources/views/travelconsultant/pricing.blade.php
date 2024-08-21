@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      @include('travelconsultant.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
          <div class="w-100 my-3">
              <a class="btn marsman-btn-secondary marsman-border-primary-1 txt-1" href="{{ route('travelconsultant.dashboard') }}">Back to Assigned Clients</a>
          </div>

            <p class="h3">PRICING & FINANCIAL - {{ $client['name'] }}</p>
            <hr class="w-100" />

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link txt-2 active" id="pricingmodel-tab" data-bs-toggle="tab" data-bs-target="#pricingmodel-tab-pane" type="button" role="tab" aria-controls="pricingmodel-tab-pane" aria-selected="true">Summary of Fees</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link txt-2" id="farereference-tab" data-bs-toggle="tab" data-bs-target="#farereference-tab-pane" type="button" role="tab" aria-controls="farereference-tab-pane" aria-selected="false">Fare Reference</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link txt-2" id="invoice-tab" data-bs-toggle="tab" data-bs-target="#invoice-tab-pane" type="button" role="tab" aria-controls="invoice-tab-pane" aria-selected="false">Invoice Attachment</button>
              </li>
            </ul>
            <div class="tab-content py-3 p-3" id="myTabContent">
              <div class="tab-pane fade show active" id="pricingmodel-tab-pane" role="tabpanel" aria-labelledby="pricingmodel-tab" tabindex="0">
                <!-- First tab -->

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link txt-2 active" id="standard-tab" data-bs-toggle="tab" data-bs-target="#standard-tab-pane" type="button" role="tab" aria-controls="standard-tab-pane" aria-selected="true">Standard Services</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link txt-2" id="online-tab" data-bs-toggle="tab" data-bs-target="#online-tab-pane" type="button" role="tab" aria-controls="online-tab-pane" aria-selected="false">Online Services</button>
                    </li>
                </ul>

                <hr class="w-100">

                <div class="tab-content py-3 p-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="standard-tab-pane" role="tabpanel" aria-labelledby="standard-tab" tabindex="0">

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
                            <tbody>
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
                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane fade show active" id="online-tab-pane" role="tabpanel" aria-labelledby="online-tab" tabindex="0">



                    </div>
                </div>

                <!-- First tab end -->

              </div>
              <div class="tab-pane fade" id="farereference-tab-pane" role="tabpanel" aria-labelledby="farereference-tab" tabindex="0">
                <!-- Second tab -->

                <table id="pricingModelTable" class="table table-bordered">
                    <thead class="marsman-bg-color-dark text-white">
                        <tr>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Definition</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($clientFareReferences as $clientFareReference)
                            <tr>
                                <td>{{ strtoupper($clientFareReference->code) }}</td>
                                <td>{{ strtoupper($clientFareReference->description) }}</td>
                                <td>{{ strtoupper($clientFareReference->definition) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Second tab end -->

            </div>

            <div class="tab-pane fade" id="arcillariesfee-tab-pane" role="tabpanel" aria-labelledby="arcillariesfee-tab" tabindex="0">
                <!-- Fourth tab -->

                <table id="ancilliaryFeesTable" class="table table-bordered">
                    <thead class="marsman-bg-color-dark text-white">
                        <tr>
                            <th width="60%">Description</th>
                            <th width="20%">Currency Code</th>
                            <th width="20%">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($clientAncilliaryFees as $clientAncilliaryFee)
                            <tr>
                                <td>{{ strtoupper($clientAncilliaryFee->description) }}</td>
                                <td>{{ strtoupper($clientAncilliaryFee->currency_code) }}</td>
                                <td>{{ number_format($clientAncilliaryFee->amount, 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Fourth tab end -->

            </div>
            <div class="tab-pane fade" id="fees-tab-pane" role="tabpanel" aria-labelledby="fees-tab" tabindex="0">
                <!-- Fifth tab -->

                <div class="table-responsive">
                    <table id="ancilliaryFeesTable" class="table table-bordered">
                        <thead class="marsman-bg-color-dark text-white">
                            <tr>
                                <th>Category</th>
                                <th>Route</th>
                                <th>Route Type</th>
                                <th>Description</th>
                                <th>Source</th>
                                <th>Currency</th>
                                <th>Amount</th>
                                <th>Percentage</th>
                                <th>VAT</th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                          @foreach($clientFeesWithRouteAndSource as $clientFee)
                            <tr>
                                <td>{{ strtoupper($clientFee->category->name) }}</td>
                                <td>{{ strtoupper($clientFee->route) }}</td>
                                <td>{{ strtoupper($clientFee->routeType->name) }}</td>
                                <td>{{ strtoupper($clientFee->description) }}</td>
                                <td>{{ strtoupper($clientFee->source) }}</td>
                                <td>{{ strtoupper($clientFee->currency) }}</td>
                                <td>
                                    @if($clientFee->currency == 'PHP')
                                        {{ __('₱') }}
                                    @else
                                        {{ __('$') }}
                                    @endif
                                    {{ number_format($clientFee->amount, 2, '.', ',') }}
                                </td>
                                <td>{{ $clientFee->percentage }}</td>
                                <td>
                                    @if($clientFee->vat == 1)
                                        {{ __('Yes') }}
                                    @else
                                        {{ __('No') }}
                                    @endif
                                </td>
                                <td>{{ strtoupper($clientFee->unit->name) }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Fifth tab end -->

              </div>
              <div class="tab-pane fade" id="invoice-tab-pane" role="tabpanel" aria-labelledby="invoice-tab" tabindex="0">
                <!-- Sixth tab -->

                @if(isset($clientInvoiceAttachments) && count($clientInvoiceAttachments) > 0)
                  @foreach($clientInvoiceAttachments as $attachment)
                    <table class="table table-bordered">
                        <tbody class="bg-white">

                            <tr>
                                <td class="fw-bold" width="20%">Schedule: </td>
                                <td>{{ $attachment->schedule }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="fw-bold">Documents needed:</td>
                            </tr>

                            @if ($attachment->description_path != '')
                            <tr>
                                <td class="fw-bold">Description: </td>
                                <td><a href="{{ asset('attachments/' . basename($attachment->description_path)) }}" target="_blank">Download file</a></td>
                            </tr>
                            @endif

                            @if ($attachment->email_approval_path != '')
                            <tr>
                                <td class="fw-bold">Email approval: </td>
                                <td><a href="{{ asset('attachments/' . basename($attachment->email_approval_path)) }}" target="_blank">Download file</a></td>
                            </tr>
                            @endif

                            @if ($attachment->purchase_order_path != '')
                            <tr>
                                <td class="fw-bold">Purchase order: </td>
                                <td><a href="{{ asset('attachments/' . basename($attachment->purchase_order_path)) }}" target="_blank">Download file</a></td>
                            </tr>
                            @endif

                            <tr>
                                <td class="fw-bold">Remarks:</td>
                                <td>{{ $attachment->remarks }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                            </tr>

                        </tbody>
                    </table>
                    <br />
                    <br />
                  @endforeach
                @endif

                <!-- Sixth tab end -->

              </div>
            </div>
        </main>
    </div>
@endsection
