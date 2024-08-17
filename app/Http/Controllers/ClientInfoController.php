<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientInfo;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ClientInfoController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'clientId' => 'required|integer',
                'sap_id' => 'nullable|string',
                'clientType' => 'nullable|integer',
                'globalCustomerNumber' => 'nullable|string',
                'contractStartDate' => 'nullable|string', // Expecting dd/mm/yyyy
                'contractEndDate' => 'nullable|string', // Expecting dd/mm/yyyy
                'creditTerm' => 'nullable|string',
                'creditLimitUSD' => 'nullable|integer',
                'creditLimitPHP' => 'nullable|integer',
                'submittedQuotation' => 'nullable|integer',
                'slaResponseTimeInt' => 'nullable|integer',
                'slaResponseTimeDom' => 'nullable|integer',
                'billingCurrency' => 'nullable|string',
                'valueAddedTax' => 'nullable|string',
                'formOfRefund' => 'nullable|string',
                'agentCommission' => 'nullable|string',
                'reportsDeadline' => 'nullable|string',
                'reportFrequency' => 'nullable|string',
                'submissionDate' => 'nullable|string', // Expecting dd/mm/yyyy
            ]);

            // Convert date fields from dd/mm/yyyy to yyyy-mm-dd
            $data = $this->convertDates($validatedData);

            // Assign input fields
            $data = array_merge($data, [
                'client_id' => $request->input('clientId'),
                'client_type_id' => $request->input('clientType'),
                'global_customer_number' => strtoupper($request->input('globalCustomerNumber')),
                'credit_term' => $request->input('creditTerm'),
                'credit_limit_usd' => $request->input('creditLimitUSD'),
                'credit_limit_php' => $request->input('creditLimitPHP'),
                'submitted_quotation' => $request->input('submittedQuotation'),
                'sla_response_time_int' => $request->input('slaResponseTimeInt'),
                'sla_response_time_dom' => $request->input('slaResponseTimeDom'),
                'billing_currency' => $request->input('billingCurrency'),
                'value_added_tax' => $request->input('valueAddedTax'),
                'form_of_refund' => $request->input('formOfRefund'),
                'agent_commission' => $request->input('agentCommission'),
                'reports_deadline' => $request->input('reportsDeadline'),
                'report_frequency' => $request->input('reportFrequency'),
                'submission_date' => $request->input('submissionDate'),
            ]);

            // Data for client
            $data_client = [
                'sap_id' => strtoupper($request->input('sap_id')),
            ];

            // Find or create record
            $clientInfo = ClientInfo::find($request->input('clientInfoId'));

            if (!$clientInfo) {
                // If the record does not exist, create a new one
                $clientInfo = ClientInfo::create($data);
            } else {
                // If the record exists, update it
                $clientInfo->update($data);
            }

            // Get client
            $client = Client::find($clientInfo->client->id);
            if ($client) {
                $client->update($data_client);
            }

            // Log activity
            logUserActivity(auth()->user()->id, 'update-client-info', 'Updated client - ' . $client->name . '\'s information');

            return redirect()->back()->with('success', 'Update Success');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed. ' . $e->getMessage());
        }
    }

    private function convertDates($data)
    {
        $dateFields = ['contractStartDate', 'contractEndDate']; // Add more date fields if necessary
        foreach ($dateFields as $field) {
            if (isset($data[$field]) && !empty($data[$field])) {
                $date = \DateTime::createFromFormat('d/m/Y', $data[$field]);
                if ($date) {
                    $data[$field] = $date->format('Y-m-d');
                }
            }
        }
        return $data;
    }

}



