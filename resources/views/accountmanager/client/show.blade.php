@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('accountmanager.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <div class="container-fluid">

                <div class="w-100 my-3">
                    <a class="btn marsman-btn-secondary marsman-border-primary-1 txt-1" href="{{ route('accountmanager.clients.index') }}">Back to Client List</a>
                </div>

                <div class="card-header marsman-bg-color-dark text-white">
                    @if (isset($client['name']))
                        <span class="align-middle h3">INFO - {{ $client['name'] }}</span>
                    @endif
                </div>

                <div class="card marsman-bg-color-lightblue">
                    <div class="card-body">

                        <div class="txt-3 py-2">Information</div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('accountmanager.clients.info.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="clientInfoId" value="{{ isset($client->info->id) ? $client->info->id : '' }}" />
                            <input type="hidden" name="clientId" value="{{ isset($client['id']) ? $client['id'] : '' }}" />

                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <label for="infoCode" class="form-control txt-1 marsman-bg-color-semidark text-white">Client Code</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input id="infoCode" class="form-control-plaintext txt-1 bg-white p-1" value="{{ $client->code }}" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <label class="form-control txt-1 marsman-bg-color-semidark text-white" width="150">SAP ID</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="text" name="sap_id" class="form-control-plaintext txt-1 bg-white p-1" value="{{ $client->sap_id }}" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="clientType" class="form-control txt-1 marsman-bg-color-semidark text-white">Client Type</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <select id="clientType" name="clientType" class="form-control form-select txt-1 bg-white">
                                                @foreach ($clientTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                        @if(isset($client->info->client_type_id))
                                                            @if ($client->info->client_type_id == $type->id)
                                                                selected="selected"
                                                            @endif
                                                        @endif
                                                    >{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="globalCustomerNumber" class="form-control txt-1 marsman-bg-color-semidark text-white">Global Customer No.</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="text" id="globalCustomerNumber" name="globalCustomerNumber" class="form-control txt-1 bg-white" value="{{ isset($client->info->global_customer_number) ? $client->info->global_customer_number : '' }}" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="contractStartDate" class="form-control txt-1 marsman-bg-color-semidark text-white">Contract Start Date</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="text" id="contractStartDate" name="contractStartDate" class="form-control txt-1 datepicker p-2" value="{{ isset($client->info->contract_start_date) ? \Carbon\Carbon::parse($client->info->contract_start_date)->format('Y-m-d') : '' }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <label for="contractEndDate" class="form-control txt-1 marsman-bg-color-semidark text-white">Contract End Date</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="text" id="contractEndDate" name="contractEndDate" class="form-control txt-1 datepicker p-2" value="{{ isset($client->info->contract_end_date) ? \Carbon\Carbon::parse($client->info->contract_end_date)->format('Y-m-d') : '' }}" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="creditTerm" class="form-control txt-1 marsman-bg-color-semidark text-white">Credit Term</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <select id="creditTerm" name="creditTerm" class="form-control form-select txt-1 d-flex">
                                                <option value="" @if(isset($client->info->credit_term)) @if($client->info->credit_term == '') selected="selected" @endif @endif>-- please select --</option>
                                                <option value="15"  @if(isset($client->info->credit_term)) @if($client->info->credit_term == '15 Day/s') selected="selected" @endif @endif>15 Day/s</option>
                                                <option value="30"  @if(isset($client->info->credit_term)) @if($client->info->credit_term == '30 Day/s') selected="selected" @endif @endif>30 Day/s</option>
                                                <option value="45"  @if(isset($client->info->credit_term)) @if($client->info->credit_term == '45 Day/s') selected="selected" @endif @endif>45 Day/s</option>
                                                <option value="60"  @if(isset($client->info->credit_term)) @if($client->info->credit_term == '60 Days') selected="selected" @endif @endif>60 Day/s</option>
                                                <option value="90"  @if(isset($client->info->credit_term)) @if($client->info->credit_term == '90 Day/s') selected="selected" @endif @endif>90 Day/s</option>
                                                <option value="COD"  @if(isset($client->info->credit_term)) @if($client->info->credit_term == 'COD') selected="selected" @endif @endif>COD</option>
                                                <option value="Credit Card"  @if(isset($client->info->credit_term)) @if($client->info->credit_term == 'Credit Card') selected="selected" @endif @endif>Credit Card</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="submittedQuotation" class="form-control txt-1 marsman-bg-color-semidark text-white">Number of Quotation to Provide</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <select id="submittedQuotation" name="submittedQuotation" class="form-control form-select txt-1">
                                                <option value=""  @if(isset($client->info->submitted_quotation)) @if($client->info->submitted_quotation == '') selected="selected" @endif @endif>-- please select --</option>
                                                <option value="1" @if(isset($client->info->submitted_quotation)) @if($client->info->submitted_quotation == 1) selected="selected" @endif @endif>1</option>
                                                <option value="2" @if(isset($client->info->submitted_quotation)) @if($client->info->submitted_quotation == 2) selected="selected" @endif @endif>2</option>
                                                <option value="3" @if(isset($client->info->submitted_quotation)) @if($client->info->submitted_quotation == 3) selected="selected" @endif @endif>3</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="creditLimitUSD" class="form-control txt-1 marsman-bg-color-semidark text-white">Credit Limit USD</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="text" id="creditLimitUSD" name="creditLimitUSD" class="form-control txt-1" value="{{ isset($client->info->credit_limit_usd) ? $client->info->credit_limit_usd : '' }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <label for="creditLimitPHP" class="form-control txt-1 marsman-bg-color-semidark text-white">Credit Limit PHP</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="text" id="creditLimitPHP" name="creditLimitPHP" class="form-control txt-1" value="{{ isset($client->info->credit_limit_php) ? $client->info->credit_limit_php : '' }}" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="slaResponseTimeInt" class="form-control txt-1 marsman-bg-color-semidark text-white">SLA Response Time International</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="number" id="slaResponseTimeInt" name="slaResponseTimeInt" min="1" max="3" value="{{ isset($client->info->sla_response_time_int) ? $client->info->sla_response_time_int : 0 }}"> Hrs Max
                                        </div>
                                    </td>
                                    <td>
                                        <label for="slaResponseTimeDom" class="form-control txt-1 marsman-bg-color-semidark text-white">SLA Response Time Domestic</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="number" id="slaResponseTimeDom" name="slaResponseTimeDom" min="1" max="3" value="{{ isset($client->info->sla_response_time_dom) ? $client->info->sla_response_time_dom : 0 }}"> Hrs Max
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="billingCurrency" class="form-control txt-1 marsman-bg-color-semidark text-white">Billing Currency</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <select id="billingCurrency" name="billingCurrency" class="form-control form-select txt-1 d-flex">
                                                <option value="" @if(isset($client->info->billing_currency)) @if($client->info->billing_currency == '') selected="selected" @endif @endif>-- please select --</option>
                                                <option value="PHP" @if(isset($client->info->billing_currency)) @if($client->info->billing_currency == 'PHP') selected="selected" @endif @endif>PHP</option>
                                                <option value="USD" @if(isset($client->info->billing_currency)) @if($client->info->billing_currency == 'USD') selected="selected" @endif @endif>USD</option>
                                                <option value="BOTH" @if(isset($client->info->billing_currency)) @if($client->info->billing_currency == 'BOTH') selected="selected" @endif @endif>BOTH</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="valueAddedTax" class="form-control txt-1 marsman-bg-color-semidark text-white">Value Added Tax</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <select id="valueAddedTax" name="valueAddedTax" class="form-control form-select txt-1">
                                                <option value="" @if(isset($client->info->value_added_tax)) @if($client->info->value_added_tax == '') selected="selected" @endif @endif>-- please select --</option>
                                                <option value="VAT" @if(isset($client->info->value_added_tax)) @if($client->info->value_added_tax == 'VAT') selected="selected" @endif @endif>VAT</option>
                                                <option value="VAT EXEMPT" @if(isset($client->info->value_added_tax)) @if($client->info->value_added_tax == 'VAT EXEMPT') selected="selected" @endif @endif>VAT EXEMPT</option>
                                                <option value="ZERO RATE" @if(isset($client->info->value_added_tax)) @if($client->info->value_added_tax == 'ZERO RATE') selected="selected" @endif @endif>ZERO RATE</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="formOfRefund" class="form-control txt-1 marsman-bg-color-semidark text-white">Form of Refund</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <select id="formOfRefund" name="formOfRefund" class="form-control form-select txt-1 d-flex">
                                                <option value="" @if(isset($client->info->form_of_refund)) @if($client->info->form_of_refund == '') selected="selected" @endif @endif>-- please select --</option>
                                                <option value="Credit Note" @if(isset($client->info->form_of_refund)) @if($client->info->form_of_refund == 'Credit Note') selected="selected" @endif @endif>Credit Note</option>
                                                <option value="Check Payment" @if(isset($client->info->form_of_refund)) @if($client->info->form_of_refund == 'Check Payment') selected="selected" @endif @endif>Check Payment</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <label for="reportsDeadline" class="form-control txt-1 marsman-bg-color-semidark text-white">Reports Deadline</label>
                                        <div class="bg-white p-2 rounded-bottom">
                                            <input type="text" id="reportsDeadline" name="reportsDeadline" class="form-control txt-1" value="{{ isset($client->info->reports_deadline) ? $client->info->reports_deadline : '' }}">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="w-100 text-center">
                            <button type="submit" class="btn marsman-btn-primary">Modify Client Info</button>
                        </div>

                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    // Initialize Bootstrap Datepicker
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd', // Adjust the format as needed
            autoclose: true
        });
    });
</script>

@endsection
