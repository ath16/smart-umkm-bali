<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            // Add customer to enum and set as default
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('owner', 'cashier', 'user', 'customer') DEFAULT 'customer'");
            
            // Migrate existing 'user' roles to 'customer'
            DB::table('users')->where('role', 'user')->update(['role' => 'customer']);

            // Remove 'user' from enum
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('owner', 'cashier', 'customer') DEFAULT 'customer'");
        } else {
            DB::table('users')->where('role', 'user')->update(['role' => 'customer']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            // Revert back
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('owner', 'cashier', 'user', 'customer') DEFAULT 'user'");
            
            // Migrate 'customer' back to 'user'
            DB::table('users')->where('role', 'customer')->update(['role' => 'user']);
            
            // Remove 'customer' from enum
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('owner', 'cashier', 'user') DEFAULT 'user'");
        } else {
            DB::table('users')->where('role', 'customer')->update(['role' => 'user']);
        }
    }
};
