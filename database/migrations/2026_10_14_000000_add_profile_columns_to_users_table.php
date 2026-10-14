<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // nullable karena akun admin tidak punya NIK / skema
            $table->string('nik', 16)->nullable()->unique()->after('name');
            $table->string('no_hp', 20)->nullable()->after('email');

            $table->foreignId('skema_id')
                ->nullable()
                ->after('no_hp')
                ->constrained('skema')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('skema_id');
            $table->dropUnique(['nik']);
            $table->dropColumn(['nik', 'no_hp']);
        });
    }
};