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
                    
                    <div class="h3">HOTEL CORPORATE CODE - {{ $client['name'] }}</div>
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

                    @if (isset($hotelCorporateCode))
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr>
                                    <td>Code</td>
                                    <td>Hotel Name</td>
                                    <td>Address</td>
                                    <td>City</td>
                                    <td>State</td>
                                    <td>Country</td>
                                    <td>Route Type</td>
                                    <td>Action 1</td>
                                    <td>Action 2</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hotelCorporateCode as $corporate)
                                    <form method="post" action="{{ route('accountmanager.client.hotel_corporate_code.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="client_id" value="{{ $client['id'] }}">
                                        <input type="hidden" name="hotel_id" value="{{ $corporate->hotel->id }}">
                                    <tr>
                                        <td><input type="text" name="code" value="{{ $corporate->hotel->code }}"></td>
                                        <td><input type="text" name="name" value="{{ $corporate->hotel->name }}"></td>
                                        <td><input type="text" name="address" value="{{ $corporate->hotel->address }}"></td>
                                        <td><input type="text" name="city" value="{{ $corporate->hotel->city }}"></td>
                                        <td><input type="text" name="state" value="{{ $corporate->hotel->state }}"></td>
                                        <td><input type="text" name="country" value="{{ $corporate->hotel->country }}"></td>
                                        <td>
                                            <select name="route_id">

                                                <option value="1" 
                                                @if ($corporate->route->id == 1)
                                                    selected                                              
                                                @endif>international</option>

                                                <option value="2" 
                                                @if ($corporate->route->id == 2)
                                                    selected
                                                @endif>domestic</option>
                                            
                                            </select>
                                        </td>
                                        <td><button type="submit" class="btn btn-primary rounded txt-1">Update</button></td>
                                    </form>
                                    <form method="post" action="{{ route('accountmanager.client.hotel_corporate_code.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="hotel_id" value="{{ $corporate->hotel->id }}">
                                        <td><button type="submit" class="btn btn-danger rounded txt-1">Delete</button></td>
                                    </form>
                                    </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header marsman-bg-color-dark text-white py-3">
                            <p class="h4">Add Hotel</p>
                        </div>
                        <div class="card-body marsman-bg-color-lightblue">
                            
                            <form action="{{ route('accountmanager.client.hotel_corporate_code.create') }}" method="post">
                                @csrf

                                <input type="hidden" name="client_id" value="{{ $client['id'] }}">
                    
                                <div class="mb-3">
                                    <label for="code" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Code:</label>
                                    <input type="text" name="code" value="{{ old('code') }}" class="form-control marsman-border-primary-1 txt-1" required>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="name" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Name:</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control marsman-border-primary-1 txt-1" required>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="address" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Address:</label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control marsman-border-primary-1 txt-1" required>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="city" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">City:</label>
                                    <input type="text" name="city" value="{{ old('city') }}" class="form-control marsman-border-primary-1 txt-1" required>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="state" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">State:</label>
                                    <input type="text" name="state" value="{{ old('state') }}" class="form-control marsman-border-primary-1 txt-1" required>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="country" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Country:</label>
                                    <input type="text" name="country" value="{{ old('country') }}" class="form-control marsman-border-primary-1 txt-1" required>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="route_id" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Route ID:</label>
                                    <select name="route_id" value="{{ old('route_id') }}" class="form-control marsman-border-primary-1 txt-1" required>
                                        @foreach ($routes as $route)
                                            <option value="{{ $route->id }}">{{ $route->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100 text-center">
                                    <button type="submit" class="btn marsman-btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
