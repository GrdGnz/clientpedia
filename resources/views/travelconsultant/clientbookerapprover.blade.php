@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        
        @include('travelconsultant.sidebar')

    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <p class="h3">CLIENT BOOKER APPROVER - {{ $client['name'] }}</p>
            <p>Modified by: 
                @if (isset($clientBooker))
                    @foreach($accountManager as $manager) 
                        {{ $manager->name }} 
                    @endforeach
                @endif
            </p>
            <div class="mb-3">
                @foreach ($clientBooker as $step)
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-primary text-white txt-1">Step {{ $step['order_number'] }}</span>
                        <input type="text" class="form-control txt-1" value="{{ $step['description'] }}" disabled>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
@endsection
