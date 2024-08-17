<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SummaryServiceSeeder extends Seeder
{
    public function run()
    {
        // Get all client_ids except for client_id = 5
        $clients = DB::table('clients')->pluck('id');

        // Data to insert for each client_id
        $data = [
            [
                'header_id' => null,
                'subheader_id' => 1,
                'service_name' => 'GDS Booking',
                'measure' => 'per ticket',
                'currency' => 'PHP',
                'office_hours' => '500',
                'after_office_hours' => '800',
            ],
            [
                'header_id' => null,
                'subheader_id' => 1,
                'service_name' => 'Non-GDS / Online Ticket Purchase',
                'measure' => 'per ticket',
                'currency' => 'PHP',
                'office_hours' => '600',
                'after_office_hours' => '900',
            ],
            [
                'header_id' => null,
                'subheader_id' => 3,
                'service_name' => 'GDS Booking Short Haul',
                'measure' => 'per ticket',
                'currency' => 'PHP',
                'office_hours' => '1800',
                'after_office_hours' => '2100',
            ],
            [
                'header_id' => null,
                'subheader_id' => 3,
                'service_name' => 'GDS Booking Long Haul / Online Ticket Purchase',
                'measure' => 'per ticket',
                'currency' => 'PHP',
                'office_hours' => '2000',
                'after_office_hours' => '2300',
            ],
            [
                'header_id' => null,
                'subheader_id' => 3,
                'service_name' => 'Itinerary for Visa Purpose only (w/o ticket)',
                'measure' => 'per itinerary',
                'currency' => 'PHP',
                'office_hours' => '500',
                'after_office_hours' => '800',
            ],
            [
                'header_id' => null,
                'subheader_id' => 5,
                'service_name' => 'Rebooking & Reissuance of ticket / itinerary',
                'measure' => 'per transaction',
                'currency' => 'PHP',
                'office_hours' => 'As new transaction',
                'after_office_hours' => 'As new transaction',
            ],
            [
                'header_id' => null,
                'subheader_id' => 5,
                'service_name' => 'Refund Processing (Domestic)',
                'measure' => 'per ticket',
                'currency' => 'PHP',
                'office_hours' => '500',
                'after_office_hours' => 'n/a',
            ],
            [
                'header_id' => null,
                'subheader_id' => 5,
                'service_name' => 'Refund Processing (International)',
                'measure' => 'per ticket',
                'currency' => 'PHP',
                'office_hours' => '1800',
                'after_office_hours' => 'n/a',
            ],
            [
                'header_id' => null,
                'subheader_id' => 5,
                'service_name' => 'Same day cancellation / Voiding (Domestic)',
                'measure' => 'per ticket',
                'currency' => 'PHP',
                'office_hours' => '500',
                'after_office_hours' => 'n/a',
            ],
            [
                'header_id' => null,
                'subheader_id' => 5,
                'service_name' => 'Same day cancellation / Voiding (International)',
                'measure' => 'per ticket',
                'currency' => 'PHP',
                'office_hours' => '600',
                'after_office_hours' => 'n/a',
            ],
            [
                'header_id' => 3,
                'subheader_id' => null,
                'service_name' => 'Hotel Booking for Visa Application (w/o ticket)',
                'measure' => 'per itinerary',
                'currency' => 'PHP',
                'office_hours' => '500',
                'after_office_hours' => '750',
            ],
            [
                'header_id' => 3,
                'subheader_id' => null,
                'service_name' => 'Hotel/Car via GDS',
                'measure' => 'per room / car',
                'currency' => 'PHP',
                'office_hours' => '700',
                'after_office_hours' => '950',
            ],
            [
                'header_id' => 3,
                'subheader_id' => null,
                'service_name' => 'Hotel/Car via non-GDS',
                'measure' => 'per room / car',
                'currency' => 'PHP',
                'office_hours' => '800',
                'after_office_hours' => '1050',
            ],
            [
                'header_id' => 3,
                'subheader_id' => null,
                'service_name' => 'Travel Insurance only (without ticket)',
                'measure' => 'per policy',
                'currency' => 'PHP',
                'office_hours' => '300',
                'after_office_hours' => '550',
            ],
            [
                'header_id' => 3,
                'subheader_id' => null,
                'service_name' => 'Travel Insurance (with ticket)',
                'measure' => 'per policy',
                'currency' => 'PHP',
                'office_hours' => 'Included',
                'after_office_hours' => '300',
            ],
            [
                'header_id' => 3,
                'subheader_id' => null,
                'service_name' => 'Bill Back',
                'measure' => 'per transaction',
                'currency' => 'PHP',
                'office_hours' => '2% of total cost but not lower than 1000',
                'after_office_hours' => '2% of total cost but not lower than 1000',
            ],
            [
                'header_id' => 5,
                'subheader_id' => null,
                'service_name' => 'Visa Application',
                'measure' => 'per transaction',
                'currency' => 'PHP',
                'office_hours' => '2000',
                'after_office_hours' => 'n/a',
            ],
            [
                'header_id' => 5,
                'subheader_id' => null,
                'service_name' => 'Expedite Visa Filing (surcharge to visa application service fee)',
                'measure' => 'per transaction',
                'currency' => 'PHP',
                'office_hours' => '2500',
                'after_office_hours' => 'n/a',
            ],
            [
                'header_id' => 7,
                'subheader_id' => null,
                'service_name' => 'Invoice reprint / Certified True Copy of Invoices',
                'measure' => 'per invoice',
                'currency' => 'PHP',
                'office_hours' => '300',
                'after_office_hours' => 'n/a',
            ],
            [
                'header_id' => 7,
                'subheader_id' => null,
                'service_name' => 'Additional Baggage',
                'measure' => 'per pax',
                'currency' => 'PHP',
                'office_hours' => '500',
                'after_office_hours' => '800',
            ],
            [
                'header_id' => 7,
                'subheader_id' => null,
                'service_name' => 'Choice Seat Arrangement',
                'measure' => 'per pax',
                'currency' => 'PHP',
                'office_hours' => '500',
                'after_office_hours' => '800',
            ],
            [
                'header_id' => 7,
                'subheader_id' => null,
                'service_name' => 'Web Check-in',
                'measure' => 'per pax',
                'currency' => 'PHP',
                'office_hours' => '500',
                'after_office_hours' => '800',
            ],
            [
                'header_id' => 9,
                'subheader_id' => null,
                'service_name' => 'Booking of airport assistance in Metro Manila',
                'measure' => 'per pax / representative',
                'currency' => 'PHP',
                'office_hours' => '1900',
                'after_office_hours' => '2200',
            ],
            [
                'header_id' => 11,
                'subheader_id' => null,
                'service_name' => 'Assistance in Meetings, Group & Events',
                'measure' => 'per service agreement',
                'currency' => 'PHP',
                'office_hours' => 'Separate Service Agreement & Endorsed to respective department',
                'after_office_hours' => 'Separate Service Agreement & Endorsed to respective department',
            ],
            [
                'header_id' => 11,
                'subheader_id' => null,
                'service_name' => 'Cultural Assimilation Tours for Expats',
                'measure' => 'per service agreement',
                'currency' => 'PHP',
                'office_hours' => 'Separate Service Agreement & Endorsed to respective department',
                'after_office_hours' => 'Separate Service Agreement & Endorsed to respective department',
            ],
        ];

        // Iterate through the client IDs and insert the data
        foreach ($clients as $client_id) {
            foreach ($data as $service) {
                DB::table('summary_services')->insert(array_merge(
                    $service,
                    [
                        'client_id' => $client_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                ));
            }
        }
    }
}
