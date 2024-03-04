<!-- administrator.dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    @include('layouts.topbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('administrator.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main class="p-4">
                <div class="card rounded">
                    <div class="card-headeer marsman-bg-color-dark text-white">
                        <p class="h4 m-3">Clients</p>
                    </div>
                    <div class="card-body">

                        <table id="clientsTable" class="table table-striped table-bordered">
                                <thead class="marsman-bg-color-dark text-white">
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Account Manager</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->code }}</td>
                                            <td>{{ strtoupper($client->name) }}</td>
                                            <td>{{ $client->accountmanager->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>

                    </div>

                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clientsTable').DataTable({
                "pageLength": 10, // Number of items per page
                "pagingType": "simple_numbers", // Type of pagination
                "lengthMenu": [10, 20, 30, 40], // Dropdown for changing items per page
            });
        });
    </script>

@endsection
