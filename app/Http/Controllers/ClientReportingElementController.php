<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientReportingElement;
use Illuminate\Http\Request;

class ClientReportingElementController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'reportCode' => 'required|string',
                'description' => 'required|string',
            ]);

            // Get clientID
            $clientId = $request->input('clientId');
            $client = Client::find($clientId);

            // Insert data
            $elements = new ClientReportingElement;

            $elements->create([
                'client_id' => $clientId,
                'report_code' => $validatedData['reportCode'],
                'description' => $validatedData['description'],
            ]);

            // Log activity
            logUserActivity(auth()->user()->id,
                'create-client-reporting-element',
                'Created '.strtoupper($validatedData['reportCode']).' = \''.strtoupper($validatedData['description']).'\' Reporting Element for client \''. $client->name.'\''
            );

            return redirect()->back()->with('success', 'Added new reporting element');

        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Failed adding element. '.$e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {

            $request->validate([
                'description' => 'required|string',
            ]);

            $elementId = $request->input('elementId');

            // Get record
            $reportingElements = ClientReportingElement::findOrFail($elementId);

            // Update record
            $reportingElements->update([
                'description' => $request->input('description'),
            ]);

            // Log activity
            logUserActivity(auth()->user()->id,
                'update-client-reporting-element',
                'Updated '.strtoupper($reportingElements->report_code).' = \''.strtoupper($reportingElements->description).'\' Reporting Element for client \''. $reportingElements->client->name.'\''
            );

            return redirect()->back()->with('success', 'Record updated successfully.');

        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'Error updating record - '. $e->getMessage() );
        }
    }

    public function destroy(Request $request)
    {
        try {
            $elementId = $request->input('elementId');

            $reportElement = ClientReportingElement::findOrFail($elementId);

            $reportElement->delete();

            // Log activity
            logUserActivity(auth()->user()->id,
                'delete-client-reporting-element',
                'Deleted '.strtoupper($reportElement->report_code).' = \''.strtoupper($reportElement->description).'\' Reporting Element for client \''. $reportElement->client->name.'\''
            );

            return redirect()->back()->with('success', 'Reporting element deleted');

        } catch(\Exception $e) {

            return redirect()->back()->with('error', 'Failed deleting record. '.$e->getMessage());

        }
    }
}
