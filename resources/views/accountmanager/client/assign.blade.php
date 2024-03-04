@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('accountmanager.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <div class="card">
                <div class="card-header marsman-bg-color-dark text-white">
                    <h3 class="card-title">Assign Client</h3>
                </div>
                <div class="card-body marsman-bg-color-lightblue">

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

                    <form id="userClientsForm" method="POST" action="{{ route('accountmanager.update.userclients') }}">
                        @csrf

                        <!-- User Selection -->
                        <div class="form-group mb-3">
                            <select id="userSelect" class="form-select" name="user_id">
                                <option value="">Select a Travel Consultant</option>
                                @foreach ($travelConsultants as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Owned Clients Multiselect -->
                        <div class="form-group mb-3">
                            <label for="ownedClients" class="marsman-bg-color-dark text-white p-2 rounded-top">Owned Clients:</label>
                            <select id="ownedClients" class="form-select marsman-border-primary-1" multiple name="owned_clients[]">
                                <!-- Options will be dynamically populated using JavaScript -->
                            </select>
                        </div>

                        <div class="marsman-bg-color-secondary text-center col-md-2 mb-2 p-1 rounded">
                            <span><i class="fas fa-mouse-pointer"></i> Double-click to transfer items</span>
                        </div>

                        <!-- Available Clients Multiselect -->
                        <div class="form-group mb-3">
                            <label for="availableClients" class="marsman-bg-color-dark text-white p-2 rounded-top">Available Clients:</label>
                            <select id="availableClients" class="form-select marsman-border-primary-1" multiple name="available_clients">
                                <!-- Options will be dynamically populated using JavaScript -->
                            </select>
                        </div>

                        <div class="marsman-bg-color-secondary text-center col-md-2 mb-2 p-1 rounded">
                            <span><i class="fas fa-mouse-pointer"></i> Double-click to transfer items</span>
                        </div>

                        <button type="submit" class="btn marsman-btn-primary" id="saveButton">Save</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // JavaScript to populate the multiselects based on user selection
    document.getElementById('userSelect').addEventListener('change', function() {
        // Retrieve the selected user ID
        var selectedUserId = this.value;

        // Make an AJAX request to fetch owned and available clients for the selected user
        //fetch('/account-manager/user-clients-data?user_id=' + selectedUserId)
        fetch('{{ route('accountmanager.client.data') }}?user_id=' + selectedUserId)
            .then(response => response.json())
            .then(data => {

                console.log(data);
                // Populate the 'ownedClients' multiselect
                var ownedClientsSelect = document.getElementById('ownedClients');
                ownedClientsSelect.innerHTML = '';
                data.ownedClients.forEach(clientId => {
                    var option = document.createElement('option');
                    option.value = clientId.id;
                    option.textContent = clientId.name; // Adjust this based on your client data
                    ownedClientsSelect.appendChild(option);
                });

                // Populate the 'availableClients' multiselect
                var availableClientsSelect = document.getElementById('availableClients');
                availableClientsSelect.innerHTML = '';
                data.availableClients.forEach(client => {
                    var option = document.createElement('option');
                    option.value = client.id;
                    option.textContent = client.name; // Adjust this based on your client data
                    availableClientsSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });


        // Add double-click event listeners to both select lists
        const ownedClientsSelect = document.getElementById('ownedClients');
        const availableClientsSelect = document.getElementById('availableClients');

        ownedClientsSelect.addEventListener('dblclick', () => {
            // Move selected options from "Owned Clients" to "Available Clients"
            moveOptions(ownedClientsSelect, availableClientsSelect);
        });

        availableClientsSelect.addEventListener('dblclick', () => {
            // Move selected options from "Available Clients" to "Owned Clients"
            moveOptions(availableClientsSelect, ownedClientsSelect);
        });

        // Helper function to move selected options between select lists
        function moveOptions(sourceSelect, targetSelect) {
            const selectedOptions = Array.from(sourceSelect.selectedOptions);
            selectedOptions.forEach(option => {
                targetSelect.appendChild(option);

                console.log(selectedOptions);
            });
        }


        // Add an event listener for the "Save" button
        document.getElementById('saveButton').addEventListener('click', function () {
            const ownedClientsSelect = document.getElementById('ownedClients');

            // Select all items in the "Owned Clients" select list
            for (let i = 0; i < ownedClientsSelect.options.length; i++) {
                ownedClientsSelect.options[i].selected = true;
            }
        });

    });

    // Function to reset the "User" select element
    function resetUserSelect() {
        const userSelect = document.getElementById('userSelect');
        userSelect.value = ''; // Reset to the default (no value) option
    }

    // Check if the page is being refreshed
    const navigationEntries = performance.getEntriesByType("navigation");
    if (navigationEntries.length > 0 && navigationEntries[0].type === "reload") {
        // Page is being refreshed, so reset the "User" dropdown
        resetUserSelect();
    }
</script>

@endsection
