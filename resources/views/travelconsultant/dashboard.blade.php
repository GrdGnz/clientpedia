@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        
        @include('travelconsultant.sidebar')

    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">

            <p class="h3">Assigned Clients</p>
            <hr class="w-100" />

            <table id="clientsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Client Name</td>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($clients))
                    @foreach ($clients as $client)
                        <tr>
                            <td class="marsman-select-client" align="center" onclick="redirectToLink(this)">
                                <a class="text-decoration-none txt-3" href="{{ route('travelconsultant.basic_info', ['clientId' => $client->id]) }}">
                                    {{ $client->name }}
                                </a>
                                </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            
        </main>
    </div>

    <!-- Include jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> 
    <script>
        $(document).ready(function() {
            $('#clientsTable').DataTable();
        });
        //make the div redirect when clicked
        function redirectToLink(clickedDiv) {
            var link = clickedDiv.querySelector('a');
            if (link) {
                var linkURL = link.getAttribute('href');
                window.location.href = linkURL;
            }
        }
    </script>
@endsection
