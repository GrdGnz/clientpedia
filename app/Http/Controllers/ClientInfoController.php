<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientInfo;
use App\Models\Client;

class ClientInfoController extends Controller
{
    public function update(Request $request)
    {
        try {
            // Validate data with optional rules
            $validatedData = $request->validate([
                'clientId'  =>  'required|integer',
                'sap_id' => 'nullable|string',
                'clientType' => 'nullable|integer',
                'globalCustomerNumber' => 'nullable|string',
                'contractStartDate' => 'nullable|date',
                'contractEndDate' => 'nullable|date|after:contractStartDate',
                'creditTerm' => 'nullable|integer',
                'creditLimitUSD' => 'nullable|integer',
                'creditLimitPHP' => 'nullable|integer',
                'submittedQuotation' => 'nullable|integer',
                'slaResponseTimeInt' => 'nullable|integer',
                'slaResponseTimeDom' => 'nullable|integer',
                'billingCurrency' => 'nullable|string',
                'valueAddedTax' => 'nullable|string',
                'transactionFee' => 'nullable|string',
                'agentCommission' => 'nullable|string',
            ]);

            // Assign input fields
            $data = [
                'client_id' =>  $request->input('clientId'),
                'client_type_id' => $request->input('clientType'),
                'global_customer_number' => strtoupper($request->input('globalCustomerNumber')),
                'contract_start_date' => $request->input('contractStartDate'),
                'contract_end_date' => $request->input('contractEndDate'),
                'credit_term' => $request->input('creditTerm'),
                'credit_limit_usd' => $request->input('creditLimitUSD'),
                'credit_limit_php' => $request->input('creditLimitPHP'),
                'submitted_quotation' => $request->input('submittedQuotation'),
                'sla_response_time_int' => $request->input('slaResponseTimeInt'),
                'sla_response_time_dom' => $request->input('slaResponseTimeDom'),
                'billing_currency' => $request->input('billingCurrency'),
                'value_added_tax' => $request->input('valueAddedTax'),
                'transaction_fee' => $request->input('transactionFee'),
                'agent_commission' => $request->input('agentCommission'),
            ];

            // Data for client
            $data_client = [
                'sap_id' =>  strtoupper($request->input('sap_id')),
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
}



