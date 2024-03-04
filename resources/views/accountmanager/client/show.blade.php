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
                        <span class="align-middle h3">{{ $client['name'] }}</span>
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
                            <tr>
                                <th class="marsman-bg-color-semidark text-white" width="150">Client Code</th>
                                <td class="bg-white border">
                                    {{ $client->code }}
                                </td>
                            </tr>
                            <tr>
                                <th class="marsman-bg-color-semidark text-white">Client Type</th>
                                <td class="bg-white border">
                                    <select name="clientType" class="form-control txt-1">
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
                                </td>
                            </tr>
                            <tr>
                                <th class="marsman-bg-color-semidark text-white">Global Customer No.</th>
                                <td class="bg-white border">
                                    <input type="text" name="globalCustomerNumber" class="form-control txt-1" value="{{ isset($client->info->global_customer_number) ? $client->info->global_customer_number : '' }}" />
                                </td>
                            </tr>
                            <tr>
                                <th class="marsman-bg-color-semidark text-white">Contract Start Date</th>
                                <td class="bg-white border">
                                    <input type="text" name="contractStartDate" class="form-control txt-1 datepicker" value="{{ isset($client->info->contract_start_date) ? \Carbon\Carbon::parse($client->info->contract_start_date)->format('Y-m-d') : '' }}" />
                                </td>
                            </tr>
                            <tr>
                                <th class="marsman-bg-color-semidark text-white">Contract End Date</th>
                                <td class="bg-white border">
                                    <input type="text" name="contractEndDate" class="form-control txt-1 datepicker" value="{{ isset($client->info->contract_end_date) ? \Carbon\Carbon::parse($client->info->contract_end_date)->format('Y-m-d') : '' }}" />
                                </td>
                            </tr>
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
