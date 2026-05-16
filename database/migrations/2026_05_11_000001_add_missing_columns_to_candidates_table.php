<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            if (!Schema::hasColumn('candidates', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('candidates', 'email')) {
                $table->string('email')->nullable()->unique()->after('name');
            }
            if (!Schema::hasColumn('candidates', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('email');
            }
            if (!Schema::hasColumn('candidates', 'password')) {
                $table->string('password')->nullable()->after('email_verified_at');
            }
            if (!Schema::hasColumn('candidates', 'remember_token')) {
                $table->rememberToken()->after('password');
            }
        });
    }

    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn(array_filter([
                Schema::hasColumn('candidates', 'remember_token')    ? 'remember_token'    : null,
                Schema::hasColumn('candidates', 'password')          ? 'password'          : null,
                Schema::hasColumn('candidates', 'email_verified_at') ? 'email_verified_at' : null,
                Schema::hasColumn('candidates', 'email')             ? 'email'             : null,
                Schema::hasColumn('candidates', 'name')              ? 'name'              : null,
            ]));
        });
    }
};
