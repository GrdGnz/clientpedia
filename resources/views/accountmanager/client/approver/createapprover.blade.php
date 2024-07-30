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

            <div class="h3">APPROVERS - {{ $client['name'] }}</div>
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
            <div class="modal fade" id="editApprover" tabindex="-1" aria-labelledby="editApproverLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editApproverLabel">Update Client Approver</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editApproverForm" method="POST" action="">
                                @csrf
                                @method('PUT')

                                <input type="hidden" id="approverId" name="approverId" value="">
                                <input type="hidden" name="client_id" value="{{ $client['id'] }}">

                                <div class="form-group p-2">
                                    <label for="edit_name" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">* Name:</label>
                                    <input type="text" class="form-control marsman-border-primary-1 txt-1" id="edit_name" name="name" placeholder="Enter name" value="">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_designation" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Designation:</label>
                                    <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="edit_designation" name="designation" value="" placeholder="Enter designation">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_department" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Department:</label>
                                    <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="edit_department" name="department" value="" placeholder="Enter department">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_contact_mobile" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Contact Number:</label>
                                    <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="edit_contact_mobile" name="contact_mobile" value="" placeholder="Enter mobile number">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_email" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Email:</label>
                                    <input type="email" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="edit_email" name="email" value="" placeholder="Enter email">
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_approver_level" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Approver Level:</label>
                                    <input type="number" min="1" max="3" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="edit_approver_level" name="approver_level" value=""></input>
                                </div>

                                <div class="form-group p-2">
                                    <label for="edit_status_id" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Status:</label>
                                    <div class="form-switch txt-3 marsman-border-primary-1 txt-1 bg-white rounded-bottom py-2">
                                        <!-- Hidden input to send 0 if unchecked -->
                                        <input type="hidden" id="edit_status_id_hidden" name="status_id" value="0">
                                        <input class="form-check-input marsman-border-primary-1 txt-1" type="checkbox" id="edit_status_id" name="status_id" value="1">
                                        <label class="form-check-label txt-1" for="edit_status_id">Active</label>
                                    </div>
                                </div>

                                <div class="form-group w-100 text-center">
                                    <button type="submit" class="btn marsman-btn-primary m-2">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row col-md-12">

                <div class="card col-md-6">
                    <div class="card-header marsman-bg-color-dark text-white">
                        <span class="h5">Create New Client Approver</span>
                    </div>
                    <div class="card-body marsman-bg-color-lightblue p-2">

                        <form method="POST" action="{{ route('accountmanager.client.approver.create') }}">
                            @csrf

                            {{-- Client ID --}}
                            <input type="hidden" name="client_id" value="{{ $client['id'] }}">

                            {{-- Client Name --}}
                            <div class="form-group p-2">
                                <label for="name" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">* Name:</label>
                                <input type="text" class="form-control marsman-border-primary-1 txt-1" id="name" name="name" placeholder="Enter name" value="{{ old('approverName') }}">
                            </div>

                            {{-- Designation --}}
                            <div class="form-group p-2">
                                <label for="designation" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Designation:</label>
                                <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="designation" name="designation" value="{{ old('approverDesignation') }}" placeholder="Enter designation">
                            </div>

                            {{-- Department --}}
                            <div class="form-group p-2">
                                <label for="department" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Department:</label>
                                <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="department" name="department" value="{{ old('approverDepartment') }}" placeholder="Enter department">
                            </div>

                            {{-- Mobile Number --}}
                            <div class="form-group p-2">
                                <label for="contact_mobile" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Contact Number:</label>
                                <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="contact_mobile" name="contact_mobile" value="{{ old('approverMobile') }}" placeholder="Enter mobile number">
                            </div>

                            {{-- Email --}}
                            <div class="form-group p-2">
                                <label for="email" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Email:</label>
                                <input type="email" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="email" name="email" value="{{ old('approverEmail') }}" placeholder="Enter email">
                            </div>

                            {{-- Approver Level --}}
                            <div class="form-group p-2">
                                <label for="approver_level" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Approver Level:</label>
                                <select class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="approver_level" name="approver_level">
                                    <option value="1">Approver 1</option>
                                    <option value="2">Approver 2</option>
                                    <option value="3">Approver 3</option>
                                </select>
                            </div>

                            {{-- Status --}}
                            <div class="form-group p-2">
                                <label for="status_id" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Status:</label>
                                <div class="form-switch txt-3 marsman-border-primary-1 txt-1 bg-white rounded-bottom py-2">
                                    <input type="hidden" name="status_id" value="0">
                                    <input class="form-check-input marsman-border-primary-1 txt-1" type="checkbox" name="status_id" id="status_id" value="1" {{ old('approverStatus') ? 'checked' : '' }}>
                                    <label class="form-check-label txt-1" for="status_id">Active</label>
                                </div>
                            </div>
                            <div class="form-group w-100 text-center">
                                <button type="submit" class="btn marsman-btn-primary m-2">Create Client Approver</button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="table-responsive col-md-6">
                    <table id="approverTable" class="table table-striped table-bordered">
                        <thead class="marsman-bg-color-dark text-white pt-3">
                            <tr>
                                <th>NAME</th>
                                <th>DESIGNATION</th>
                                <th>DEPARTMENT</th>
                                <th>CONTACT NO.</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvers as $approver)
                            <tr>
                                <td>{{ $approver->name }}</td>
                                <td>{{ $approver->designation }}</td>
                                <td>{{ $approver->department }}</td>
                                <td>{{ $approver->contact_mobile }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary txt-1" data-bs-toggle="modal" data-bs-target="#editApprover"
                                        data-id="{{ $approver->id }}"
                                        data-name="{{ $approver->name }}"
                                        data-designation="{{ $approver->designation }}"
                                        data-department="{{ $approver->department }}"
                                        data-contact_mobile="{{ $approver->contact_mobile }}"
                                        data-email="{{ $approver->email }}"
                                        data-approver_level="{{ $approver->approver_level }}"
                                        data-status_id="{{ $approver->status_id }}">
                                        Update
                                    </button>
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

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#approverTable').DataTable();

        $('#editApprover').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            var id = button.data('id');
            var name = button.data('name');
            var designation = button.data('designation');
            var department = button.data('department');
            var contact_mobile = button.data('contact_mobile');
            var email = button.data('email');
            var approver_level = button.data('approver_level');
            var status_id = button.data('status_id');

            modal.find('#editApproverForm').attr('action', '{{ url('account-manager/clients/approver/update') }}/' + id);
            modal.find('#approverId').val(id);
            modal.find('#edit_name').val(name);
            modal.find('#edit_designation').val(designation);
            modal.find('#edit_department').val(department);
            modal.find('#edit_contact_mobile').val(contact_mobile);
            modal.find('#edit_email').val(email);
            modal.find('#edit_approver_level').val(approver_level);

            // Set checkbox state
            modal.find('#edit_status_id').prop('checked', status_id == 1);
        });

    });
</script>


@endsection
