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
                    
                    <div class="h3">PREFERRED AIRLINES - {{ $client['name'] }}</div>
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
                    
                    <form action="{{ route('accountmanager.client.preferred_airlines.create') }}" method="post">
                        @csrf
                        <div class="row marsman-bg-color-lightblue p-3">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <h5 class="mb-3">Select Airlines</h5>
                                <select id="international_airlines" name="international_airlines[]" class="form-select form-control mb-3 txt-1 marsman-border-primary-1" size="21" multiple>
                                    {{-- Populate this dropdown with options from the 'airlines' table --}}
                                    @foreach ($airlines as $airline)
                                        <option value="{{ $airline->code }}">{{ $airline->name }} - {{ $airline->code }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="addToInternational()" class="btn btn-primary">Add to International</button>
                                <button type="button" onclick="addToDomestic()" class="btn btn-success">Add to Domestic</button>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <h5 class="mb-3">Preferred International Airlines</h5>
                                <select id="preferred_international" name="preferred_international[]" class="form-select form-control mb-3 txt-1 marsman-border-primary-1" size="7" multiple>
                                    @if (isset($internationalAirlines))
                                        @foreach ($internationalAirlines as $international)
                                            <option value="{{ $international->airline_code }}">{{ $international->airline->name }} - {{ $airline->code }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <button type="button" onclick="removeFromInternational()" class="btn btn-danger">Remove Selected</button>
                                <br><br>
                                <h5 class="mb-3">Preferred Domestic Airlines</h5>
                                <select id="preferred_domestic" name="preferred_domestic[]" class="form-select form-control mb-3 txt-1 marsman-border-primary-1" size="7" multiple>
                                    @if (isset($domesticAirlines))
                                        @foreach ($domesticAirlines as $domestic)
                                            <option value="{{ $domestic->airline_code }}">{{ $domestic->airline->name }} - {{ $airline->code }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <button type="button" onclick="removeFromDomestic()" class="btn btn-danger">Remove Selected</button>

                                <button type="submit" class="btn marsman-btn-primary" onclick="selectAllItems()">Save</button>
                            </div>

                        </div>

                        <input type="hidden" name="client_id" value="{{ $client['id'] }}">
                        <input type="hidden" name="route_id_international" value="1">
                        <input type="hidden" name="route_id_domestic" value="2">
                    </form>

                    <script>
                        function addToInternational() {
                            // Get the selected options from the left box
                            var selectedOptions = document.getElementById('international_airlines').selectedOptions;

                            // Append the selected options to the top right box only if not already present
                            var preferredInternationalBox = document.getElementById('preferred_international');
                            for (var i = 0; i < selectedOptions.length; i++) {
                                var option = selectedOptions[i];
                                if (!optionExists(preferredInternationalBox, option.value)) {
                                    preferredInternationalBox.appendChild(option.cloneNode(true));
                                }
                            }
                        }

                        function addToDomestic() {
                            // Get the selected options from the left box
                            var selectedOptions = document.getElementById('international_airlines').selectedOptions;

                            // Append the selected options to the bottom right box only if not already present
                            var preferredDomesticBox = document.getElementById('preferred_domestic');
                            for (var i = 0; i < selectedOptions.length; i++) {
                                var option = selectedOptions[i];
                                if (!optionExists(preferredDomesticBox, option.value)) {
                                    preferredDomesticBox.appendChild(option.cloneNode(true));
                                }
                            }
                        }

                        function optionExists(selectBox, value) {
                            // Check if the option with the given value already exists in the select box
                            var options = selectBox.options;
                            for (var i = 0; i < options.length; i++) {
                                if (options[i].value === value) {
                                    return true;
                                }
                            }
                            return false;
                        }

                        function removeFromInternational() {
                            // Get the selected options from the preferred international box
                            var selectedOptions = document.getElementById('preferred_international').selectedOptions;

                            // Remove the selected options from the preferred international box
                            for (var i = selectedOptions.length - 1; i >= 0; i--) {
                                var option = selectedOptions[i];
                                option.remove();
                            }
                        }

                        function removeFromDomestic() {
                            // Get the selected options from the preferred domestic box
                            var selectedOptions = document.getElementById('preferred_domestic').selectedOptions;

                            // Remove the selected options from the preferred domestic box
                            for (var i = selectedOptions.length - 1; i >= 0; i--) {
                                var option = selectedOptions[i];
                                option.remove();
                            }
                        }

                        function selectAllItems() {
                            // Select all items in the preferred_international select
                            var preferredInternationalSelect = document.getElementById('preferred_international');
                            for (var i = 0; i < preferredInternationalSelect.options.length; i++) {
                                preferredInternationalSelect.options[i].selected = true;
                            }

                            // Select all items in the preferred_domestic select
                            var preferredDomesticSelect = document.getElementById('preferred_domestic');
                            for (var i = 0; i < preferredDomesticSelect.options.length; i++) {
                                preferredDomesticSelect.options[i].selected = true;
                            }
                        }

                    </script>
                </main>
            </div>
        </div>
    </div>
@endsection
