@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      @include('travelconsultant.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
          <p class="fs-3">PROFILE MANAGEMENT - {{ $client['name'] }}</p>
          <hr class="w-100" />


          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link txt-2 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Profile Management</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link txt-2" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile Template</button>
            </li>
          </ul>
          <div class="tab-content py-3 p-3 marsman-bg-color-lightblue" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
              <!-- First tab -->
              <p>Modified By: -</p>

              <div class="mb-3">
                <label for="lowFare" class="form-label p-2 marsman-bg-color-dark text-white rounded">Profile Type</label>
                <input type="text" class="form-control marsman-border-primary-1 bg-white" id="lowFare" disabled />
              </div>

              <div class="mb-3">
                <label for="lowFare" class="form-label p-2 marsman-bg-color-dark text-white rounded">Booking Type</label>
                <input type="text" class="form-control marsman-border-primary-1 bg-white" id="lowFare" disabled/>
              </div>
              
              <div class="mb-3">
                <label for="lowFareDescription" class="form-label p-2 marsman-bg-color-dark text-white rounded">Special Instructions</label>
                <textarea class="form-control marsman-border-primary-1 bg-white" id="lowFareDescription" disabled></textarea>
              </div>   
              
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
              <!-- Second tab -->
                  
              <div class="card">
                <div class="card-header marsman-bg-color-semidark text-white">
                  <span class="fas fa-file-upload"></span>
                  Files
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">File #1</li>
                  <li class="list-group-item">File #2</li>
                  <li class="list-group-item">File #3</li>
                </ul>
              </div>

              <div class="card mt-3">
                <div class="card-header marsman-bg-color-semidark text-white">
                  <span class="fas fa-link"></span>
                  Links
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Link #1</li>
                  <li class="list-group-item">Link #2</li>
                  <li class="list-group-item">Link #3</li>
                </ul>
              </div>
            </div>
          </div> 
            
        </main>
    </div>
    
@endsection
  