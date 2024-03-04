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
            
            <div class="h3">INVOICE ATTACHMENT - {{ $client['name'] }}</div>
            <hr class="w-100" />

            <div class="container">

                <table class="table table-bordered">
                    <thead class="marsman-bg-color-dark text-white">
                        <tr>
                            <th>ID</th>
                            <th>Schedule</th>
                            <th>Description File</th>
                            <th>Email Approval File</th>
                            <th>Purchase Order File</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientInvoiceAttachments as $attachment)
                        <tr>
                            <td>{{ $attachment->id }}</td>
                            <td>{{ $attachment->schedule }}</td>
                            <td><a href="{{ asset($attachment->description_path) }}" target="_blank">{{ basename($attachment->description_path) }}</a></td>
                            <td><a href="{{ asset($attachment->email_approval_path) }}" target="_blank">{{ basename($attachment->email_approval_path) }}</a></td>
                            <td><a href="{{ asset($attachment->purchase_order_path) }}" target="_blank">{{ basename($attachment->purchase_order_path) }}</a></td>
                            <td>{{ $attachment->remarks }}</td>
                            <td>
                                @if ($attachment->status_id === 1)
                                <span class="badge rounded-pill bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('accountmanager.client.invoice_attachments.update_status', $attachment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                    
                                    <div class="form-group mb-0">
                                        <select name="new_status" class="form-control marsman-border-primary-1 bg-white txt-1">
                                            <option value="0" {{ $attachment->status_id == 1 ? 'selected' : '' }}>Inactive</option>
                                            <option value="1" {{ $attachment->status_id == 2 ? 'selected' : '' }}>Active</option>
                                        </select>
                                    </div>
                    
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Update Status</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr class="w-100" />

                <div class="card">
                    <div class="card-header marsman-bg-color-dark text-white">
                        <p class="h4 mt-2">Add Client Invoice Attachment</p>
                    </div>
                    <div class="card-body marsman-bg-color-lightblue">
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

                        <form action="{{ route('accountmanager.client.invoice_attachment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="client_id" id="client_id" value="{{ $clientId }}" />

                            <div class="form-group mb-3">
                                <label for="schedule" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Schedule</label>
                                <input type="text" name="schedule" id="schedule" class="form-control marsman-border-primary-1 bg-white txt-1" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description_path" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Description File</label>
                                <input type="file" name="description_path" id="description_path" class="form-control marsman-border-primary-1 bg-white txt-1" accept=".pdf, .doc, .docx">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email_approval_path" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Email Approval File</label>
                                <input type="file" name="email_approval_path" id="email_approval_path" class="form-control marsman-border-primary-1 bg-white txt-1" accept=".pdf, .doc, .docx">
                            </div>

                            <div class="form-group mb-3">
                                <label for="purchase_order_path" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Purchase Order File</label>
                                <input type="file" name="purchase_order_path" id="purchase_order_path" class="form-control marsman-border-primary-1 bg-white txt-1" accept=".pdf, .doc, .docx">
                            </div>

                            <div class="form-group mb-3">
                                <label for="remarks" class="form-label marsman-bg-color-dark text-white p-2 rounded-top m-0">Remarks</label>
                                <textarea name="remarks" id="remarks" class="form-control marsman-border-primary-1 bg-white txt-1" rows="4"></textarea>
                            </div>

                            <button type="submit" class="btn marsman-btn-primary m-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
