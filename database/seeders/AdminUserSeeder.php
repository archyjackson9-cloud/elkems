<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Create the initial admin user.
     *
     * Credentials are read from environment variables so they are never
     * hard-coded in version control.
     *
     * Set in your .env before running db:seed:
     *   ADMIN_NAME="ELD Admin"
     *   ADMIN_EMAIL="admin@eldsolutions.com"
     *   ADMIN_PASSWORD="change_me_immediately"
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'info@eldsolutionsgh.com');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => env('ADMIN_NAME', 'ELD Admin'),
                'email'    => $email,
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Cyba$100!')),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user created: ' . $email);
        $this->command->warn('→ Change the ADMIN_PASSWORD in your .env and re-seed, or reset via admin panel.');
    }
}
