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
                                @foreach ($standardHeaders as $header)
                                    <tr>
                                        <td colspan="6" class="text-center marsman-bg-color-darkgray txt-2">{{ $header->title }}</td>
                                    </tr>
                                    @foreach ($subheaders as $subheader)
                                        @if ($subheader->header_id == $header->id)
                                            <tr>
                                                <td colspan="6" class="marsman-bg-color-lightgray txt-2">{{ $subheader->title }}</td>
                                            </tr>
                                            @foreach ($services as $service)
                                                @if($service->subheader_id == $subheader->id)
                                                    <tr>
                                                        <td>{{ $service->service_name }}</td>
                                                        <td class="text-center">{{ $service->measure }}</td>
                                                        <td class="text-center">{{ $service->currency }}</td>
                                                        <td class="text-center">{{ $service->office_hours }}</td>
                                                        <td class="text-center">{{ $service->after_office_hours }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                    @foreach ($services as $service)
                                        @if($service->header_id == $header->id)
                                            <tr>
                                                <td>{{ $service->service_name }}</td>
                                                <td class="text-center">{{ $service->measure }}</td>
                                                <td class="text-center">{{ $service->currency }}</td>
                                                <td class="text-center">{{ $service->office_hours }}</td>
                                                <td class="text-center">{{ $service->after_office_hours }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="tab-pane fade show active" id="online-tab-pane" role="tabpanel" aria-labelledby="online-tab" tabindex="0">

                        <p class="h5">Online Schedule of Fees</p>

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
                                @foreach ($onlineHeaders as $header)
                                    <tr>
                                        <td colspan="6" class="text-center marsman-bg-color-darkgray txt-2">{{ $header->title }}</td>
                                    </tr>
                                    @foreach ($subheaders as $subheader)
                                        @if ($subheader->header_id == $header->id)
                                            <tr>
                                                <td colspan="6" class="marsman-bg-color-lightgray txt-2">{{ $subheader->title }}</td>
                                            </tr>
                                            @foreach ($services as $service)
                                                @if($service->subheader_id == $subheader->id)
                                                    <tr>
                                                        <td>{{ $service->service_name }}</td>
                                                        <td class="text-center">{{ $service->measure }}</td>
                                                        <td class="text-center">{{ $service->currency }}</td>
                                                        <td class="text-center">{{ $service->office_hours }}</td>
                                                        <td class="text-center">{{ $service->after_office_hours }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                    @foreach ($services as $service)
                                        @if($service->header_id == $header->id)
                                            <tr>
                                                <td>{{ $service->service_name }}</td>
                                                <td class="text-center">{{ $service->measure }}</td>
                                                <td class="text-center">{{ $service->currency }}</td>
                                                <td class="text-center">{{ $service->office_hours }}</td>
                                                <td class="text-center">{{ $service->after_office_hours }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                @endforeach
                            </tbody>
                        </table>

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
