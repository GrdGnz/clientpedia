<?php

namespace App\Http\Controllers;

use App\Models\ClientPricingModel;
use App\Models\PricingmodelType;
use App\Models\Route;
use Illuminate\Http\Request;

class PricingmodelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        try {
            $clientId = $request->input('client_id');

            // Load Route model
            $route = Route::findOrFail($request->route_id);

            // Load Pricing Model Type model
            $pricingModelType = PricingmodelType::findOrFail($request->pricingmodel_type_id);
            
            $clientPricingModel = ClientPricingModel::firstOrNew([
                'client_id' => $clientId,
                'route_id' => $request->route_id,
            ]);
    
            $clientPricingModel->pricingmodel_type_id = $request->pricingmodel_type_id;
            $clientPricingModel->save();

            //log activity
            logUserActivity(auth()->user()->id, 'update-client-pricing-model', 
                'Set Pricing Model of client \''.$clientPricingModel->client->name.'\' into '
                .strtoupper($route->name).' - '.strtoupper($pricingModelType->name)
            );

    
            return redirect()->route('accountmanager.clients.pricingmodel', ['clientId' => $clientId])
                ->with('success', 'Client pricing model updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while updating the client pricing model: ' . $e->getMessage());
        }
    }
    
}
