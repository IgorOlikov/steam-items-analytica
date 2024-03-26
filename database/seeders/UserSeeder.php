<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
      $users = [
          [
              'id' => Uuid::uuid(),
            'name' => 'igoruser',
            'role_id' => 2,
            'email' => 'igoruser@mail.ru',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
            'remember_token' => Str::random(10),
         ],
         [
             'id' => Uuid::uuid(),
            'name' => 'igoradmin',
             'role_id' => 1,
            'email' => 'igoradmin@mail.ru',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
            'remember_token' => Str::random(10),
         ]
      ];

      User::insert($users);






    }
}
