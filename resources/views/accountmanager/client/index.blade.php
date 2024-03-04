@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        
        @include('accountmanager.sidebar')

    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">

            <h3 class="mb-4">Clients</h3>
            <hr class="w-100" />

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

            <div class="table-responsive">
                <table id="clients-table" class="table table-striped table-bordered">
                    <thead class="marsman-bg-color-dark text-white">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">Status</th>
                            <th scope="col">Change Status</th> {{-- New column for the status change form --}}
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td class="marsman-select-client txt-1" onclick="redirectToLink(this)">
                                <a href="{{ route('accountmanager.clients.show', $client) }}">{{ $client->name }}</a>
                            </td>
                            <td class="txt-1">{{ $client->code }}</td>
                            <td class="text-center txt-1">
                                @if ($client->status_id === 1)
                                <span class="badge rounded-pill bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <form action="{{ route('accountmanager.clients.toggleStatus', ['clientId' => $client->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT') <!-- Use PUT method -->
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_id" id="status_active{{ $client->id }}" value="1" {{ $client->status_id === 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_active{{ $client->id }}">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_id" id="status_inactive{{ $client->id }}" value="0" {{ $client->status_id === 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_inactive{{ $client->id }}">Inactive</label>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-sm rounded txt-1 m-1">Update</button>
                                </form>
                                
                            </td>
                            <td>
                                <a href="{{ route('accountmanager.clients.edit', ['clientId' => $client->id]) }}" class="btn btn-primary btn-sm rounded txt-1 m-1">Edit</a>
                                <!--<a href="{{ route('accountmanager.clients.confirmDelete', ['clientId' => $client->id]) }}" class="btn btn-danger btn-sm rounded txt-1 m-1">Delete</a> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </main>
    </div>
</div>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>   

<script>
    //make the div redirect when clicked
    function redirectToLink(clickedDiv) {
        var link = clickedDiv.querySelector('a');
        if (link) {
            var linkURL = link.getAttribute('href');
            window.location.href = linkURL;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#clients-table').DataTable({
            "pageLength": 10, // Number of items per page
            "pagingType": "simple_numbers", // Type of pagination
            "lengthMenu": [10, 20, 30, 40], // Dropdown for changing items per page
        });
    });
</script>

@endsection
