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
                
                <p class="h3">AIR TRAVEL SECURITY - {{ $client['name'] }}</p>
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

                <div class="card">
                    <div class="card-header marsman-bg-color-dark text-white">
                        <p class="h3">Modify Travel Security</p>
                    </div>
                    <div class="card-body">

                        @if ($travelSecurity->count() > 0)
                            
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td class="marsman-bg-color-dark text-white rounded-top">Description</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <form method="POST" action="{{ route('accountmanager.client.travel_security.update') }}">
                                                @csrf
                                                @foreach ($travelSecurity as $security)
                                                    <input type="hidden" name="client_id" value="{{ $security->id }}" class="form-control">
                                                    <trix-editor input="description" class="form-control marsman-border-primary-1 txt-1 text-left"></trix-editor>
                                                    <input id="description" type="hidden" name="description" value="{{ trim($security->description) }}">
                                                @endforeach
                                                    <button type="submit" class="btn marsman-btn-primary txt-2 mt-2">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        @else
                        
                        <form method="POST" action="{{ route('accountmanager.client.travel_security.create') }}">
                            @csrf
                            <input type="hidden" name="client_id" value="{{ $client['id'] }}" class="form-control">
                
                            <div class="form-group mb-3">
                                <label for="description" class="p-2 marsman-bg-color-dark text-white rounded-top">Description</label>
                                <trix-editor input="description" class="form-control marsman-border-primary-1 txt-1"></trix-editor>
                                <input id="description" type="hidden" name="description">
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn marsman-btn-primary">Save</button>
                            </div>
                        </form>

                        @endif

                    </div>
                </div>
                
            </main>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('trix-file-accept', function(event) {
        event.preventDefault();
        alert('File attachment is not allowed!');
    });
</script>