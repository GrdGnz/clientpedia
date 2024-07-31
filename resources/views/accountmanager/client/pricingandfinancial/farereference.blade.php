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

            <div class="h3">FARE REFERENCE - {{ $client['name'] }}</div>
            <hr class="w-100" />

            @if (session('success'))
                <div class="alert alert-success txt-2">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger txt-2">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger txt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('accountmanager.client.fare_reference.create') }}" method="POST">
                @csrf

                <input type="hidden" name="client_id" value="{{ $client['id'] }}">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="marsman-bg-color-primary text-white">
                            <tr>
                                <th>References</th>
                                <th>Description</th>
                                <th>Yes / No</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __('Published Fares') }}</td>
                                <td>{{ __('Standard fares available to the general public.') }}</td>
                                <td>
                                    <div class="form-control">
                                        <input type="radio" name="published_fares" value="yes" class="me-1"
                                            @if($clientFareReferences && $clientFareReferences->published_fares === 'yes') checked @endif>Yes
                                        <input type="radio" name="published_fares" value="no" class="ms-2 me-1"
                                            @if($clientFareReferences && $clientFareReferences->published_fares === 'no') checked @endif>No
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Private Fares') }}</td>
                                <td>{{ __('Also known as negotiated fares or wholesale fares, these are special rates offered to specific travel agencies.') }}</td>
                                <td>
                                    <div class="form-control">
                                        <input type="radio" name="private_fares" value="yes" class="me-1"
                                            @if($clientFareReferences && $clientFareReferences->private_fares === 'yes') checked @endif>Yes
                                        <input type="radio" name="private_fares" value="no" class="ms-2 me-1"
                                            @if($clientFareReferences && $clientFareReferences->private_fares === 'no') checked @endif>No
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Corporate Fares') }}</td>
                                <td>{{ __('Discounted fares offered to companies that have a corporate agreement with an airline or travel provider.') }}</td>
                                <td>
                                    <div class="form-control">
                                        <input type="radio" name="corporate_fares" value="yes" class="me-1"
                                            @if($clientFareReferences && $clientFareReferences->corporate_fares === 'yes') checked @endif>Yes
                                        <input type="radio" name="corporate_fares" value="no" class="ms-2 me-1"
                                            @if($clientFareReferences && $clientFareReferences->corporate_fares === 'no') checked @endif>No
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn marsman-btn-primary">Save</button>
                </div>
            </form>
        </main>
    </div>
</div>

@endsection
