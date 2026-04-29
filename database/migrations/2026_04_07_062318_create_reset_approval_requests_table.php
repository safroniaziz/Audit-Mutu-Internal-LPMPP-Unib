<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reset_approval_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penugasan_auditor_id')->constrained('penugasan_auditors')->onDelete('cascade');
            $table->enum('tahap', ['desk_evaluation', 'instrumen_prodi', 'visitasi']);
            $table->text('alasan');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            // Prevent duplicate pending requests
            $table->unique(['penugasan_auditor_id', 'tahap', 'status'], 'unique_pending_request');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reset_approval_requests');
    }
};
