@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        
        @include('accountmanager.sidebar')

    </div>
    <div id="layoutSidenav_content">
        <main>

        </main>
    </div>
@endsection
