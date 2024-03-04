@extends('layouts.app')

@section('content')
    @include('layouts.topbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('administrator.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main class="p-3">
                <p class="h3">Assign Clients to Travel Consultant</p>
                <hr class="w-100" />

                <div class="p-3 marsman-bg-color-lightblue rounded">

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

                    <form method="post" action="{{ route('administrator.user_client.create') }}">
                        @csrf
                        <!-- Select Account Manager
                        <div class="form-group mt-3">
                            <label for="account_manager" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Select Account Manager</label>
                            <select class="form-control marsman-border-primary-1 txt-1" id="account_manager" name="account_manager">
                                <option value="0" selected>--------</option>
                                @foreach($accountManagers as $accountManager)
                                    <option value="{{ $accountManager->id }}">{{ $accountManager->name }}</option>
                                @endforeach
                            </select>
                        </div>-->

                        <!-- Unassigned Clients -->
                        <div class="form-group mt-3">
                            <label for="unassigned_clients_select" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Unassigned Clients</label>
                            <select multiple class="form-control marsman-border-primary-1 txt-1" id="unassigned_clients_select" name="unassigned_clients_select[]" required>
                                @foreach ($unassignedClients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Assign to Travel Consultant -->
                        <div class="form-group mt-3">
                            <label for="travel_consultant" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Assign to Travel Consultant</label>
                            <select class="form-control marsman-border-primary-1 txt-1" id="travel_consultant" name="travel_consultant">
                                <option selected>------</option>
                                @foreach($travelConsultants as $consultant)
                                    <option value="{{ $consultant->id }}">{{ $consultant->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Save Button -->
                        <button type="submit" class="btn marsman-btn-primary mt-3">Save</button>
                    </form>

                </div>
            </main>
        </div>
    </div>

    <style>
        #unassigned_clients_select {
            height: 270px;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#account_manager').change(function () {
                var accountManagerId = $(this).val();

                // Make an AJAX request to get unassigned clients
                $.get('{{ url("/administrator/get-unassigned-clients/") }}/' + accountManagerId, function (data) {
                    console.log('Data:', data);

                    // Populate the 'unassigned_clients_select' multiselect
                    var unassignedClients = $('#unassigned_clients_select');
                    unassignedClients.empty();

                    $.each(data, function (index, client) {
                        var option = $('<option>', {
                            value: client.id,
                            text: client.name // Adjust this based on your client data
                        });

                        // Check if the client_id should be removed
                        if (client.shouldRemove) {
                            option.prop('selected', false); // Remove the client_id from the selection
                        }

                        unassignedClients.append(option);
                    });
                });
            });
        });
    </script>

@endsection
