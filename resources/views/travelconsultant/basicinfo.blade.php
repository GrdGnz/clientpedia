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

            <div class="container-fluid">
                <h1 class="h3 mb-4">BASIC INFO - {{ $client['name'] }}</h1>
                <div class="card">
                    <div class="card-body">

                        <div class="col-md-12 d-flex">
                            <div class="col-md-4">
                                <!-- Code -->
                                <p class="fs-6"><strong>Code:</strong> {{ $client['code'] }}</p>

                                <!-- Client Type -->
                                @if (isset($clientInfo))
                                    @foreach ($clientInfo as $info)
                                        @if ($info->client_type_id === 1)
                                            <p class="fs-6"><strong>Client Type:</strong> Corporate</p>
                                        @elseif ($info->client_type_id === 2)
                                            <p class="fs-6"><strong>Client Type:</strong> Leisure</p>
                                        @else
                                            <p class="fs-6"><strong>Client Type:</strong> Walk-in</p>
                                        @endif
                                    @endforeach
                                @endif

                                <!-- Global Customer Number -->
                                <p class="fs-6"><strong>Global Customer Number:</strong> {{ $info->global_customer_number }}</p>

                                <!-- Contract Start Date -->
                                <p class="fs-6"><strong>Contract Start Date:</strong> {{ \Carbon\Carbon::parse($info->contract_start_date)->format('F d, Y') }}</p>

                                <!-- Contract End Date -->
                                <p class="fs-6"><strong>Contract End Date:</strong> {{ \Carbon\Carbon::parse($info->contract_end_date)->format('F d, Y') }}</p>
                            </div>

                            <div class="col-md-4">
                                <!-- Credit Term -->
                                <p class="fs-6"><strong>Credit Term:</strong> {{ $info->credit_term }}</p>

                                <!-- Submitted Quotation -->
                                <p class="fs-6"><strong>Number of Quotation to Provide:</strong> {{ $info->submitted_quotation }}</p>

                                <!-- Credit Limit USD -->
                                <p class="fs-6"><strong>Credit Limit USD:</strong> {{ number_format($info->credit_limit_usd) }}</p>

                                <!-- Credit Limit PHP -->
                                <p class="fs-6"><strong>Credit Limit PHP:</strong> {{ number_format($info->credit_limit_php) }}</p>

                                <!-- SLA Response Time International -->
                                <p class="fs-6"><strong>SLA Response Time International:</strong> {{ $info->sla_response_time_int }}</p>

                                <!-- SLA Response Time Domestic -->
                                <p class="fs-6"><strong>SLA Response Time Domestic:</strong> {{ $info->sla_response_time_dom }}</p>
                            </div>

                            <div class="col-md-4">
                                <!-- Billing Currency -->
                                <p class="fs-6"><strong>Billing Currency:</strong> {{ $info->billing_currency }}</p>

                                <!-- Value Added Tax -->
                                <p class="fs-6"><strong>Value Added Tax:</strong> {{ $info->value_added_tax }}</p>

                                <!-- Form of Refund -->
                                <p class="fs-6"><strong>Form of Refund:</strong> {{ $info->form_of_refund }}</p>

                                <!-- Reports Deadline -->
                                <p class="fs-6"><strong>Deadline of submission of reports:</strong> {{ $info->reports_deadline }}</p>
                            </div>
                        </div>


                        <form>

                            <div class="mb-3">
                                <label for="officialContactPersons" class="form-label h5">Official Contact Person(s)</label>
                                <div class="table-responsive">
                                    <table id="officialContactPersons" class="table table-bordered w-100">
                                        <thead class="marsman-bg-color-dark text-white">
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Department</th>
                                                <th>Mobile No.</th>
                                                <th>Email</th>
                                                <th>Birthday</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($clientContacts as $contact)
                                                <tr>
                                                    <td>{{ $contact->name }}</td>
                                                    <td>{{ $contact->designation }}</td>
                                                    <td>{{ $contact->department }}</td>
                                                    <td>{{ $contact->contact_mobile }}</td>
                                                    <td>{{ $contact->email }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($contact->birthday)->format('F d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="clientApprovers" class="form-label h5">Official Approver(s)</label>
                                <div class="table-responsive">
                                    <table id="clientApprovers" class="table table-bordered w-100">
                                        <thead class="marsman-bg-color-dark text-white">
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Department</th>
                                                <th>Mobile No.</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($clientApprovers as $approvers)
                                                <tr>
                                                    <td>{{ $approvers->name }}</td>
                                                    <td>{{ $approvers->designation }}</td>
                                                    <td>{{ $approvers->department }}</td>
                                                    <td>{{ $approvers->contact_mobile }}</td>
                                                    <td>{{ $approvers->email }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="clientBookers" class="form-label h5">Official Booker(s)</label>
                                <div class="table-responsive">
                                    <table id="clientBookers" class="table table-bordered w-100">
                                        <thead class="marsman-bg-color-dark text-white">
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Department</th>
                                                <th>Mobile No.</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($clientBookers as $bookers)
                                                <tr>
                                                    <td>{{ $bookers->name }}</td>
                                                    <td>{{ $bookers->designation }}</td>
                                                    <td>{{ $bookers->department }}</td>
                                                    <td>{{ $bookers->contact_mobile }}</td>
                                                    <td>{{ $bookers->email }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
