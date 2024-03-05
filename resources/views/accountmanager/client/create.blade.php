@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('accountmanager.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <div class="card">
                <div class="card-header marsman-bg-color-dark text-white">
                    <h3 class="card-title">Create New Client</h3>
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

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('accountmanager.clients.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Name:</label>
                            <input type="text" class="form-control marsman-border-primary-1 bg-white txt-1" name="name" id="name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="code" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Code:</label>
                            <input type="text" class="form-control marsman-border-primary-1 bg-white txt-1" name="code" value="{{ old('code') }}" id="code" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="client_type_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Type:</label>
                            <select class="form-control marsman-border-primary-1 bg-white txt-1" name="client_type_id" id="client_type_id" required>
                                <option value="1">Corporate</option>
                                <option value="2">Leisure</option>
                                <option value="3">Walk-in</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="global_customer_number" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Global Customer Number:</label>
                            <input type="text" class="form-control marsman-border-primary-1 bg-white txt-1" name="global_customer_number" id="global_customer_number">
                        </div>

                        <div class="form-group mb-3">
                            <label for="contract_start_date" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Contract Start Date:</label>
                            <input type="text" class="form-control marsman-border-primary-1 bg-white datepicker txt-1" name="contract_start_date" id="contract_start_date">
                        </div>

                        <div class="form-group mb-3">
                            <label for="contract_end_date" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Contract End Date:</label>
                            <input type="text" class="form-control marsman-border-primary-1 bg-white datepicker txt-1" name="contract_end_date" id="contract_end_date">
                        </div>

                        <div class="w-100 text-center">
                            <button type="submit" class="btn marsman-btn-primary">Save</button>
                        </div>
                    </form>

                    <script>
                        // Initialize Bootstrap Datepicker
                        $(document).ready(function() {
                            $('.datepicker').datepicker({
                                format: 'yyyy-mm-dd', // Adjust the format as needed
                                autoclose: true
                            });
                        });
                    </script>

                </div>
            </div>
        </main>
    </div>
</div>
@endsection
