<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;


class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Administrator::create([
            'adm_name' => 'Test Admin',
            'adm_email' => 'admin@test.com',
            'adm_password' => Hash::make('test'),
            
        ]);
    }
}
