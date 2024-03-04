@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    @include('accountmanager.sidebar')
  </div>
  <div id="layoutSidenav_content">
    <main class="p-3">
      <div class="container">
        <div class="w-100 my-3">
            <a class="btn marsman-btn-secondary marsman-border-primary-1 txt-1" href="{{ route('accountmanager.clients.index') }}">Back to Client List</a>
        </div>
        
        <div class="h3">AIR TRAVEL POLICY - {{ $client['name'] }}</div>
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
        
        @foreach ($travelPolicy as $policy)
        <form method="POST" action="{{ route('accountmanager.client.travel_policy.update') }}">
            @csrf
            <input type="hidden" name="client_id" value="{{ $clientId }}"> 
            <input type="hidden" name="category_id" value="1"> 
            
            <table class="table table-bordered">
                <tbody>
                        <tr>
                            <td class="marsman-bg-color-dark text-white" width="20%">LLA</td>
                            <td width="80%"><textarea class="w-100" name="lla" rows="3">{{ $policy->lla }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="marsman-bg-color-dark text-white">Class of Service</td>
                            <td><textarea class="w-100" name="service_class" rows="3">{{ $policy->service_class }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="marsman-bg-color-dark text-white">Flight Window</td>
                            <td><textarea class="w-100" name="flight_window" rows="3">{{ $policy->flight_window }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="marsman-bg-color-dark text-white">Advance Purchase</td>
                            <td><textarea class="w-100" name="advance_purchase" rows="3">{{ $policy->advance_purchase }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="marsman-bg-color-dark text-white">LCC Condition</td>
                            <td><textarea class="w-100" name="lcc_condition" rows="3">{{ $policy->lcc_condition }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="marsman-bg-color-dark text-white">Seat Selection</td>
                            <td><textarea class="w-100" name="seat_selection" rows="3">{{ $policy->seat_selection }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="marsman-bg-color-dark text-white">Baggage Allowance</td>
                            <td><textarea class="w-100" name="baggage_allowance" rows="3">{{ $policy->baggage_allowance }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="marsman-bg-color-dark text-white">Group Booking Policy</td>
                            <td><textarea class="w-100" name="group_booking_policy" rows="3">{{ $policy->group_booking_policy }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="marsman-bg-color-dark text-white">Companion / HCP / Personal Travel</td>
                            <td><textarea class="w-100" name="companion_hcp_personaltravel" rows="3">{{ $policy->companion_hcp_personaltravel }}</textarea></td>
                        </tr>
                    
                </tbody>
            </table>
            <button type="submit" class="btn marsman-btn-primary">Update</button>
        </form>
        @endforeach

        @if($travelPolicy->isEmpty())
        <div class="card">
            <div class="card-header marsman-bg-color-dark text-white py-3">
                <p class="h4">Add New Client Travel Policy</p>
            </div>
            <div class="card-body marsman-bg-color-lightblue">

                <form method="POST" action="{{ route('accountmanager.client.travel_policy.create') }}">
                @csrf
                <input type="hidden" name="client_id" value="{{ $clientId }}"> 
                <input type="hidden" name="category_id" value="1"> 

                <div class="form-group mb-3">
                    <label for="lla" class="form-label marsman-bg-color-dark text-white p-2 rounded">LLA:</label>
                    <input type="text" name="lla" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <div class="form-group mb-3">
                    <label for="service_class" class="form-label marsman-bg-color-dark text-white p-2 rounded">Service Class:</label>
                    <input type="text" name="service_class" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <div class="form-group mb-3">
                    <label for="flight_window" class="form-label marsman-bg-color-dark text-white p-2 rounded">Flight Window:</label>
                    <input type="text" name="flight_window" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <div class="form-group mb-3">
                    <label for="advance_purchase" class="form-label marsman-bg-color-dark text-white p-2 rounded">Advance Purchase:</label>
                    <input type="text" name="advance_purchase" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <div class="form-group mb-3">
                    <label for="lcc_condition" class="form-label marsman-bg-color-dark text-white p-2 rounded">LCC Condition:</label>
                    <input type="text" name="lcc_condition" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <div class="form-group mb-3">
                    <label for="seat_selection" class="form-label marsman-bg-color-dark text-white p-2 rounded">Seat Selection:</label>
                    <input type="text" name="seat_selection" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <div class="form-group mb-3">
                    <label for="baggage_allowance" class="form-label marsman-bg-color-dark text-white p-2 rounded">Baggage Allowance:</label>
                    <input type="text" name="baggage_allowance" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <div class="form-group mb-3">
                    <label for="group_booking_policy" class="form-label marsman-bg-color-dark text-white p-2 rounded">Group Booking Policy:</label>
                    <input type="text" name="group_booking_policy" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <div class="form-group mb-3">
                    <label for="companion_hcp_personaltravel" class="form-label marsman-bg-color-dark text-white p-2 rounded">Companion HCP Personal Travel:</label>
                    <input type="text" name="companion_hcp_personaltravel" class="form-control marsman-border-primary-1 bg-white" required>
                </div>

                <button type="submit" class="btn marsman-btn-primary">Save</button>
                </form>
            </div>
        </div>
        @endif

      </div>
    </main>
  </div>
</div>
    
@endsection
