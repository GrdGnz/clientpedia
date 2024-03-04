@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @if(Auth::user()->role['id'] == 2)
            @include('travelconsultant.sidebar')
        @elseif(Auth::user()->role['id'] == 1)
            @include('accountmanager.sidebar')
        @else
            @include('administrator.sidebar')
        @endif

    </div>
    <div id="layoutSidenav_content">
        <main>

        </main>
    </div>
    
@endsection
