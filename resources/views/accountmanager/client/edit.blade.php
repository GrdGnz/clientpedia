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
            
            <p class="h3">Edit - {{ $client->name }}</p>
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

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-3 marsman-bg-color-lightblue">
                <form method="post" action="{{  route('accountmanager.clients.update', ['clientId' => $client->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name" class="form-label marsman-bg-color-dark text-white rounded-top m-0 p-2">Name</label>
                        <input type="text" name="name" class="form-control txt-1 marsman-border-primary-1" value="{{ $client->name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="code" class="form-label marsman-bg-color-dark text-white rounded-top m-0 p-2">Code</label>
                        <input type="text" name="code" class="form-control txt-1 marsman-border-primary-1" value="{{ $client->code }}">
                    </div>

                    <div class="form-group mb-3 text-center">
                        <button class="btn marsman-btn-primary m-3" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
