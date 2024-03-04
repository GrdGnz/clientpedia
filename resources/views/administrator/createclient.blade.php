<!-- administrator.dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    @include('layouts.topbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('administrator.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main class="p-3">
                <p class="h3">Create New Client</p>
                <hr class="w-100" />

                <div class="p-3 marsman-bg-color-lightblue">
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
                    
                    <form method="post" action="{{ route('administrator.clients.store') }}">
                        @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Name</label>
                                <input type="text" name="name" id="name" class="form-control marsman-border-primary-1 txt-1" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="code" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Code</label>
                                <input type="text" name="code" id="code" class="form-control marsman-border-primary-1 txt-1 " required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="client_type_id" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Client Type</label>
                                <select name="client_type_id" id="client_type_id" class="form-control marsman-border-primary-1 txt-1" required>
                                    @foreach ($clientTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="global_customer_number" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Global Customer No.</label>
                                <input type="text" name="global_customer_number" id="global_customer_number" class="form-control marsman-border-primary-1 txt-1" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="contract_start_date" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Contract Start Date</label>
                                <input type="date" name="contract_start_date" id="contract_start_date" class="form-control marsman-border-primary-1 txt-1" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="contract_end_date" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Contract End Date</label>
                                <input type="date" name="contract_end_date" id="contract_end_date" class="form-control marsman-border-primary-1 txt-1" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="accountmanager_user_id" class="marsman-bg-color-dark text-white p-2 rounded-top m-0">Account Manager</label>
                                <select name="accountmanager_user_id" id="accountmanager_user_id" class="form-control marsman-border-primary-1 txt-1" required>
                                    @foreach ($accountManagers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                        <div class="mb-3 w-100 text-center">
                            <button type="submit" class="btn marsman-btn-primary">Save</button>
                        </div>
                    </form>
                </div>

            </main>
        </div>
    </div>

@endsection
