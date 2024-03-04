<!-- administrator.dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    @include('layouts.topbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('administrator.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main class="p-4">
               
                <p class="h3">Add Routes</p>
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

                <table class="table table-bordered table-striped">
                    <thead class="marsman-bg-color-dark text-white">
                        <tr>
                            <th>Routes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routes as $route)
                        <tr>
                            <td>{{ ucfirst($route->name) }}</td>
                            <td>
                                <form method="post" action="{{ route('administrator.route.destroy') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $route->id }}" />
                                <button type="submit" class="btn btn-danger txt-1">Delete</button>
                                </form>
                            </td>
                        </tr> 
                        @endforeach
                        <tr>
                            <td colspan="2">
                                <form method="post" action="{{ route('administrator.route.create') }}">
                                    @csrf
                                    <input type="text" name="name" id="name" class="marsman-border-primary-1 p-1 w-50" required />
                                    <button type="submit" class="btn btn-primary txt-1">Add Route</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </main>
        </div>
    </div>

@endsection
