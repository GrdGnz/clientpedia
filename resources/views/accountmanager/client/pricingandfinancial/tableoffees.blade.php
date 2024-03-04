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
            
            <h3>TABLE OF FEES - {{ $client['name'] }}</h3>
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

            <table id="feesTable" class="table table-striped table-bordered">
                <thead class="marsman-bg-color-dark text-white">
                    <tr>
                        <th width="10%">Category</th>
                        <th width="10%">Route</th>
                        <th>Description</th>
                        <th width="10%">Source</th>
                        <th width="10%">Amount</th>
                        <th width="10%">Amount (Display)</th>
                        <th width="10%">Action 1</th>
                        <th width="10%">Action 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientFeesWithRouteAndSource as $clientFee)
                        <tr>
                            <form method="post" action="{{ route('accountmanager.client.fee.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="fee_id" value="{{ $clientFee->id }}" />
                                <td>{{ ucfirst($clientFee->category) }}<br />
                                    <select name="category_id" class="form-control txt-1">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                @if($clientFee->category_id == $category->id)    
                                                    selected="selectedf"
                                                @endif
                                            >{{ ucfirst($category->name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{ ucfirst($clientFee->route) }}<br />
                                    <select name="route_id" class="form-control txt-1">
                                        @foreach ($routes as $route)
                                            <option value="{{ $route->id }}" 
                                                @if ($clientFee->route_id == $route->id)
                                                    selected="selected"
                                                @endif    
                                            >{{ ucfirst($route->name) }}</option>    
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{ ucfirst($clientFee->description) }}<br />
                                    <textarea name="description" class="form-control txt-1">{{ strtoupper($clientFee->description) }}</textarea>
                                </td>
                                <td>{{ ucfirst($clientFee->source) }}<br />
                                    <select name="source_id" class="form-control txt-1">
                                        @foreach ($sources as $source)
                                            <option value="{{ $source->id }}"
                                                @if ($clientFee->source_id == $source->id)
                                                    selected="selected"
                                                @endif
                                            >{{ ucfirst($source->name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    {{ $clientFee->amount }}<br />
                                    <input type="text" name="amount" value="{{ $clientFee->amount }}" class="form-control txt-1" />
                                </td>
                                <td>{{ number_format($clientFee->amount, 2, '.', ',') }}</td>
                                <td class="text-center"><button type="submit" class="btn btn-primary txt-1">Update</button></td>
                            </form>
                            <form method="post" action="{{ route('accountmanager.client.fee.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="fee_id" value="{{ $clientFee->id }}" />
                                <td class="text-center"><button type="submit" class="btn btn-danger txt-1">Delete</button></td>
                            </form>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>

            <hr class="w-100" />

            <div class="card">
                <div class="card-header marsman-bg-color-dark py-3">
                    <p class="h4 text-white">Add New Fee</p>
                </div>
                <div class="card-body marsman-bg-color-lightblue">

                    <form action="{{ route('accountmanager.client.fee.create') }}" method="POST">
                        @csrf

                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        
                        <div class="form-group mb-3">
                            <label for="category" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Category</label>
                            <select name="category_id" class="form-control marsman-border-primary-1 bg-white txt-1" id="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                @endforeach                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="route_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Route</label>
                            <select name="route_id" class="form-control marsman-border-primary-1 bg-white txt-1" id="route_id">
                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}">{{ ucfirst($route->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Description</label>
                            <input type="text" name="description" class="form-control marsman-border-primary-1 bg-white txt-1" id="description">
                        </div>

                        <div class="form-group mb-3">
                            <label for="source_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Source</label>
                            <select name="source_id" class="form-control marsman-border-primary-1 bg-white txt-1" id="source_id">
                                @foreach($sources as $source)
                                    <option value="{{ $source->id }}">{{ ucfirst($source->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="amount" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Amount</label>
                            <input type="number" step="0.01" name="amount" class="form-control marsman-border-primary-1 bg-white txt-1" id="amount">
                        </div>

                        <button type="submit" class="btn marsman-btn-primary m-2">Save</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> 
<script>
    $(document).ready(function() {
        $('#feesTable').DataTable({
            "pageLength": 10, // Number of items per page
            "pagingType": "simple_numbers", // Type of pagination
            "lengthMenu": [10, 20, 30, 40], // Dropdown for changing items per page
        });
    });
</script>

@endsection
