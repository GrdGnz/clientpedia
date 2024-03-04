@extends('layouts.app')

@section('content')
    @include('layouts.topbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('administrator.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-4">
                    <h3>Activity Log</h3>

                    <div class="table-responsive">
                        <table id="user-activities-table" class="table table-striped table-bordered">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr>
                                    <th>User</th>
                                    <th>User Role</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userActivities as $activity)
                                <tr>
                                    <td>{{ $activity->user->name }}</td>
                                    <td>{{ $activity->user->role->name }}</td>
                                    <td>{{ $activity->action }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($activity->created_at)->format('F j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($activity->created_at)->format('h:i A') }}</td>
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
        $(document).ready(function () {
            $('#user-activities-table').DataTable({
                "paging": true,
                "pageLength": 10, // Set the number of rows per page
                "lengthChange": false, // Disable the option to change page length
                "searching": true, // Enable searching
                "ordering": true, // Enable column sorting
                "info": true, // Show table info summary
            });
        });
    </script>
@endsection
