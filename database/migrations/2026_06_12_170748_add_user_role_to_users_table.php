<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            // Modify ENUM to add 'user' and set default to 'user'
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('owner', 'cashier', 'user') DEFAULT 'user'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            // To safely rollback, we would need to delete 'user' roles first, 
            // but for this migration we can just revert the ENUM definition.
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('owner', 'cashier') DEFAULT 'owner'");
        }
    }
};
