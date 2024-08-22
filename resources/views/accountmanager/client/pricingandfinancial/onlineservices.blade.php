@php
    $page = 'onlineServices';
@endphp

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

            <div class="h3">SUMMARY OF FEES - {{ $client['name'] }}</div>
            <hr class="w-100" />

            <p class="h5">Online Schedule of Fees</p>

            <div class="w-100 d-flex justify-content-end p-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                   Add Service
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Service</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('accountmanager.client.standard_service.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="clientId" id="clientId" value="{{ $clientId }}">
                        <div class="modal-body">
                            <div class="form-group p-1">
                                <label for="headerId" class="txt-1 marsman-bg-color-primary text-white p-2 m-0 rounded-top">Header</label>
                                <select id="headerId" name="headerId" class="form-control form-select txt-1">
                                    <option value="" selected="selected"></option>
                                    @foreach ($headers as $header)
                                        <option value="{{ $header->id }}">{{ $header->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group p-1">
                                <label for="subheaderId" class="txt-1 marsman-bg-color-primary text-white p-2 m-0 rounded-top">Subheader</label>
                                <select id="subheaderId" name="subheaderId" class="form-control form-select txt-1">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="form-group p-1">
                                <label for="services" class="txt-1 marsman-bg-color-primary text-white p-2 m-0 rounded-top">Services</label>
                                <input type="text" id="services" name="services" class="form-control txt-1">
                            </div>
                            <div class="form-group p-1">
                                <label for="measure" class="txt-1 marsman-bg-color-primary text-white p-2 m-0 rounded-top">Measure</label>
                                <input type="text" id="measure" name="measure" class="form-control txt-1">
                            </div>
                            <div class="form-group p-1">
                                <label for="currency" class="txt-1 marsman-bg-color-primary text-white p-2 m-0 rounded-top">Currency</label>
                                <select id="currency" name="currency" class="form-control form-select txt-1">
                                    <option value="PHP">PHP</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                            <div class="form-group p-1">
                                <label for="officeHours" class="txt-1 marsman-bg-color-primary text-white p-2 m-0 rounded-top">Standard Office Hours</label>
                                <input type="text" id="officeHours" name="officeHours" class="form-control txt-1">
                            </div>
                            <div class="form-group p-1">
                                <label for="afterOfficeHours" class="txt-1 marsman-bg-color-primary text-white p-2 m-0 rounded-top">After Office Hours</label>
                                <input type="text" id="afterOfficeHours" name="afterOfficeHours" class="form-control txt-1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>

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

            <table class="table table-bordered">
                <thead class="marsman-bg-color-primary text-white txt-2">
                    <tr>
                        <th class="col-md-4">Services</th>
                        <th>Measure</th>
                        <th>Currency</th>
                        <th>Standard Office Hours</th>
                        <th>After Office Hours</th>
                        <th class="col-md-2">Action</th> <!-- Column for update and delete buttons -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($headers as $header)
                        <tr>
                            <td colspan="6" class="text-center marsman-bg-color-darkgray txt-2">{{ $header->title }}</td>
                        </tr>
                        @foreach ($subheaders as $subheader)
                            @if ($subheader->header_id == $header->id)
                                <tr>
                                    <td colspan="6" class="marsman-bg-color-lightgray txt-2">{{ $subheader->title }}</td>
                                </tr>
                                @foreach ($services as $service)
                                    @if($service->subheader_id == $subheader->id)
                                        <tr>
                                            <form action="{{ route('accountmanager.client.standard_service.update') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="{{ $service->id }}">

                                                <td>
                                                    <input type="text" name="service_name" class="form-control txt-1" value="{{ $service->service_name }}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" name="measure" class="form-control txt-1" value="{{ $service->measure }}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" name="currency" class="form-control txt-1" value="{{ $service->currency }}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" name="office_hours" class="form-control txt-1" value="{{ $service->office_hours }}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" name="after_office_hours" class="form-control txt-1" value="{{ $service->after_office_hours }}">
                                                </td>
                                                <td class="text-center">
                                                    <!-- Update button -->
                                                    <button type="submit" class="btn btn-success txt-1">Update</button>
                                            </form>
                                            <!-- Delete form -->
                                            <form action="{{ route('accountmanager.client.standard_service.destroy', ['id' => $service->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger txt-1">Delete</button>
                                            </form>
                                                </td>
                                            </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        <!-- Services without a subheader -->
                        @foreach ($services as $service)
                            @if($service->header_id == $header->id && $service->subheader_id === null)
                                <tr>
                                    <form action="{{ route('accountmanager.client.standard_service.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $service->id }}">

                                        <td>
                                            <input type="text" name="service_name" class="form-control txt-1" value="{{ $service->service_name }}">
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="measure" class="form-control txt-1" value="{{ $service->measure }}">
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="currency" class="form-control txt-1" value="{{ $service->currency }}">
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="office_hours" class="form-control txt-1" value="{{ $service->office_hours }}">
                                        </td>
                                        <td class="text-center">
                                            <input type="text" name="after_office_hours" class="form-control txt-1" value="{{ $service->after_office_hours }}">
                                        </td>
                                        <td class="text-center">
                                            <!-- Update button -->
                                            <button type="submit" class="btn btn-success txt-1">Update</button>
                                    </form>
                                    <!-- Delete form -->
                                    <form action="{{ route('accountmanager.client.standard_service.destroy', ['id' => $service->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger txt-1">Delete</button>
                                    </form>
                                        </td>
                                    </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>

        </main>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#headerId').change(function() {
            var headerId = $(this).val();
            $.ajax({
                url: '{{ url('account-manager/clients/services/subheaders') }}/' + headerId,
                type: 'GET',
                success: function(data) {
                    $('#subheaderId').empty(); // Clear the subheader dropdown

                    $.each(data, function(key, subheader) {
                        $('#subheaderId').append('<option value="'+ subheader.id +'">'+ subheader.title +'</option>');
                    });
                }
            });
        });
    });
</script>

@endsection
