@extends('layouts.app')

@section('content')
    @include('layouts.topbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('administrator.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div>

                            {{-- Success Message --}}
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            {{-- Error Messages --}}
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            
                            <span class="h3">Create User</span>

                            <hr class="w-100" />

                            <div class="card">
   
                                <div class="card-body p-2 marsman-bg-color-lightblue rounded-5">
                                    <form method="POST" action="{{ route('user.register') }}">
                                        @csrf

                                        <div class="form-group p-2">
                                            <label for="name" class="marsman-bg-color-semidark text-white rounded-top p-2">Name</label>
                                            <input type="text" id="name" name="name" class="form-control marsman-border-primary-1 txt-1" required>
                                        </div>

                                        <div class="form-group p-2">
                                            <label for="email" class="marsman-bg-color-semidark text-white rounded-top p-2">Email</label>
                                            <input type="email" id="email" name="email" class="form-control marsman-border-primary-1 txt-1" required>
                                        </div>

                                        <div class="form-group p-2">
                                            <label for="password" class="marsman-bg-color-semidark text-white rounded-top p-2">Password</label>
                                            <input type="password" id="password" name="password" class="form-control marsman-border-primary-1 txt-1" required>
                                        </div>

                                        <div class="form-group p-2">
                                            <label for="role_id" class="marsman-bg-color-semidark text-white rounded-top p-2">Role</label>
                                            <select id="role_id" name="role_id" class="form-control marsman-border-primary-1 txt-1" required>
                                                <option value="1">Account Manager</option>
                                                <option value="2">Travel Consultant</option>
                                                <option value="3">Administrator</option>
                                            </select>
                                        </div>

                                        <div class="form-group p-2 text-center">
                                            <button type="submit" class="btn marsman-btn-primary">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
