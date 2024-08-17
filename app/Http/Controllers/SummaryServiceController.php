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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SummaryService  $summaryService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SummaryService $summaryService)
    {
        try {
            $validatedData = $request->validate([
                'clientId' => 'required|integer',
                'headerId' => 'nullable|required|integer',
                'subheaderId' => 'nullable|required|integer',
                'service' => 'required|string|max:255',
                'measure' => 'nullable|string|max:50',
                'currency' => 'nullable|string|max:10',
                'officeHours' => 'nullable|string|max:100',
                'afterOfficeHours' => 'nullable|string|max:100',
            ]);

            $summaryService->update([
                'client_id' => $validatedData['clientId'],
                'header_id' => $validatedData['headerId'],
                'subheader_id' => $validatedData['subheaderId'],
                'service_name' => $validatedData['service'],
                'measure' => $validatedData['measure'],
                'currency' => $validatedData['currency'],
                'office_hours' => $validatedData['officeHours'],
                'after_office_hours' => $validatedData['afterOfficeHours'],
            ]);

            return response()->json(['message' => 'Summary Service updated successfully', 'data' => $summaryService], 200);
        } catch (Exception $e) {
            Log::error('Failed to update Summary Service: ' . $e->getMessage(), [
                'summaryService_id' => $summaryService->id,
                'request' => $request->all(),
                'error' => $e->getTraceAsString(),
            ]);

            return response()->json(['message' => 'Failed to update Summary Service'], 500);
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
