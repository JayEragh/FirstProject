<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [ 'email' => 'admin@docmag.com' ],
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'company' => 'DOCmag',
                'email' => 'admin@docmag.com',
                'password' => Hash::make('password'),
            ]
        );
    }
}
