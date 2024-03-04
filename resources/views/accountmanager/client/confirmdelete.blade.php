@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        
        @include('accountmanager.sidebar')

    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">

            <div class="card">
                <div class="card-header marsman-bg-color-dark text-white">
                    <span class="align-middle h3">Confirm Delete</span>
                </div>
                <div class="card-body marsman-bg-color-lightblue">
                    <p class="h5">
                        Are you sure you want to delete the client:<br><br>
                        <strong>{{ $client->name }}</strong>?<br><br>
                    </p>

                    <form action="{{ route('accountmanager.clients.destroy', ['clientId' => $clientId]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger rounded-pill">Delete</button>
                            <a href="{{ route('accountmanager.clients.index') }}" class="btn btn-secondary rounded-pill">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            
        </main>
    </div>
</div>
@endsection
