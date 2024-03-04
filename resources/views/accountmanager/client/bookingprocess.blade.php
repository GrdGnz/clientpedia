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
                
                <div class="container">
                    <p class="h3">
                        @if ($categoryId == 1)
                            AIR
                        @elseif ($categoryId == 2)
                            HOTEL
                        @elseif ($categoryId == 3)
                            CAR
                        @elseif ($categoryId == 4)
                            CAR TRANSFER
                        @elseif ($categoryId == 5)
                            DOCUMENTATION
                        @endif
                        BOOKING PROCESS - {{ $client['name'] }}</p>
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

                    <div class="table-responsive">
                        <p class="h5">International</p>
                        <table class="table table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr>
                                    <th>NO.</th>
                                    <th>DESCRIPTION</th>
                                    <th width="10%">Action 1</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($existingStepsInternational as $step)
                                    <form method="post" action="{{ route('accountmanager.client.booking_process.update') }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="clientId" value="{{ $client['id'] }}">
                                        <input type="hidden" name="orderNumber" value="{{ $step->order_number }}">
                                        <input type="hidden" name="routeId" value="1">
                                        <input type="hidden" name="categoryId" value="{{ $categoryId }}">
                                        <tr>
                                            <td>{{ $step->order_number }}</td>
                                            <td><input type="text" name="description" value="{{ $step->description }}"></td>
                                            <td><button type="submit" class="btn btn-primary txt-1">UPDATE</button></td>
                                        </form>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <p class="h5">Domestic</p>
                        <table class="table table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr>
                                    <th>NO.</th>
                                    <th>DESCRIPTION</th>
                                    <th width="10%">Action 1</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($existingStepsDomestic as $step)
                                <form method="post" action="{{ route('accountmanager.client.booking_process.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $step->id }}">
                                    <input type="hidden" name="clientId" value="{{ $client['id'] }}">
                                    <input type="hidden" name="orderNumber" value="{{ $step->order_number }}">
                                    <input type="hidden" name="routeId" value="2">
                                    <input type="hidden" name="categoryId" value="{{ $categoryId }}">
                                <tr>
                                    <td>{{ $step->order_number }}</td>
                                    <td><input type="text" name="description" value="{{ $step->description }}"></td>
                                    <td><button class="btn btn-primary txt-1">UPDATE</button></td>
                                </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <span class="m-3"></span>

                    <div class="card">
                        <div class="card-header marsman-bg-color-dark rounded">
                            <span class="h5 text-white">Modify Process</span>
                        </div>
                        <div class="card-body marsman-bg-color-lightblue">
                            @php
                                $numSteps = 1;
                            @endphp
                            
                            <form action="{{ route('accountmanager.client.booking_process.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name="client_id" value="{{ $clientId }}">
                                <input type="hidden" name="category_id" value="{{ $categoryId }}">
                                <input type="hidden" name="numSteps" value="{{ $numSteps }}">
                                
                                <div class="form-group mb-3">
                                    <label for="route_id" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Route</label>
                                    <select name="route_id" class="form-control marsman-border-primary-1 bg-white txt-1">
                                        @foreach ($routes as $route)
                                            <option value="{{ $route->id }}">{{ strtoupper($route->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div id="stepsContainer">
                                    @for ($i = 1; $i <= $numSteps; $i++)
                                    <div class="row" id="step{{ $i }}Row">
                                        <div class="col-md-6 rounded-start-pill">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text txt-1">Step {{ $i }}</span>
                                                <input type="text" class="form-control" id="step{{ $i }}" name="steps[]">
                                                <button type="button" class="btn btn-danger delete-step txt-1" data-step="{{ $i }}">DELETE</button>
                                                <button type="button" class="btn btn-primary add-step txt-1">ADD STEP</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            
                                <button type="submit" class="btn marsman-btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                    
                </div>

                <script>
                    var numSteps = {{ $numSteps }};
                    var stepsContainer = document.getElementById('stepsContainer');
                
                    document.addEventListener('click', function (event) {
                        if (event.target.classList.contains('delete-step')) {
                            var stepNumber = event.target.getAttribute('data-step');
                            var rowToRemove = document.getElementById('step' + stepNumber + 'Row');
                            if (rowToRemove) {
                                rowToRemove.remove();
                                renumberSteps();
                            }
                        } else if (event.target.classList.contains('add-step')) {
                            addStep();
                        }
                    });
                
                    function addStep() {
                        numSteps++;
                        var newRow = document.createElement('div');
                        newRow.classList.add('row');
                        newRow.id = 'step' + numSteps + 'Row';
                
                        var col = document.createElement('div');
                        col.classList.add('col-md-6');
                
                        var inputGroup = document.createElement('div');
                        inputGroup.classList.add('input-group', 'mb-3');
                
                        var span = document.createElement('span');
                        span.classList.add('input-group-text', 'txt-1');
                        span.textContent = 'Step ' + numSteps;
                
                        var input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.classList.add('form-control');
                        input.setAttribute('id', 'step' + numSteps);
                        input.setAttribute('name', 'steps[' + numSteps + ']');
                
                        var deleteButton = document.createElement('button');
                        deleteButton.setAttribute('type', 'button');
                        deleteButton.classList.add('btn', 'btn-danger', 'delete-step');
                        deleteButton.setAttribute('data-step', numSteps);
                        deleteButton.textContent = 'Delete';
                
                        var addButton = document.createElement('button');
                        addButton.setAttribute('type', 'button');
                        addButton.classList.add('btn', 'btn-primary', 'add-step');
                        addButton.textContent = 'Add Step';
                
                        inputGroup.appendChild(span);
                        inputGroup.appendChild(input);
                
                        // Check if it's the first step and hide the delete button
                        if (numSteps > 1) {
                            inputGroup.appendChild(deleteButton);
                        }
                
                        col.appendChild(inputGroup);
                        newRow.appendChild(col);
                
                        stepsContainer.appendChild(newRow);
                        renumberSteps();
                    }
                
                    function renumberSteps() {
                        var rows = document.querySelectorAll('.row[id^="step"]');
                        for (var i = 0; i < rows.length; i++) {
                            var stepNumber = i + 1;
                            var row = rows[i];
                            row.id = 'step' + stepNumber + 'Row';
                            row.querySelector('.input-group-text').textContent = 'Step ' + stepNumber;
                
                            // Update the data-step attribute for delete button
                            row.querySelector('.delete-step').setAttribute('data-step', stepNumber);
                
                            // Show or hide the delete button based on the step number
                            var deleteButton = row.querySelector('.delete-step');
                            if (stepNumber > 1) {
                                deleteButton.style.display = 'block';
                            } else {
                                deleteButton.style.display = 'none';
                            }
                        }
                    }
                </script>
                
            </main>
        </div>
    </div>
@endsection
