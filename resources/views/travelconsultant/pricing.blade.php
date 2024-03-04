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
                <button class="nav-link txt-2 active" id="pricingmodel-tab" data-bs-toggle="tab" data-bs-target="#pricingmodel-tab-pane" type="button" role="tab" aria-controls="pricingmodel-tab-pane" aria-selected="true">Pricing Model</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link txt-2" id="farereference-tab" data-bs-toggle="tab" data-bs-target="#farereference-tab-pane" type="button" role="tab" aria-controls="farereference-tab-pane" aria-selected="false">Fare Reference</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link txt-2" id="arcillariesfee-tab" data-bs-toggle="tab" data-bs-target="#arcillariesfee-tab-pane" type="button" role="tab" aria-controls="arcillariesfee-tab-pane" aria-selected="false">Ancillary Fee</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link txt-2" id="fees-tab" data-bs-toggle="tab" data-bs-target="#fees-tab-pane" type="button" role="tab" aria-controls="fees-tab-pane" aria-selected="false">Table of Fees (Per Contract)</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link txt-2" id="invoice-tab" data-bs-toggle="tab" data-bs-target="#invoice-tab-pane" type="button" role="tab" aria-controls="invoice-tab-pane" aria-selected="false">Invoice Attachment</button>
              </li>
            </ul>
            <div class="tab-content py-3 p-3 marsman-bg-color-lightblue" id="myTabContent">
              <div class="tab-pane fade show active" id="pricingmodel-tab-pane" role="tabpanel" aria-labelledby="pricingmodel-tab" tabindex="0">
                <!-- First tab -->
                
                <table id="pricingModelTable" class="table table-bordered">
                  <thead class="marsman-bg-color-dark text-white">
                      <tr>
                          <th>Route Name</th>
                          <th>Pricing Model Type</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white">
                      @foreach($clientPricingModels as $clientPricingModel)
                          <tr>
                              <td>{{ strtoupper($clientPricingModel->route->name) }}</td>
                              <td>{{ strtoupper($clientPricingModel->pricingModelType->name) }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>

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
                              <th>Description</th>
                              <th>Source</th>
                              <th>Amount</th>
                          </tr>
                      </thead>
                      <tbody class="bg-white">
                          @foreach($clientFeesWithRouteAndSource as $clientFee)
                              <tr>
                                  <td>{{ strtoupper($clientFee->category) }}</td>
                                  <td>{{ strtoupper($clientFee->route) }}</td>
                                  <td>{{ strtoupper($clientFee->description) }}</td>
                                  <td>{{ strtoupper($clientFee->source) }}</td>
                                  <td>{{ number_format($clientFee->amount, 2, '.', ',') }}</td>
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
  