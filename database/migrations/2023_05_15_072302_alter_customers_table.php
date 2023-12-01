<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('firstname')->nullable(false)->change();
            $table->string('type', 24)->default('individual')->change();
            $table->string('email')->nullable(false)->unique()->change();
            $table->timestamp('email_verified_at')->after('is_active')->nullable();
            $table->string('password')->after('is_active');
            $table->rememberToken()->after('is_active')->nullable();

            $table->string('google_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
