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
                <div class="card marsman-bg-color-lightblue">
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="clientCode" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Code</label>
                                <input type="text" value="{{ $client['code'] }}" class="form-control marsman-border-primary-1 bg-white txt-1" id="clientCode" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="clientName" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Name</label>
                                <input type="text" value="{{ $client['name'] }}" class="form-control marsman-border-primary-1 bg-white txt-1" id="clientName" disabled />
                            </div>

                            @if (isset($clientInfo))
                                @foreach ($clientInfo as $info)
                                    <div class="mb-3">
                                        <label for="clientType" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Type</label>
                                        @if ($info['client_type_id'] === 1)
                                            <input type="text" value="Corporate" class="form-control marsman-border-primary-1 bg-white txt-1" id="clientType" disabled />
                                        @elseif ($info['client_type_id' === 2])
                                            <input type="text" value="Leisure" class="form-control marsman-border-primary-1 bg-white txt-1" id="clientType" disabled />
                                        @else
                                            <input type="text" value="Walk-in" class="form-control marsman-border-primary-1 bg-white txt-1" id="clientType" disabled />
                                        @endif
                                    </div>
                            
                                    <div class="mb-3">
                                        <label for="globalCustomerNo" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Global Customer No.</label>
                                        <input type="text" value="{{ $info['global_customer_number'] }}" class="form-control marsman-border-primary-1 bg-white txt-1" id="globalCustomerNo" disabled />
                                    </div>

                                    <div class="mb-3">
                                        <label for="contractStartDate" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Contract Start Date</label>
                                        <input type="text" value="{{ \Carbon\Carbon::parse($info['contract_start_date'])->format('F d, Y') }}" class="form-control marsman-border-primary-1 bg-white txt-1" id="contractStartDate" disabled />
                                    </div>

                                    <div class="mb-3">
                                        <label for="contractEndDate" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Contract End Date</label>
                                        <input type="text" value="{{ \Carbon\Carbon::parse($info['contract_end_date'])->format('F d, Y') }}" class="form-control marsman-border-primary-1 bg-white txt-1" id="contractEndDate" disabled />
                                    </div>
                                @endforeach
                            @endif
                           

                            <div class="mb-3">
                                <label for="officialContactPersons" class="form-label">Official Contact Person(s)</label>
                                <div class="table-responsive">
                                    <table id="officialContactPersons" class="table table-bordered w-100">
                                        <thead class="marsman-bg-color-dark text-white">
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Department</th>
                                                <th>Landline No.</th>
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
                                                    <td>{{ $contact->contact_landline }}</td>
                                                    <td>{{ $contact->contact_mobile }}</td>
                                                    <td>{{ $contact->email }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($contact->birthday)->format('F d, Y') }}</td>
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
