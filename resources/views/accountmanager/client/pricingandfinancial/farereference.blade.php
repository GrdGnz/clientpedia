@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('accountmanager.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <div class="w-100 my-3">
                <a class="btn marsman-btn-secondary marsman-border-primary-1 txt-1" href="{{ route('accountmanager.clients.index') }}">Back to Client List</a>
            </div>

            <div class="h3">FARE REFERENCE - {{ $client['name'] }}</div>
            <hr class="w-100" />

            <table id="fareReferenceTable" class="table table-striped table-bordered">
                <thead class="marsman-bg-color-dark text-white">
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Definition</th>
                       
                        <th>Action 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientFareReferences as $clientFareReference)
                        <tr>
                            <td>{{ strtoupper($clientFareReference->code) }}</td>
                            <td>{{ strtoupper($clientFareReference->description) }}</td>
                            <td>{{ strtoupper($clientFareReference->definition) }}</td>
                            <!-- Inside the <td> of the "Actions" column in the table -->
                           
                            <td>
                                <form method="POST" action="{{ route('accountmanager.client.fare_reference.delete', $clientFareReference->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="w-100" />

            <div class="card">

                <div class="card-header marsman-bg-color-dark">
                    <p class="h4 text-white py-2">Add Fare Reference</p>
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

                    <form method="POST" action="{{ route('accountmanager.client.fare_reference.create') }}" id="fareReferenceForm">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $clientId }}">
                        <input type="hidden" name="fare_reference_id" id="fare_reference_id">
                    
                        <div class="form-group mb-3">
                            <label for="code" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Code:</label>
                            <input type="text" name="code" id="code" class="form-control marsman-border-primary-1 bg-white" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Description:</label>
                            <input type="text" name="description" id="description" class="form-control marsman-border-primary-1 bg-white" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="definition" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Definition:</label>
                            <textarea name="definition" id="definition" class="form-control marsman-border-primary-1 bg-white" rows="4" required></textarea>
                        </div>

                        <div class="w-100 text-center">
                            <button type="submit" id="saveOrUpdateBtn" class="btn marsman-btn-primary m-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Edit button click event
    $(".edit-btn").click(function() {
        var id = $(this).data("id");
        var code = $(this).data("code");
        var description = $(this).data("description");
        var definition = $(this).data("definition");

        $("#fare_reference_id").val(id);
        $("#code").val(code);
        $("#description").val(description);
        $("#definition").val(definition);

        $("#saveOrUpdateBtn").text("Update");
    });
</script>

@endsection
