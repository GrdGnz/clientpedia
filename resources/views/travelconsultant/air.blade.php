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

      <p class="fs-3">AIR - {{ $client['name'] }}</p>
      <hr class="w-100" />


      <ul class="nav nav-pills" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link txt-2 active" id="authorizer-tab" data-bs-toggle="tab" data-bs-target="#authorizer-tab-pane" type="button" role="tab" aria-controls="authorizer-tab-pane" aria-selected="false">Booking Process</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link txt-2" id="policy-tab" data-bs-toggle="tab" data-bs-target="#policy-tab-pane" type="button" role="tab" aria-controls="policy-tab-pane" aria-selected="false">Travel Policy</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link txt-2" id="preferred-tab" data-bs-toggle="tab" data-bs-target="#preferred-tab-pane" type="button" role="tab" aria-controls="preferred-tab-pane" aria-selected="false">Preferred Airlines</button>
        </li>

        <li class="nav-item" role="presentation">
          <button class="nav-link txt-2" id="security-tab" data-bs-toggle="tab" data-bs-target="#security-tab-pane" type="button" role="tab" aria-controls="security-tab-pane" aria-selected="false">Travel Security</button>
        </li>
      </ul>
      <div class="tab-content py-3 p-3 marsman-bg-color-lightblue" id="myTabContent">
        <div class="tab-pane fade show active" id="authorizer-tab-pane" role="tabpanel" aria-labelledby="authorizer-tab" tabindex="0">
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
        <div class="tab-pane fade" id="policy-tab-pane" role="tabpanel" aria-labelledby="policy-tab" tabindex="0">
          <!-- Second tab -->

          @foreach ($travelPolicy as $policy)

            <div class="mb-3">
              <label for="lla" class="form-label p-2 marsman-bg-color-dark text-white rounded">LLA</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="lla" rows="2" disabled>{{ trim($policy->lla) }}
              </textarea>
            </div>

            <div class="mb-3">
              <label for="classOfService" class="form-label p-2 marsman-bg-color-dark text-white rounded">Class of Service</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="classOfService" rows="2" disabled>{{ $policy->service_class }}
              </textarea>
            </div>

            <div class="mb-3">
              <label for="flightWindow" class="form-label p-2 marsman-bg-color-dark text-white rounded">Flight Window</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="flightWindow" rows="2" disabled>{{ $policy->flight_window }}
              </textarea>
            </div>

            <div class="mb-3">
              <label for="advancePurchase" class="form-label p-2 marsman-bg-color-dark text-white rounded">Advance Purchase</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="advancePurchase" rows="2" disabled>{{ $policy->advance_purchase }}
              </textarea>
            </div>

            <div class="mb-3">
              <label for="lccCondition" class="form-label p-2 marsman-bg-color-dark text-white rounded">LCC Condition</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="lccCondition" rows="2" disabled>{{ $policy->lcc_condition }}
              </textarea>
            </div>

            <div class="mb-3">
              <label for="seatSelection" class="form-label p-2 marsman-bg-color-dark text-white rounded">Seat Selection</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="seatSelection" rows="2" disabled>{{ $policy->seat_selection }}
              </textarea>
            </div>

            <div class="mb-3">
              <label for="baggagAllowance" class="form-label p-2 marsman-bg-color-dark text-white rounded">Baggage Allowance</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="baggagAllowance" rows="2" disabled>{{ $policy->baggage_allowance }}
              </textarea>
            </div>

            <div class="mb-3">
              <label for="groupBookingPolicy" class="form-label p-2 marsman-bg-color-dark text-white rounded">Group Booking Policy</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="groupBookingPolicy" rows="2" disabled>{{ $policy->group_booking_policy }}
              </textarea>
            </div>

            <div class="mb-3">
              <label for="companion" class="form-label p-2 marsman-bg-color-dark text-white rounded">Companion / HCP / Personal Travel</label>
              <textarea class="form-control marsman-border-primary-1 bg-white txt-1" id="companion" rows="2" disabled>{{ $policy->companion_hcp_personaltravel }}
              </textarea>
            </div>

          @endforeach

          <!-- Second tab end -->
        </div>
        <div class="tab-pane fade" id="preferred-tab-pane" role="tabpanel" aria-labelledby="preferred-tab" tabindex="0">
          <!-- Third tab -->

          <div class="col-md-6 m-3">
            @if($uploads->isEmpty())
                <p>No files uploaded for this client.</p>
            @else
                @foreach($uploads as $upload)
                    <div class="file-item">
                        <a href="{{ asset($upload->file_path) }}" target="_blank">
                            {{ basename($upload->file_path) }}
                        </a>
                        <!-- Delete Form -->
                        <form action="{{ route('client.preferred_airlines_upload.destroy', $upload->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger txt-1" onclick="return confirm('Are you sure you want to delete this file?');">Delete</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>

        <hr class="w-100">

        <div class="table-responsive">
            <table id="contactTable" class="table table-striped table-bordered">
                <thead class="marsman-bg-color-dark text-white pt-3">
                    <tr>
                        <th>AIRLINE</th>
                        <th>AIRLINE CODE</th>
                        <th>SNAP CODE</th>
                        <th>CONTACT PERSON</th>
                        <th>CONTACT NUMBER</th>
                        <th>CONTACT EMAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($preferredAirlines as $preferred)
                        <tr>
                            <td>{{ $preferred->airline->name }}</td>
                            <td>{{ $preferred->airline_code }}</td>
                            <td>{{ $preferred->snap_code }}</td>
                            <td>{{ $preferred->contact_person }}</td>
                            <td>{{ $preferred->contact_number }}</td>
                            <td>{{ $preferred->contact_email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

          <!-- Third tab end -->
        </div>

        <div class="tab-pane fade" id="security-tab-pane" role="tabpanel" aria-labelledby="security-tab" tabindex="0">
          <!-- Fourth tab -->

          @if (isset($travelSecurity))
                <div class="table-responsive">
                  <table class="table table-bordered table-striped bg-white">
                    <thead class="marsman-bg-color-dark text-white">
                      <tr>
                        <th>Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($travelSecurity as $security)
                        <tr>
                          <td>
                            {!! $security->description !!}
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
          <!-- Fourth tab end -->
        </div>

      </div>

    </main>
  </div>
</div>

@endsection
