<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1russ@russ.com',
            'password' => Hash::make('russCor_te_2025'),
        ]);

        User::create([
            'name' => 'Admin2',
            'email' => 'admin2russ@russ.com',
            'password' => Hash::make('l_a_serTrujillo12'),
        ]);

        User::create([
            'name' => 'Admin3',
            'email' => 'admin3russ@russ.com',
            'password' => Hash::make('mader_aR_uss34'),
        ]);

        User::create([
            'name' => 'Admin4',
            'email' => 'admin4russ@russ.com',
            'password' => Hash::make('cort_eL_aser56'),
        ]);

        User::create([
            'name' => 'Admin5',
            'email' => 'admin5russ@russ.com',
            'password' => Hash::make('trujill_oM_adera78'),
        ]);
    }
}
