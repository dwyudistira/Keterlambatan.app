<?php

namespace Database\Seeders;
use App\models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user::create([
            'name' => 'Bu Adel',
            'email' => 'PSCic2@gmail.com',
            'password'=> Hash::make('pslate'),
            'role' => 'ps',
        ]);
    }
}
