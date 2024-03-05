<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UpdateUserPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Update passwords for all users except user with id = 1
        $users = User::where('id', '<>', 1)->get();

        foreach ($users as $user) {
            $user->update([
                'password' => Hash::make('marsman1'),
            ]);
        }
    }
}
