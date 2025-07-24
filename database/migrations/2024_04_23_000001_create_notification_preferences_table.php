<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('progress_updates')->default(true);
            $table->boolean('new_materials')->default(true);
            $table->boolean('quiz_reminders')->default(true);
            $table->boolean('security_alerts')->default(true);
            $table->enum('frequency', ['realtime', 'daily', 'weekly'])->default('daily');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_preferences');
    }
}; 