@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    @include('travelconsultant.sidebar')
  </div>
  <div id="layoutSidenav_content">
      <main class="p-3">
        <div class="w-100 my-3">
            <a class="btn marsman-btn-secondary marsman-border-primary-1 txt-1" href="{{ route('travelconsultant.dashboard') }}">Back to Assigned Clients</a>
        </div>

        <p class="fs-3">HOTEL - {{ $client['name'] }}</p>
        <hr class="w-100" />

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
              <button class="nav-link txt-2 active" id="process-tab" data-bs-toggle="tab" data-bs-target="#process-tab-pane" type="button" role="tab" aria-controls="process-tab-pane" aria-selected="true">Booking Process</button>
          </li>
          <li class="nav-item" role="presentation">
              <button class="nav-link txt-2" id="corporate-tab" data-bs-toggle="tab" data-bs-target="#corporate-tab-pane" type="button" role="tab" aria-controls="corporate-tab-pane" aria-selected="false">Hotel Corporate Code</button>
          </li>
        </ul>
        <div class="tab-content py-3 p-3 marsman-bg-color-lightblue" id="myTabContent">
          <div class="tab-pane fade show active" id="process-tab-pane" role="tabpanel" aria-labelledby="process-tab" tabindex="0">
              <!-- First tab -->
              
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-international-tab" data-bs-toggle="tab" data-bs-target="#nav-international" type="button" role="tab" aria-controls="nav-international" aria-selected="true">
                    INTERNATIONAL
                  </button>
                  <button class="nav-link" id="nav-domestic-tab" data-bs-toggle="tab" data-bs-target="#nav-domestic" type="button" role="tab" aria-controls="nav-domestic" aria-selected="false">
                    DOMESTIC
                  </button>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-international" role="tabpanel" aria-labelledby="nav-international-tab" tabindex="0">
                  <!-- International Booking Process -->
  
                  @foreach ($bookingprocessInternational as $international)
                  <div class="input-group mb-3">
                      <span class="input-group-text txt-1 marsman-bg-color-dark text-white" id="basic-addon1">Step {{ $international->order_number }}</span>
                      <input type="text" class="form-control txt-1 bg-white marsman-border-primary-1" value="{{ $international->description }}" aria-label="Username" aria-describedby="basic-addon1" disabled>
                  </div>
                  @endforeach
  
                </div>
                <div class="tab-pane fade" id="nav-domestic" role="tabpanel" aria-labelledby="nav-domestic-tab" tabindex="0">
                  <!-- Domestic Booking Process -->
                  
                  @foreach ($bookingprocessDomestic as $domestic)
                  <div class="input-group mb-3">
                      <span class="input-group-text txt-1 marsman-bg-color-dark text-white" id="basic-addon1">Step {{ $domestic->order_number }}</span>
                      <input type="text" class="form-control txt-1 bg-white marsman-border-primary-1" value="{{ $domestic->description }}" aria-label="Username" aria-describedby="basic-addon1" disabled>
                  </div>
                  @endforeach
  
                </div>
              </div>

              <!-- First tab end -->
          </div>
          <div class="tab-pane fade" id="corporate-tab-pane" role="tabpanel" aria-labelledby="corporate-tab" tabindex="0">
              <!-- Second tab -->

              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead class="marsman-bg-color-dark text-white">
                    <tr>
                      <td>Code</td>
                      <td>Hotel Name</td>
                      <td>Address</td>
                      <td>City</td>
                      <td>State</td>
                      <td>Country</td>
                      <td>Route</td>
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                    @if (isset($hotelCorporateCode))
                      @foreach ($hotelCorporateCode as $corporate)
                        <tr>
                          <td>{{ $corporate->hotel->code }}</td>
                          <td>{{ ucwords($corporate->hotel->name) }}</td>
                          <td>{{ $corporate->hotel->address }}</td>
                          <td>{{ $corporate->hotel->city }}</td>
                          <td>{{ $corporate->hotel->state }}</td>
                          <td>{{ $corporate->hotel->country }}</td>
                          <td>{{ ucfirst($corporate->route->name) }}</td>
                        </tr>
                      @endforeach  
                    @endif
                  </tbody>
                </table>
              </div>

              <!-- Second tab end -->
          </div>
          
        </div>

      </main>
  </div>
</div>
    
@endsection
  