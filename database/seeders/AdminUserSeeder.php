<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_SEED_EMAIL', 'admin@example.com');
        $password = env('ADMIN_SEED_PASSWORD', 'Admin123456');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin',
                'role' => 'admin',
                // `password` is cast as `hashed` in the User model, so we must store plain text.
                'password' => $password,
                'email_verified_at' => now(),
            ]
        );
    }
}

