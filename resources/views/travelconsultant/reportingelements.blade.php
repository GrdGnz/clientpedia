@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('travelconsultant.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <div class="w-100 my-3">
                <a class="btn marsman-btn-secondary marsman-border-primary-1 txt-1" href="{{ route('travelconsultant.dashboard') }}">Back to Assigned Clients</a>
            </div>

            <p class="h3">REPORTING ELEMENTS - {{ $client['name'] }}</p>
            <hr class="w-100" />
            
            <div class="card">
                <div class="card-header marsman-bg-color-dark text-white h4">
                    <p class="h5 my-2">COD's Caption:</p>
                </div>
                <div class="card-body marsman-bg-color-lightblue">
                    
                    @foreach ($reportingElements as $elements)
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text txt-1" id="basic-addon1">{{ $elements->report_code }}</span>
                            <input type="text" class="form-control bg-white txt-1" placeholder="{{ $elements->description }}" aria-label="Username" aria-describedby="basic-addon1" disabled>
                        </div>

                    @endforeach

                </div>
            </div>

        </main>
    </div>
@endsection
