<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Retrieve all existing clients from the database
        $existingUsers = User::all();

        // If there are no existing clients, use the provided data
        if ($existingUsers->isEmpty()) {
            $users = [
                ['Admin', 'User', 'Admin User', 'admin@marsman.com', bcrypt('marsman1'), 3, 'Admin'],
                ['Angel',	'Bengosta',	'Angel O. Bengosta',	'angel.obrero@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'LDS'],
                ['Camille',	'Mainot',	'Camille V. Mainot',	'camille.mainot@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Catherine',	'Hernandez',	'Catherine T. Hernandez',	'catherine.hernandez@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Cecilia Rosario',	'Villejo',	'Cecilia Rosario M. Villejo',	'cecilia.villejo@ph.travelleadersint.com',	bcrypt('marsman1'),	1,	'BTC'],
                ['Charles Ace',	'Serrano',	'Charles Ace A. Serrano',	'charles.serrano@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Cindy',	'Ignacio',	'Cindy V. Ignacio',	'cindy.ignacio@ph.travelleadersint.com',	bcrypt('marsman1'),	1,	'Sales & Account Management'],
                ['Cynthia',	'Lanuevo',	'Cynthia A. Lanuevo',	'cynthia.lanuevo@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Efren',	'Fajardo',	'Efren B. Fajardo Jr.',	'efren.fajardo@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Emily',	'Macamos',	'Emily C. Macamos',	'emily.macamos@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Everlyn',	'Enriquez',	'Everlyn T. Enriquez',	'everlyn.enriquez@ph.travelleadersint.com',	bcrypt('marsman1'),	1,	'BTC'],
                ['Joey',	'Sison',	'Joey Sison',	'joey.sison@ph.travelleadersint.com',	bcrypt('marsman1'),	3,	'Information Technology'],
                ['Johanna',	'Cruz',	'Johanna R. Cruz',	'johanna.cruz@ph.travelleadersint.com',	bcrypt('marsman1'),	1,	'BTC'],
                ['Jonna Dell',	'Imutan',	'Jonna Dell D. Imutan',	'jonna.imutan@ph.travelleadersint.com',	bcrypt('marsman1'),	1,	'Sales & Account Management'],
                ['Jovel',	'Sergio',	'Jovel A. Sergio',	'jovel.sergio@ph.travelleadersint.com',	bcrypt('marsman1'),	1,	'Sales & Account Management'],
                ['Juliet',	'Alejandro',	'Juliet L. Alejandro',	'juliet.alejandro@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Ligaya',	'De Sagun',	'Ligaya L. De Sagun',	'ligaya.desagun@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Maria Romina',	'Santiano',	'Ma. Romina M. Santiano',	'romina.santiano@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Marielle',	'Bacolod',	'Marielle C. Bacolod',	'marielle.bacolod@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Mary Ann',	'Borromeo',	'Mary Ann A. Borromeo',	'maryann.borromeo@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Maylyn',	'Esteves',	'Maylyn P. Esteves',	'maylyn.esteves@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Omar',	'San Andres',	'Omar M. San Andres',	'omar.sanandres@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'IRRI'],
                ['Pauline Joy',	'Ormenita',	'Pauline Joy G. Ormenita',	'pauline.ormenita@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Raysalyn',	'De Leon',	'Raysalyn G. De Leon',	'raysalyn.deleon@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'LDS'],
                ['Rechelle',	'Lozardo',	'Rechelle G. Lozardo',	'rechelle.lozardo@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Reynaldo',	'Mendoza',	'Reynaldo G. Mendoza',	'rey.mendoza@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Richell',	'Suaybaguio',	'Richell M. Suaybaguio',	'richell.suaybaguio@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Rose Jacklyn',	'Abrenica',	'Rose Jacklyn C. Abrenica',	'rose.abrenica@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Rowell Joseph',	'Cruz',	'Rowell J. Cruz',	'rowell.cruz@ph.travelleadersint.com',	bcrypt('marsman1'),	3,	'Information Technology'],
                ['Salvador',	'Caña',	'Salvador C. Caña',	'salvador.cana@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'LDS'],
                ['Shayne',	'Bersalona',	'Shayne M. Bersalona',	'shayne.bersalona@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Shiela May',	'Derilo',	'Shiela May L. Derilo',	'shiela.derilo@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],
                ['Vea',	'Parducho',	'Vea P. Parducho',	'vea.parducho@ph.travelleadersint.com',	bcrypt('marsman1'),	2,	'BTC'],

            ];

            foreach ($users as $user) {
                User::create([
                    'firstname' => $user[0],
                    'lastname' => $user[1],
                    'name' => $user[2],
                    'email' => $user[3],
                    'password' => $user[4],
                    'role_id' => $user[5],
                    'department' => $user[6],
                ]);
            }
        } else {
            // Use existing clients from the database
            foreach ($existingUsers as $existingUser) {
                User::create([
                    'firstname' => $existingUser[0],
                    'lastname' => $existingUser[1],
                    'name' => $existingUser[2],
                    'email' => $existingUser[3],
                    'password' => $existingUser[4],
                    'role_id' => $existingUser[5],
                    'department' => $existingUser[6],
                ]);
            }
        }
    }
}
