<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientInvoiceAttachment;

class ClientInvoiceAttachmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'schedule' => 'required',
                'description_path' => 'file|mimes:pdf,doc,docx|max:2048',
                'email_approval_path' => 'file|mimes:pdf,doc,docx|max:2048',
                'purchase_order_path' => 'file|mimes:pdf,doc,docx|max:2048',
                'remarks' => 'nullable',
            ]);

            // Create a new client invoice attachment
            $attachment = new ClientInvoiceAttachment();
            $attachment->client_id = $request->input('client_id');
            $attachment->schedule = $request->input('schedule');
            $attachment->remarks = $request->input('remarks');
            $attachment->status_id = $request->input('status_id', 1); // Default value of 1

            // Handle file uploads for description_path
            if ($request->hasFile('description_path')) {
                $descriptionPath = $request->file('description_path')->store('attachments', 'public');
            } else {
                $descriptionPath = '';
            }
            $attachment->description_path = $descriptionPath;

            // Handle file uploads for email_approval_path
            if ($request->hasFile('email_approval_path')) {
                $emailApprovalPath = $request->file('email_approval_path')->store('attachments', 'public');
            } else {
                $emailApprovalPath = '';
            }
            $attachment->email_approval_path = $emailApprovalPath;

            // Handle file uploads for purchase_order_path
            if ($request->hasFile('purchase_order_path')) {
                $purchaseOrderPath = $request->file('purchase_order_path')->store('attachments', 'public');
            } else {
                $purchaseOrderPath = '';
            }
            $attachment->purchase_order_path = $purchaseOrderPath;

            $attachment->save();

            //log activity
            logUserActivity(auth()->user()->id, 
                'create-client-invoice-attachment', 
                'Added Invoice Attachment ID# \''.$attachment->id.'\' on client: '.$attachment->client->name
            );

            // Redirect to a success page or show a success message
            return redirect()->back()->with('success', 'Client Invoice Attachment created successfully.');
        } catch (\Exception $e) {
            // Handle exceptions, log the error or redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while creating the client invoice attachment. '. $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'new_status' => 'required|numeric', // Assuming the new status is a numeric value
            ]);

            // Find the client invoice attachment by ID
            $attachment = ClientInvoiceAttachment::findOrFail($id);

            // Update the status
            $attachment->status_id = $request->input('new_status');
            $attachment->save();

            // Log activity
            logUserActivity(auth()->user()->id,
                'update-client-invoice-attachment-status',
                'Updated status of Invoice Attachment ID# \'' . $attachment->id . '\' on client: ' . $attachment->client->name
            );

            // Redirect to a success page or show a success message
            return redirect()->back()->with('success', 'Status updated successfully.');
        } catch (\Exception $e) {
            // Handle exceptions, log the error or redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while updating the status. ' . $e->getMessage());
        }
    }

}
