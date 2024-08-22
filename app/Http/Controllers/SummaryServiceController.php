<?php

namespace App\Http\Controllers;

use App\Models\SummaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class SummaryServiceController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Determine headerId based on the subheaderId value
            if ($request->input('subheaderId') != '') {
                $headerId = null;
            } else {
                $headerId = $request->input('headerId');
            }

            // Create a new SummaryService
            $summaryService = SummaryService::create([
                'client_id' => $request->input('clientId'),
                'header_id' => $headerId,
                'subheader_id' => $request->input('subheaderId'),
                'service_name' => $request->input('services'),
                'measure' => $request->input('measure'),
                'currency' => $request->input('currency'),
                'office_hours' => $request->input('officeHours'),
                'after_office_hours' => $request->input('afterOfficeHours'),
            ]);

            return redirect()->back()->with('success', 'Data saved successfully');

        } catch (Exception $e) {
            // Log the error details
            Log::error('Failed to create Summary Service: ' . $e->getMessage(), [
                'request' => $request->all(),
                'error' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Failed to create Summary Service: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'id' => 'required|exists:summary_services,id',
                'service_name' => 'required|string|max:255',
                'measure' => 'required|string|max:100',
                'currency' => 'required|string|max:10',
                'office_hours' => 'required|string|max:100',
                'after_office_hours' => 'required|string|max:100',
            ]);

            // Find the service record by ID
            $service = SummaryService::findOrFail($validatedData['id']);

            // Update the service record with the validated data
            $service->update([
                'service_name' => $validatedData['service_name'],
                'measure' => $validatedData['measure'],
                'currency' => $validatedData['currency'],
                'office_hours' => $validatedData['office_hours'],
                'after_office_hours' => $validatedData['after_office_hours'],
            ]);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Service updated successfully.');

        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Failed to update Summary Service: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update service.');
        }
    }


    public function destroy($id)
    {
        try {
            // Find the SummaryService record by its primary key
            $summaryService = SummaryService::find($id);

            // Check if the record exists
            if ($summaryService) {
                // Log the deletion action
                Log::info('Deleting SummaryService record', ['id' => $id]);

                // Delete the record
                $summaryService->delete();

                // Log the successful deletion
                Log::info('SummaryService record deleted successfully', ['id' => $id]);

                // Redirect back with a success message
                return redirect()->back()->with('success', 'Summary service deleted successfully.');
            } else {
                // Log the error if the record does not exist
                Log::warning('Attempted to delete non-existent SummaryService record', ['id' => $id]);

                // Redirect back with an error message
                return redirect()->back()->with('error', 'Summary service not found.');
            }
        } catch (Exception $e) {
            // Log the exception
            Log::error('Error deleting SummaryService record', [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);

            // Redirect back with a general error message
            return redirect()->back()->with('error', 'An error occurred while deleting the summary service.');
        }
    }
}
