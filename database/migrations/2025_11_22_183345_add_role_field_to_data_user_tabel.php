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
        Schema::table('data_user', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete sample data first
        DB::table('data_user')->whereIn('email', ['admin@funcar.com', 'user@funcar.com'])->delete();

        Schema::table('data_user', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};