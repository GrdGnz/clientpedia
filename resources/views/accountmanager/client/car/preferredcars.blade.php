@php
    $page = 'preferredCars';
@endphp

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

            <div class="h3">PREFERRED CARS - {{ $client['name'] }}</div>
            <hr class="w-100" />

            @if (session('success'))
                <div class="alert alert-success txt-2">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger txt-2">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger txt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="editCar" tabindex="-1" aria-labelledby="editCarLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editCarLabel">Update Car</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editPreferredCar" method="POST" action="">
                                @csrf
                                @method('PUT')

                                <input type="hidden" id="preferred_car_id" name="preferred_car_id" value="">
                                <input type="hidden" name="client_id" value="{{ $client['id'] }}">

                                <div class="form-group p-2">
                                    <label for="edit_car" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">* Car:</label>
                                    <input type="text" class="form-control marsman-border-primary-1 txt-1" id="edit_car" name="edit_car">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_snapcode" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">* Snap Code:</label>
                                    <input type="text" class="form-control marsman-border-primary-1 txt-1" id="edit_snapcode" name="edit_snapcode">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_contact_person" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Department:</label>
                                    <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="edit_contact_person" name="edit_contact_person" value="">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_contact_number" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Contact Number:</label>
                                    <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="edit_contact_number" name="edit_contact_number" value="">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_contact_email" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Email:</label>
                                    <input type="email" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="edit_contact_email" name="edit_contact_email" value="">
                                </div>

                                <div class="form-group w-100 text-center">
                                    <button type="submit" class="btn marsman-btn-primary m-2">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 d-flex">
                <div class="col-md-4">
                    <form action="{{ route('accountmanager.client.preferred_cars.upload', $client->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="marsman-border-primary-1 p-2">
                            <label for="file">Upload Excel File</label>
                            <input type="file" class="txt-1" id="file" name="file" required>
                            <button type="submit" class="btn marsman-btn-primary txt-1">Upload</button>
                        </div>
                    </form>
                </div>

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
                                <form action="{{ route('client.preferred_cars_upload.destroy', $upload->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger txt-1" onclick="return confirm('Are you sure you want to delete this file?');">Delete</button>
                                </form>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <hr class="w-100">

            <div class="row col-md-12">

                <div class="card col-md-6">
                    <div class="card-header marsman-bg-color-dark text-white">
                        <span class="h5">Add Preferred Car</span>
                    </div>
                    <div class="card-body marsman-bg-color-lightblue p-2">

                        <form method="POST" action="{{ route('accountmanager.client.preferred_cars.create') }}">
                            @csrf

                            {{-- Client ID --}}
                            <input type="hidden" name="client_id" value="{{ $client['id'] }}">

                            {{-- Car --}}
                            <div class="form-group p-2">
                                <label for="car" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">* Car:</label>
                                <input type="text" class="form-control marsman-border-primary-1 txt-1" id="car" name="car">
                            </div>

                            {{-- Snap Code --}}
                            <div class="form-group p-2">
                                <label for="snapcode" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Snap Code:</label>
                                <input type="text" class="form-control marsman-border-primary-1 txt-1" id="snapcode" name="snapcode">
                            </div>

                            {{-- Contact Person --}}
                            <div class="form-group p-2">
                                <label for="contactPerson" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Contact Person:</label>
                                <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="contactPerson" name="contactPerson" value="{{ old('contactPerson') }}" placeholder="Enter contact person">
                            </div>

                            {{-- Contact Number --}}
                            <div class="form-group p-2">
                                <label for="contactNumber" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Contact Number:</label>
                                <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="contactNumber" name="contactNumber" value="{{ old('contactNumber') }}" placeholder="Enter contact number">
                            </div>

                            {{-- Contact Email --}}
                            <div class="form-group p-2">
                                <label for="contactEmail" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Contact Email:</label>
                                <input type="email" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="contactEmail" name="contactEmail" value="{{ old('contactEmail') }}" placeholder="Enter contact email">
                            </div>

                            <div class="form-group w-100 text-center">
                                <button type="submit" class="btn marsman-btn-primary m-2">Add Car</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="table-responsive col-md-6">
                    <table id="contactTable" class="table table-striped table-bordered">
                        <thead class="marsman-bg-color-dark text-white pt-3">
                            <tr>
                                <th>CAR</th>
                                <th>SNAP CODE</th>
                                <th>CONTACT PERSON</th>
                                <th>CONTACT NUMBER</th>
                                <th>CONTACT EMAIL</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($preferredCars as $preferred)
                                <tr>
                                    <td>{{ $preferred->car_code }}</td>
                                    <td>{{ $preferred->snap_code }}</td>
                                    <td>{{ $preferred->contact_person }}</td>
                                    <td>{{ $preferred->contact_number }}</td>
                                    <td>{{ $preferred->contact_email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary txt-1" data-bs-toggle="modal" data-bs-target="#editCar"
                                            data-id="{{ $preferred->id }}"
                                            data-car_code="{{ $preferred->car_code }}"
                                            data-snap_code="{{ $preferred->snap_code }}"
                                            data-contact_person="{{ $preferred->contact_person }}"
                                            data-contact_number="{{ $preferred->contact_number }}"
                                            data-contact_email="{{ $preferred->contact_email }}">
                                            Update
                                        </button>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('accountmanager.client.preferred_cars.destroy', $preferred->id) }}" onsubmit="return confirm('Are you sure you want to delete this preferred airline?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger txt-1">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    .file-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .file-item a {
        margin-right: 10px;
    }
</style>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#contactTable').DataTable();

        $('#editCar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            var id = button.data('id');
            var car_code = button.data('car_code');
            var snap_code = button.data('snap_code');
            var contact_person = button.data('contact_person');
            var contact_number = button.data('contact_number');
            var contact_email = button.data('contact_email');

            modal.find('#editPreferredCar').attr('action', '{{ url('account-manager/client/preferred-cars') }}/' + id);
            modal.find('#preferred_car_id').val(id);
            modal.find('#edit_car').val(car_code);
            modal.find('#edit_snapcode').val(snap_code);
            modal.find('#edit_contact_person').val(contact_person);
            modal.find('#edit_contact_number').val(contact_number);
            modal.find('#edit_contact_email').val(contact_email);
        });


    });
</script>

@endsection
