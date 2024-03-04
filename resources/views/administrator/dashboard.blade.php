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
                        <p class="h4 m-3">Users</p>
                    </div>
                    <div class="card-body">

                        <table id="usersTable" class="table table-striped table-bordered">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</td>
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
            $('#usersTable').DataTable({
                "pageLength": 10, // Number of items per page
                "pagingType": "simple_numbers", // Type of pagination
                "lengthMenu": [10, 20, 30, 40], // Dropdown for changing items per page
            });
        });
    </script>

@endsection
