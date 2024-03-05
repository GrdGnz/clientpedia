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
            
            <div class="h3">CONTACTS - {{ $client['name'] }}</div>
            <hr class="w-100" />

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-responsive">
                <table id="contactTable" class="table table-striped">
                    <thead class="marsman-bg-color-dark text-white pt-3">
                        <tr>
                            <th>NAME</th>
                            <th>DESIGNATION</th>
                            <th>DEPARTMENT</th>
                            <th>LANDLINE NO.</th>
                            <th>MOBILE NO.</th>
                            <th>EMAIL</th>
                            <th>BIRTHDAY</th>
                            <th>ACTIONS</th>
                            <th></th>
                            <th>CHANGE STATUS</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr>
                            <form method="post" action="{{ route('accountmanager.client.contact.update') }}">
                                @csrf
                                @method('PUT')
                                <input name="contactId" type="hidden" value="{{ $contact->id }}" />
                            <td>
                                {{ $contact->name }}<br />
                                <input type="text" name="name" value="{{ $contact->name }}" /></td>
                            <td>
                                {{ $contact->designation }}<br />
                                <input type="text" name="designation" value="{{ $contact->designation }}" />
                            </td>
                            <td>
                                {{ $contact->department }}<br />
                                <input type="text" name="department" value="{{ $contact->department }}" />
                            </td>
                            <td>
                                {{ $contact->contact_landline }}<br />
                                <input type="text" name="contact_landline" value="{{ $contact->contact_landline }}" />
                            </td>
                            <td>
                                {{ $contact->contact_mobile }}<br />
                                <input type="text" name="contact_mobile" value="{{ $contact->contact_mobile }}" />
                            </td>
                            <td>
                                {{ $contact->email }}<br />
                                <input type="text" name="email" value="{{ $contact->email }}" />
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($contact->birthday)->format('Y-m-d') }}<br />
                                <input type="date" name="birthday" class="datepicker" value="{{ \Carbon\Carbon::parse($contact->birthday)->format('Y-m-d') }}" />
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-sm rounded txt-1 m-2">Update</a>
                            </td>
                            </form>
                            <td>
                                <form action="{{ route('accountmanager.client.contact.destroy', ['clientId' => $clientId, 'contactId' => $contact->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE') 
                                    <button type="submit" class="btn btn-danger btn-sm rounded txt-1 m-2">Delete</button>
                                </form>  
                            </td>
                            <td class="text-center">
                                @if ($contact->status_id === 1)
                                <span class="badge rounded-pill bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                @endif    
                            </td>
                            <td>
                                <form action="{{ route('accountmanager.client.contact.update_status', ['clientId' => $clientId, 'contactId' => $contact->id]) }}" method="POST">
                                    @csrf
                                    <div class="justify-left">
                                        <input class="form-input p-2" type="radio" name="status_radio_{{ $contact->id }}" 
                                            value="1" {{ $contact->status_id === 1 ? 'checked' : '' }}
                                            data-vip-id="{{ $contact->id }}"
                                            data-client-id="{{ $clientId }}">
                                        <span class="form-label">Active</span>
                                        <br>
                                        <input class="form-input p-2" type="radio" name="status_radio_{{ $contact->id }}" 
                                            value="0" {{ $contact->status_id === 0 ? 'checked' : '' }}
                                            data-vip-id="{{ $contact->id }}"
                                            data-client-id="{{ $clientId }}">
                                        <span class="form-label">Inactive</span>
                                    
                                        <button type="submit" class="btn btn-warning btn-sm rounded txt-1 m-2">Change</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <hr class="w-100" />

            <div class="card">
                <div class="card-header marsman-bg-color-dark text-white">
                    <span class="h5">Create New Client Contact</span>
                </div>
                <div class="card-body marsman-bg-color-lightblue p-2">

                    <form method="POST" action="{{ route('accountmanager.client.contact.create') }}">
                        @csrf 
                        
                        {{-- Client ID --}}
                        <input type="hidden" name="client_id" value="{{ $client['id'] }}">
                        
                        {{-- Client Name --}}
                        <div class="form-group p-2">
                            <label for="name" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Name:</label>
                            <input type="text" class="form-control marsman-border-primary-1 txt-1" id="name" name="name" placeholder="Enter name" required>
                        </div>

                        {{-- Designation --}}
                        <div class="form-group p-2">
                            <label for="designation" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Designation:</label>
                            <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="designation" name="designation" placeholder="Enter designation" required>
                        </div>

                        {{-- Department --}}
                        <div class="form-group p-2">
                            <label for="department" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Department:</label>
                            <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="department" name="department" placeholder="Enter department" required>
                        </div>

                        {{-- Landline Number --}}
                        <div class="form-group p-2">
                            <label for="contact_landline" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Landline Number:</label>
                            <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="contact_landline" name="contact_landline" placeholder="Enter landline number">
                        </div>

                        {{-- Mobile Number --}}
                        <div class="form-group p-2">
                            <label for="contact_mobile" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Mobile Number:</label>
                            <input type="text" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="contact_mobile" name="contact_mobile" placeholder="Enter mobile number">
                        </div>

                        {{-- Email --}}
                        <div class="form-group p-2">
                            <label for="email" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Email:</label>
                            <input type="email" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="email" name="email" placeholder="Enter email">
                        </div>

                        {{-- Birthday --}}
                        <div class="form-group p-2">
                            <label for="birthday" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Birthday:</label>
                            <input type="date" class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="birthday" name="birthday">
                        </div>

                        {{-- Remarks --}}
                        <div class="form-group p-2">
                            <label for="remarks" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Remarks:</label>
                            <textarea class="form-control marsman-border-primary-1 txt-1 rounded-bottom" id="remarks" name="remarks" rows="4" placeholder="Enter remarks"></textarea>
                        </div>

                        {{-- Status --}}
                        <div class="form-group p-2">
                            <label for="status_id" class="marsman-bg-color-dark text-white rounded-top p-2 m-0">Status:</label>
                            <div class="form-switch txt-3 marsman-border-primary-1 txt-1 bg-white rounded-bottom py-2">
                                <input type="hidden" name="status_id" value="0">
                                <input class="form-check-input marsman-border-primary-1 txt-1" type="checkbox" name="status_id" id="status_id" value="1" {{ old('status_id') ? 'checked' : '' }}>
                                <label class="form-check-label txt-1" for="status_id">Active</label>
                            </div>
                        </div>
                        <div class="w-100 text-center">
                            <button type="submit" class="btn marsman-btn-primary m-2">Create Client Contact</button>
                        </div>
                    </form>
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
        $('#contactTable').DataTable();
    });
</script>

@endsection
