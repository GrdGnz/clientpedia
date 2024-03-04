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
            
            <div class="h3">ANCILLIARY FEES - {{ $client['name'] }}</div>
            <hr class="w-100" />

            <table id="ancilliaryFeesTable" class="table table-striped table-bordered">
                <thead class="marsman-bg-color-dark text-white">
                    <tr>
                        <th>Description</th>
                        <th>Currency Code</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientAncilliaryFees as $clientAncilliaryFee)
                        <tr>
                            <td>{{ strtoupper($clientAncilliaryFee->description) }}</td>
                            <td>{{ strtoupper($clientAncilliaryFee->currency_code) }}</td>
                            <td>{{ number_format($clientAncilliaryFee->amount, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="w-100" />

            <div class="card marsman-bg-color-lightblue">
                
                <div class="card-header marsman-bg-color-dark py-3">
                    <p class="h4 text-white">Add Ancilliary Fee</p>
                </div>

                <div class="card-body">

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

                    <form method="POST" action="{{ route('accountmanager.client.ancilliary_fee.create') }}">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $clientId }}">
                        
                        <div class="mb-3">
                            <label for="description" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Description:</label>
                            <input type="text" name="description" id="description" class="form-control marsman-border-primary-1 bg-white txt-1" placeholder="Enter Description">
                        </div>
            
                        <div class="mb-3">
                            <label for="currency_code" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Currency Code:</label>
                            <select name="currency_code" id="currency_code" class="form-control marsman-border-primary-1 bg-white txt-1">
                                <option value="php">PHP - Philippine Peso</option>
                                <option value="usd">USD - US Dollar</option>
                            </select>
                        </div>
            
                        <div class="mb-3">
                            <label for="amount" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Amount:</label>
                            <input type="text" name="amount" id="amount" class="form-control marsman-border-primary-1 bg-white txt-1" placeholder="Enter Amount">
                        </div>
            
                        <button type="submit" class="btn marsman-btn-primary m-2">Save</button>
                    </form>
                </div>
            </div>
            
        </main>
    </div>
</div>
@endsection