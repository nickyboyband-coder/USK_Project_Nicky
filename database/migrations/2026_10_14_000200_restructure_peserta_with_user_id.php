<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('peserta');

        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('nik', 16)->unique();
            $table->string('no_hp', 20);
            $table->foreignId('skema_id')->constrained('skema')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });

        // Pindahkan data dari users ke peserta (user tanpa skema dilewati)
        $rows = DB::table('users')
            ->where('role', 'user')
            ->whereNotNull('nik')
            ->whereNotNull('skema_id')
            ->get();

        foreach ($rows as $row) {
            DB::table('peserta')->insert([
                'user_id'    => $row->id,
                'nik'        => $row->nik,
                'no_hp'      => $row->no_hp ?? '',
                'skema_id'   => $row->skema_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('skema_id');
            $table->dropUnique(['nik']);
            $table->dropColumn(['nik', 'no_hp']);
        });
    }

    public function down(): void
    {
        // Tidak dikembalikan.
    }
};