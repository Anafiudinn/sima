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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->after('password');
            $table->unsignedBigInteger('divisi_id')->nullable()->after('role');
            $table->unsignedBigInteger('tempat_id')->nullable()->after('divisi_id');

            $table->foreign('divisi_id')->references('id')->on('divisis')->onDelete('set null');
            $table->foreign('tempat_id')->references('id')->on('tempats')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['divisi_id']);
            $table->dropForeign(['tempat_id']);
            $table->dropColumn(['role', 'divisi_id', 'tempat_id']);
        });
    }
};