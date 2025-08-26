<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        $password = env('ADMIN_PASSWORD', 'password');

        $exists = DB::table('users')->where('email', $email)->exists();
        if (! $exists) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        DB::table('users')->where('email', $email)->delete();
    }
};



