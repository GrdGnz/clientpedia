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

            <div class="h3">PRICING MODEL - {{ $client['name'] }}</div>
            <hr class="w-100" />

            <table id="pricingModelTable" class="table table-striped table-bordered">
                <thead class="marsman-bg-color-dark text-white">
                    <tr>
                        <th>Route Name</th>
                        <th>Pricing Model Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientPricingModels as $clientPricingModel)
                        <tr>
                            <td>{{ strtoupper($clientPricingModel->route->name) }}</td>
                            <td>{{ strtoupper($clientPricingModel->pricingModelType->name) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="w-100" />

            <div class="card">
                <div class="card-header marsman-bg-color-dark">
                    <p class="h4 text-white py-2">Add Pricing Model</p>
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

                    <form method="POST" action="{{ route('accountmanager.client.pricingmodel.create') }}">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $clientId }}">
                        <div class="mb-3">
                            <label for="route_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Select Route:</label>
                            <select name="route_id" id="route_id" class="form-control marsman-border-primary-1 bg-white txt-1">
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}">{{ strtoupper($route->name) }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="mb-3">
                            <label for="pricingmodel_type_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Select Pricing Model Type:</label>
                            <select name="pricingmodel_type_id" id="pricingmodel_type_id" class="form-control marsman-border-primary-1 bg-white txt-1">
                                @foreach($pricingModelTypes as $pricingModelType)
                                    <option value="{{ $pricingModelType->id }}">{{ strtoupper($pricingModelType->name) }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <button type="submit" class="btn marsman-btn-primary m-2">Save</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
