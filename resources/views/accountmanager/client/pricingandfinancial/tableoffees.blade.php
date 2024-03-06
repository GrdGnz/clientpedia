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

            <h3>TABLE OF FEES - {{ $client['name'] }}</h3>
            <hr class="w-100" />

            @if(session('success'))
                <div class="alert alert-success txt-2">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger txt-2">
                    {{ session('error') }}
                </div>
            @endif

            <table id="feesTable" class="table table-striped table-bordered">
                <thead class="marsman-bg-color-dark text-white">
                    <tr>
                        <th width="10%">Category</th>
                        <th width="10%">Route</th>
                        <th width="10%">Route Type</th>
                        <th>Description</th>
                        <th width="10%">Source</th>
                        <th width="10%">Currency</th>
                        <th width="10%">Amount</th>
                        <th width="10%">Percentage</th>
                        <th width="10%">VAT</th>
                        <th width="10%">Unit</th>
                        <th width="10%">Action 1</th>
                        <th width="10%">Action 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientFeesWithRouteAndSource as $clientFee)
                        <tr>
                            <form method="post" action="{{ route('accountmanager.client.fee.update') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="fee_id" value="{{ $clientFee->id }}" />
                                <td>{{ ucfirst($clientFee->category) }}<br />
                                    <select name="category_id" class="form-control txt-1">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if($clientFee->category_id == $category->id)
                                                    selected="selected"
                                                @endif
                                            >{{ ucfirst($category->name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{ ucfirst($clientFee->route) }}<br />
                                    <select name="route_id" class="form-control txt-1">
                                        @foreach ($routes as $route)
                                            <option value="{{ $route->id }}"
                                                @if ($clientFee->route_id == $route->id)
                                                    selected="selected"
                                                @endif
                                            >{{ ucfirst($route->name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{ ucfirst($clientFee->routeType->name) }}<br />
                                    <select name="route_type_id" class="form-control txt-1">
                                        @foreach ($routeTypes as $routeType)
                                            <option value="{{ $routeType->id }}"
                                                @if ($clientFee->route_type_id == $routeType->id)
                                                    selected="selected"
                                                @endif
                                            >{{ ucfirst($routeType->name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{ ucfirst($clientFee->description) }}<br />
                                    <textarea name="description" class="form-control txt-1">{{ strtoupper($clientFee->description) }}</textarea>
                                </td>
                                <td>{{ ucfirst($clientFee->source) }}<br />
                                    <select name="source_id" class="form-control txt-1">
                                        @foreach ($sources as $source)
                                            <option value="{{ $source->id }}"
                                                @if ($clientFee->source_id == $source->id)
                                                    selected="selected"
                                                @endif
                                            >{{ ucfirst($source->name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    {{ $clientFee->currency }}<br />
                                    <select name="currency" class="form-control txt-1">
                                            <option value="{{ __('PHP') }}"
                                                @if ($clientFee->currency == __('PHP'))
                                                    selected="selected"
                                                @endif
                                            >{{ __('PHP') }}</option>
                                            <option value="{{ __('USD') }}"
                                                @if ($clientFee->currency == __('USD'))
                                                    selected="selected"
                                                @endif
                                            >{{ __('USD') }}</option>
                                    </select>
                                </td>
                                <td>
                                    @if($clientFee->currency == 'PHP')
                                        {{ __('₱') }}
                                    @else
                                        {{ __('$') }}
                                    @endif
                                    {{ $clientFee->amount }}<br />
                                    <input type="text" name="amount" value="{{ $clientFee->amount }}" class="form-control txt-1" />
                                </td>
                                <td>
                                    {{ $clientFee->percentage }}<br />
                                    <input type="text" name="percentage" value="{{ $clientFee->percentage }}" class="form-control txt-1" />
                                </td>
                                <td>
                                    @if($clientFee->vat)
                                        {{ __('YES') }}
                                    @else
                                        {{ __('NO') }}
                                    @endif
                                    <br />
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="vat" id="nonVat" value="0" checked>
                                            <label class="form-check-label" for="nonVat">
                                                Non-VAT
                                            </label>
                                        </div>
                                        <div class="form-check mx-3">
                                            <input class="form-check-input" type="radio" name="vat" id="vat" value="1">
                                            <label class="form-check-label" for="vat">
                                                VAT
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ ucfirst($clientFee->unit->name) }}<br />
                                    <select name="unit" class="form-control txt-1">
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                @if ($clientFee->unit_id == $unit->id)
                                                    selected="selected"
                                                @endif
                                            >{{ ucfirst($unit->name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center"><button type="submit" class="btn btn-primary txt-1">Update</button></td>
                            </form>
                            <form method="post" action="{{ route('accountmanager.client.fee.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="fee_id" value="{{ $clientFee->id }}" />
                                <td class="text-center"><button type="submit" class="btn btn-danger txt-1">Delete</button></td>
                            </form>
                        </tr>

                    @endforeach
                </tbody>
            </table>

            <hr class="w-100" />

            <div class="card">
                <div class="card-header marsman-bg-color-dark py-3">
                    <p class="h4 text-white">Add New Fee</p>
                </div>
                <div class="card-body marsman-bg-color-lightblue">

                    <form action="{{ route('accountmanager.client.fee.create') }}" method="POST">
                        @csrf

                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Category</label>
                            <select name="category_id" class="form-control marsman-border-primary-1 bg-white txt-1" id="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? "selected" : "" }}>{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="route_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Route</label>
                            <select name="route_id" class="form-control marsman-border-primary-1 bg-white txt-1" id="route_id">
                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>{{ ucfirst($route->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="route_type_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Route Type</label>
                            <div class="d-flex p-2">
                                @foreach($routeTypes as $routeType)
                                    <div class="form-check mx-2">
                                        <input class="form-check-input" type="radio" name="route_type_id" value="{{ $routeType->id }}" checked>
                                        <label class="form-check-label" for="route_type_id">
                                            {{ ucfirst($routeType->name) }}
                                        </label>
                                    </div>
                                @endforeach
                                <div class="form-check mx-1">
                                    <i class="far fa-question-circle" onclick="openLightbox()" style='font-size:18px; cursor: pointer'></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Description</label>
                            <input type="text" name="description" class="form-control marsman-border-primary-1 bg-white txt-1" id="description" value="{{ old('description') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="source_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Source</label>
                            <select name="source_id" class="form-control marsman-border-primary-1 bg-white txt-1" id="source_id">
                                @foreach($sources as $source)
                                    <option value="{{ $source->id }}" {{ old('source_id') == $source->id ? 'selected' : '' }}>{{ ucfirst($source->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="currency" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Currency</label>
                            <select name="currency" class="form-control marsman-border-primary-1 bg-white txt-1" id="currency">
                                <option value="{{ __('PHP') }}" {{ old('currency') == __('PHP') ? 'selected' : '' }}>{{ __('PHP') }}</option>
                                <option value="{{ __('USD') }}" {{ old('currency') == __('USD') ? 'selected' : '' }}>{{ __('USD') }}</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="amount" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Amount</label>
                            <input type="text" name="amount" class="form-control marsman-border-primary-1 bg-white txt-1" id="amount" value="0">
                        </div>

                        <div class="form-group mb-3">
                            <label for="percentage" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Percentage</label>
                            <input type="text" name="percentage" class="form-control marsman-border-primary-1 bg-white txt-1" id="percentage" value="0">
                        </div>

                        <div class="form-group mb-3">
                            <label for="vat" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">VAT</label>
                            <div class="p-2 d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="vat" id="nonVat" value="0" checked>
                                    <label class="form-check-label" for="nonVat">
                                        Non-VAT
                                    </label>
                                </div>
                                <div class="form-check mx-3">
                                    <input class="form-check-input" type="radio" name="vat" id="vat" value="1">
                                    <label class="form-check-label" for="vat">
                                        VAT
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="unit" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Source</label>
                            <select name="unit" class="form-control marsman-border-primary-1 bg-white txt-1" id="unit">
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ ucfirst($unit->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn marsman-btn-primary m-2">Save</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Lightbox -->
<div id="lightbox" class="lightbox">
    <div class="lightbox-content">
        <span class="close-btn" onclick="closeLightbox()">&times;</span>
        <h2>DEFINITION OF TERMS</h2>
        <p>Transaction is defined as every ticket issued whether long or short haul; economy, business or first class; one-way or round-trip. A ticket once issued whether cancelled or rebooked will already be charged the corresponding transaction fee.</p>
        <p>Short haul destinations cover the Southeast Asian Region including China, Hong Kong, Macau and Taiwan, Japan and South Korea.</p>
        <p>Long haul destinations cover Europe, Middle East, Africa & India, North & South America, Australia & New Zealand, and all other destinations not included in the short haul definition.</p>
        <p>Domestic travel is considered travel within the Philippines.</p>
    </div>
</div>

<style>
/* Lightbox styles */
.lightbox {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.lightbox-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    text-align: left;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}
</style>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#feesTable').DataTable({
            "pageLength": 10, // Number of items per page
            "pagingType": "simple_numbers", // Type of pagination
            "lengthMenu": [10, 20, 30, 40], // Dropdown for changing items per page
        });
    });

    function openLightbox() {
        document.getElementById('lightbox').style.display = 'block';
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }

    // Close the lightbox if the user clicks outside the content
    window.onclick = function(event) {
        var lightbox = document.getElementById('lightbox');
        if (event.target == lightbox) {
            lightbox.style.display = 'none';
        }
    };
</script>

@endsection
