@extends('layouts.app')

@section('content')
@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('accountmanager.sidebar')
    </div>
    <div id="layoutSidenav_content">
        <main class="p-3">
            <div class="h3">VIP - {{ $client['name'] }}</div>
            <hr class="w-100" />

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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
                <table id="viptable" class="table table-striped">
                    <thead class="marsman-bg-color-dark text-white pt-3">
                        <tr>
                            <th>NAME</th>
                            <th>DESIGNATION</th>
                            <th>CONTACT NO.</th>
                            <th>EMAIL</th>
                            <th>BIRTHDAY</th>
                            <th>STATUS</th>
                            <th>CHANGE STATUS</th>
                            <th>ACTIONS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vips as $vip)
                        <tr>
                            <td>{{ $vip->name }}</td>
                            <td>{{ $vip->designation }}</td>
                            <td>{{ $vip->contact_number }}</td>
                            <td>{{ $vip->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($vip->birthday)->format('F d, Y') }}</td></td>
                            <td class="text-center">
                                @if ($vip->status_id === 1)
                                <span class="badge rounded-pill bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                @endif    
                            </td>
                            <td>
                                <form action="{{ route('accountmanager.client.vip.update_status', ['clientId' => $clientId, 'vipId' => $vip->id]) }}" method="POST">
                                    @csrf
                                    <div class="justify-left">
                                        <input class="form-input p-2" type="radio" name="status_radio_{{ $vip->id }}" 
                                            value="1" {{ $vip->status_id === 1 ? 'checked' : '' }}
                                            data-vip-id="{{ $vip->id }}"
                                            data-client-id="{{ $clientId }}">
                                        <span class="form-label">Active</span>
                    
                                        <input class="form-input p-2" type="radio" name="status_radio_{{ $vip->id }}" 
                                            value="0" {{ $vip->status_id === 0 ? 'checked' : '' }}
                                            data-vip-id="{{ $vip->id }}"
                                            data-client-id="{{ $clientId }}">
                                        <span class="form-label">Inactive</span>
                                    
                      
                                        <button type="submit" class="btn btn-warning btn-sm rounded-pill m-2">Update</button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('accountmanager.client.vip.edit', ['clientVipId' => $vip->id]) }}" class="btn btn-primary btn-sm txt-2 rounded-pill">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('accountmanager.client.vip.destroy', ['clientId' => $clientId, 'vipId' => $vip->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE') <!-- Add this line to specify the DELETE method -->
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill txt-2">Delete</button>
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
                    <span class="h5">Create New Client VIP</span>
                </div>
                <div class="card-body marsman-bg-color-lightblue p-2">

                    <form method="POST" action="{{ route('accountmanager.client.vip.create') }}">
                        @csrf {{-- Laravel CSRF protection --}}
                        
                        {{-- Client ID --}}
                        <input type="hidden" name="client_id" value="{{ $clientId }}">
                        
                        {{-- Client Name --}}
                        <div class="form-group p-2">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                        </div>

                        {{-- Designation --}}
                        <div class="form-group p-2">
                            <label for="designation">Designation:</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation" required>
                        </div>

                        {{-- Contact Number --}}
                        <div class="form-group p-2">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter contact number">
                        </div>

                        {{-- Email --}}
                        <div class="form-group p-2">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>

                        {{-- Birthday --}}
                        <div class="form-group p-2">
                            <label for="birthday">Birthday:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                        </div>

                        {{-- Remarks --}}
                        <div class="form-group p-2">
                            <label for="remarks">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="4" placeholder="Enter remarks"></textarea>
                        </div>

                        {{-- Status --}}
                        <div class="form-group p-2">
                            <label for="status_id">Status:</label>
                            <div class="form-switch txt-3">
                                <input type="hidden" name="status_id" value="0">
                                <input class="form-check-input" type="checkbox" name="status_id" id="status_id" value="1" {{ old('status_id') ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_id">Active</label>
                            </div>
                        </div>

                        <button type="submit" class="btn marsman-btn-primary m-2">Create Client VIP</button>
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
        $('#viptable').DataTable();
    });
</script>

@endsection
