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
            <main class="py-3 p-3">
                <p class="h3">Settings</p>
                <hr class="w-100" />
                <!-- Alert Section -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <!-- Add your 2-column layout structure here -->
                <div class="container-fluid py-3">
                    <div class="row">
                        <!-- First Column - Menu Tabs -->
                        <div class="col-md-3">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane" role="tab" aria-controls="password-tab-pane" aria-selected="false">Change Password</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Second Column - Content -->
                        <div class="col-md-9">
                            <div class="tab-content marsman-bg-color-lightblue p-3">
                                <!-- Profile Tab -->

                                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                               
                                <!-- Profile Photo Thumbnail -->
                                @if (isset($profile_photo))
                                    <div class="mb-4">
                                        <img src="{{ asset($profile_photo['thumbnail_path']) }}" alt="Profile Photo" class="img-thumbnail">
                                    </div>
                                    <p class="text-primary">* file size must be 2MB or less only</p> 
                                @endif
                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{ route('user.update-profile') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Thumbnail Upload -->
                                    <!--
                                    <div class="mb-3">
                                        <label for="profile_photo">Profile Photo</label>
                                        <input type="file" name="profile_photo" id="profile_photo" class="form-control">
                                        @error('profile_photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                -->
                                    <!-- Update the 'username' fields to 'name' -->
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn marsman-btn-primary">Save Profile</button>
                                </form>

                                </div>

                                <!-- Change Password Tab -->
                                <div class="tab-pane fade show" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
                                    <form method="POST" action="{{ route('user.password.email') }}">
                                        @csrf
                                        <button type="submit" class="btn marsman-btn-primary">Reset Password</button>
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
