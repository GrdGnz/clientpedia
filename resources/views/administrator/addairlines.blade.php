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
               
                <p class="h3">Add Airline</p>
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

                <table id="airlineTable" class="table table-bordered table-striped">
                    <thead class="marsman-bg-color-dark text-white">
                        <tr>
                            <th>Airline Code</th>
                            <th>Airline Name</th>
                            <th width="10%">Action 1</th>
                            <th width="10%">Action 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airlines as $airline)
                        <tr>
                            <form method="post" action="{{ route('administrator.airline.update') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $airline->id }}" />
                                <td>{{ strtoupper($airline->code) }} - <input type="text" name="code" value="{{ strtoupper($airline->code) }}" /></td>
                                <td>{{ ucfirst($airline->name) }} - <input type="text" name="name" value="{{ ucfirst($airline->name) }}" /></td>
                                <td class="text-center">
                                    <button type="submit" class="btn btn-primary txt-1">Update</button>
                                </td>
                            </form>
                            <td class="text-center">
                                <form method="post" action="{{ route('administrator.airline.destroy') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $airline->id }}" />
                                <button type="submit" class="btn btn-danger txt-1">Delete</button>
                                </form>
                            </td>
                        </tr> 
                        @endforeach
                        
                    </tbody>
                </table>

                <div class="card p-2 m-2 w-100">
                    <div class="card-header marsman-bg-color-dark text-white">
                        <p class="h4">Add Airline</p>
                    </div>
                    <div class="card-body marsman-bg-color-lightblue">
                        <form method="post" action="{{ route('administrator.airline.create') }}">
                            @csrf
                            <div class="form-group my-2">
                                <label class="label marsman-bg-color-dark text-white p-2 rounded-top m-0" for="code">Airline Code</label>
                                <input type="text" name="code" id="code" class="form-control marsman-border-primary-1 p-1 w-50" required />
                            </div>
                            <div class="form-group my-2">
                                <label class="label marsman-bg-color-dark text-white p-2 rounded-top m-0" for="name">Airline Name</label>
                                <input type="text" name="name" id="name" class="form-control marsman-border-primary-1 p-1 w-50" required />
                            </div>
                            <div class="form-group my-2">
                                <button type="submit" class="btn marsman-btn-primary txt-1">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>   
    <script>
        $(document).ready(function() {
            $('#airlineTable').DataTable({
                "pageLength": 10, // Number of items per page
                "pagingType": "simple_numbers", // Type of pagination
                "lengthMenu": [10, 20, 30, 40], // Dropdown for changing items per page
            });
        });
    </script>

@endsection
