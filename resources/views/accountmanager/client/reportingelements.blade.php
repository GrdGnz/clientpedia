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
                
                <p class="h3">REPORTING ELEMENTS - {{ $client['name'] }}</p>
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

                <table id="reportingElementsTable" class="table table-bordered table-striped">
                    <thead class="marsman-bg-color-dark text-white">
                        <tr>
                            <th width="10%">Code</th>
                            <th>Description</th>
                            <th width="10%">Action 1</th>
                            <th width="10%">Action 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elements as $element)
                            <tr>
                                <td>
                                    {{ $element->report_code }}
                                </td>
                                <td class="no-datatables">
                                    {{ $element->description }}<br />
                                    <input type="text" class="form-control txt-1" value="{{ $element->description }}" oninput="document.getElementById('description_{{ $element->id }}').value = this.value" />
                                </td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('accountmanager.client.reporting_elements.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="elementId" value="{{ $element->id }}" />
                                        <input type="hidden" id="description_{{ $element->id }}" name="description" value="" />
                                        <input type="submit" class="btn btn-primary txt-1" value="Update" />
                                    </form> 
                                </td>
                                <td>
                                    <form method="post" action="{{ route('accountmanager.client.reporting_elements.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="elementId" value="{{ $element->id }}" />
                                        <input type="submit" class="btn btn-danger txt-1" value="Delete" />
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="card mt-3">
                    <div class="card-header marsman-bg-color-dark text-white">
                        <p class="h4">Add Reporting Element</p>
                    </div>
                    <div class="card-body marsman-bg-color-lightblue">
                        <form method="post" action="{{ route('accountmanager.client.reporting_elements.create') }}">
                            @csrf
                            <input type="hidden" value="{{ $client['id'] }}" name="clientId" />
                            <table class="table">
                                <tr>
                                    <td width="10%">
                                        <div class="form-group mb-2">
                                            <label class="label marsman-bg-color-dark text-white p-2 m-0 rounded-top" for="reportCode">Report Code</label>
                                            <input type="text" name="reportCode" class="form-control marsman-border-primary-1 txt-1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-2">
                                            <label class="label marsman-bg-color-dark text-white p-2 m-0 rounded-top" for="description">Description</label>
                                            <input type="text" name="description" class="form-control marsman-border-primary-1 txt-1" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button type="submit" class="btn marsman-btn-primary">Save</button>
                                    </td>
                                </tr>
                            </table>
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
        $('#reportingElementsTable').DataTable({
            "pageLength": 10, // Number of items per page
            "pagingType": "simple_numbers", // Type of pagination
            "lengthMenu": [10, 20, 30, 40], // Dropdown for changing items per page
        });
    });
</script>
@endsection