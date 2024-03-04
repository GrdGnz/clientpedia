<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->integer('status_id')->default(1);
            $table->timestamps();
        });

        // Insert default data
        $data = [
            ['code' => 'AA', 'name' => 'American Airlines'],
            ['code' => '2G', 'name' => 'CargoItalia (alternate)'],
            ['code' => 'CO', 'name' => 'Continental Airlines'],
            ['code' => 'DL', 'name' => 'Delta Air Lines'],
            ['code' => 'NW', 'name' => 'Northwest Airlines (alternate site)'],
            ['code' => 'AC', 'name' => 'Air Canada'],
            ['code' => 'UA', 'name' => 'United Airlines Cargo'],
            ['code' => 'CP', 'name' => 'Canadian Airlines Int´l'],
            ['code' => 'LH', 'name' => 'Lufthansa Cargo AG'],
            ['code' => 'FX', 'name' => 'Fedex'],
            ['code' => 'AS', 'name' => 'Alaska Airlines'],
            ['code' => 'US', 'name' => 'USAirways'],
            ['code' => 'RG', 'name' => 'VARIG Brazilian Airlines'],
            ['code' => 'KA', 'name' => 'Dragonair'],
            ['code' => 'LA', 'name' => 'LAN Chile'],
            ['code' => 'TP', 'name' => 'TAP Air Portugal'],
            ['code' => 'CY', 'name' => 'Cyprus Airways'],
            ['code' => 'OA', 'name' => 'Olympic Airways'],
            ['code' => 'EI', 'name' => 'Aer Lingus Cargo'],
            ['code' => 'AZ', 'name' => 'Alitalia'],
            ['code' => 'AF', 'name' => 'Air France'],
            ['code' => 'IC', 'name' => 'Indian Airlines'],
            ['code' => 'HM', 'name' => 'Air Seychelles'],
            ['code' => 'OK', 'name' => 'Czech Airlines'],
            ['code' => 'SV', 'name' => 'Saudi Arabian Airlines'],
            ['code' => 'RB', 'name' => 'Syrian Arab Airlines'],
            ['code' => 'ET', 'name' => 'Ethiopian Airlines'],
            ['code' => 'GF', 'name' => 'Gulf Air'],
            ['code' => 'KL', 'name' => 'KLM Cargo'],
            ['code' => 'IB', 'name' => 'Iberia'],
            ['code' => 'ME', 'name' => 'Middle East Airlines'],
            ['code' => 'MS', 'name' => 'Egyptair'],
            ['code' => 'PR', 'name' => 'Philippine Airlines'],
            ['code' => 'AF', 'name' => 'Air France'],
            ['code' => 'LO', 'name' => 'LOT Polish Airlines'],
            ['code' => 'QF', 'name' => 'Qantas Airways'],
            ['code' => 'SN', 'name' => 'Brussels Airlines'],
            ['code' => 'SA', 'name' => 'South African Airways'],
            ['code' => 'NZ', 'name' => 'Air New Zealand'],
            ['code' => 'IT', 'name' => 'Kingfisher Airlines'],
            ['code' => 'KD', 'name' => 'KD Avia'],
            ['code' => 'IR', 'name' => 'Iran Air'],
            ['code' => 'AI', 'name' => 'Air India'],
            ['code' => 'AY', 'name' => 'Finnair'],
            ['code' => 'BW', 'name' => 'Caribbean Airlines'],
            ['code' => 'FI', 'name' => 'Icelandair'],
            ['code' => 'CK', 'name' => 'China Cargo Airlines'],
            ['code' => 'LY', 'name' => 'EL AL'],
            ['code' => 'JU', 'name' => 'JAT Airways'],
            ['code' => 'SK', 'name' => 'SAS-Scandinavian Airlines System'],
            ['code' => 'DT', 'name' => 'TAAG Angola Airlines'],
            ['code' => 'LM', 'name' => 'Air ALM'],
            ['code' => 'AH', 'name' => 'Air Algerie'],
            ['code' => 'BA', 'name' => 'British Airways'],
            ['code' => 'GA', 'name' => 'Garuda Indonesia'],
            ['code' => 'MP', 'name' => 'Martinair Cargo'],
            ['code' => 'JL', 'name' => 'Japan Airlines'],
            ['code' => 'LR', 'name' => 'LACSA Airlines of Costa Rica'],
            ['code' => 'AM', 'name' => 'Aeromexico Cargo'],
            ['code' => 'LI', 'name' => 'LIAT Airlines'],
            ['code' => 'AT', 'name' => 'Royal Air Maroc'],
            ['code' => 'LN', 'name' => 'Libyan Airlines'],
            ['code' => 'QR', 'name' => 'Qatar Airways'],
            ['code' => 'CX', 'name' => 'Cathay Pacific Airways'],
            ['code' => '3V', 'name' => 'TNT Airways'],
            ['code' => 'JP', 'name' => 'Adria Airways'],
            ['code' => 'CV', 'name' => 'Cargolux Airlines'],
            ['code' => 'EK', 'name' => 'Emirates'],
            ['code' => 'KE', 'name' => 'Korean Air'],
            ['code' => 'MA', 'name' => 'Malev Hungarian Airlines'],
            ['code' => 'RG', 'name' => 'VARIG Brazilian Airlines'],
            ['code' => 'JI', 'name' => 'Jade Cargo International'],
            ['code' => 'JM', 'name' => 'Air Jamaica'],
            ['code' => 'TA', 'name' => 'TACA'],
            ['code' => 'NH', 'name' => 'ANA All Nippon Cargo'],
            ['code' => 'PK', 'name' => 'Pakistan Int´l Airlines'],
            ['code' => 'TG', 'name' => 'Thai Airways'],
            ['code' => 'KU', 'name' => 'Kuwait Airways'],
            ['code' => 'CM', 'name' => 'Copa Airlines Cargo'],
            ['code' => 'NG', 'name' => 'Lauda Air'],
            ['code' => 'MH', 'name' => 'Malaysian Airline System'],
            // ... (add the rest of the default data here)
        ];

        DB::table('airlines')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airlines');
    }
}
