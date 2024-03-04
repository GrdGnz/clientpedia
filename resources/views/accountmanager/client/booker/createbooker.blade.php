@extends('layouts.app')

@section('content')
    @include('layouts.topbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('accountmanager.sidebar')
        </div>
        <div id="layoutSidenav_content">
            <main class="p-3">

                <div class="container">
                    <p class="h3">CLIENT BOOKER / APPROVER - {{ $client['name'] }}</p>
                    <hr class="w-100" />

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr>
                                    <th>NO.</th>
                                    <th>DESCRIPTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($existingSteps as $step)
                                <tr>
                                    <td>{{ $step->order_number }}</td>
                                    <td>{{ $step->description }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <span class="m-3"></span>

                    <div class="card">
                        <div class="card-header marsman-bg-color-dark rounded">
                            <span class="h5 text-white">Modify Steps</span>
                        </div>
                        <div class="card-body marsman-bg-color-lightblue">
                            @php
                                $numSteps = 1;
                            @endphp
                            
                            <form action="{{ route('accountmanager.client.booker.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name="client_id" value="{{ $clientId }}">
                                <input type="hidden" name="numSteps" value="{{ $numSteps }}">
                            
                                <div id="stepsContainer">
                                    @for ($i = 1; $i <= $numSteps; $i++)
                                    <div class="row" id="step{{ $i }}Row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text txt-1">Step {{ $i }}</span>
                                                <input type="text" class="form-control" id="step{{ $i }}" name="steps[]">
                                                <button type="button" class="btn btn-danger delete-step" data-step="{{ $i }}">Delete</button>
                                                <button type="button" class="btn btn-primary add-step">Add Step</button>
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
                
                    document.addEventListener('click', function(event) {
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
                        inputGroup.appendChild(deleteButton);
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
                            row.querySelector('.delete-step').setAttribute('data-step', stepNumber);
                        }
                    }
                </script>
                
            </main>
        </div>
    </div>
@endsection
