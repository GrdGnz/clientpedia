@extends('layouts.app')

@section('content')
    @include('layouts.topbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('administrator.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main class="p-3">
                <p class="h3">Assign Clients To Account Manager</p>
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

                    <form method="post" action="{{ route('administrator.clients.update.accountmanager') }}">
                        @csrf
                        @method('PUT')
                        <!-- Select Account Manager -->
                        <div class="form-group mt-3">
                            <label for="account_manager" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Select Account Manager</label>
                            <select class="form-control marsman-border-primary-1 txt-1" id="account_manager" name="account_manager">
                                <option value="0" selected>--------</option>
                                @foreach($accountManagers as $accountManager)
                                    <option value="{{ $accountManager->id }}">{{ $accountManager->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Unassigned Clients -->
                        <div class="form-group mt-3">
                            <label for="unassigned_clients_select" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Unassigned Clients</label>
                            <select multiple class="form-control marsman-border-primary-1 txt-1" id="unassigned_clients_select" name="unassigned_clients_select[]">

                                <option value=""></option>

                            </select>
                        </div>

                        <!-- Assign to another Account Manager -->
                        <div class="form-group mt-3">
                            <label for="assign_account_manager" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Assign to Account Manager</label>
                            <select class="form-control marsman-border-primary-1 txt-1" id="assign_account_manager" name="assign_account_manager">
                                @foreach($accountManagers as $accountManager)
                                    <option value="{{ $accountManager->id }}">{{ $accountManager->name }}</option>
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

                var xhr = new XMLHttpRequest();
                xhr.open('GET', '{{ url("/administrator/get-unassigned-clients/") }}/' + accountManagerId, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            try {
                                var data = JSON.parse(xhr.responseText);
                                console.log('Data:', data);

                                // Populate the 'unassigned_clients_select' multiselect
                                var unassignedClients = document.getElementById('unassigned_clients_select');
                                unassignedClients.innerHTML = '';

                                data.forEach(client => {
                                    var option = document.createElement('option');
                                    option.value = client.id;
                                    option.textContent = client.name; // Adjust this based on your client data
                                    unassignedClients.appendChild(option);
                                });
                            } catch (e) {
                                console.error('JSON parsing error:', e);
                            }
                        } else {
                            console.error('XHR request failed with status:', xhr.status);
                        }
                    }
                };

                xhr.send();
            });
        });
    </script>

@endsection
