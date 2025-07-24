<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('simulations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('scenario');
            $table->json('steps');
            $table->json('correct_answers');
            $table->string('type'); // phishing, malware, password_security, etc.
            $table->boolean('is_published')->default(false);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('simulation_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('simulation_id')->constrained()->onDelete('cascade');
            $table->json('user_answers');
            $table->integer('score');
            $table->text('feedback');
            $table->timestamp('completed_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('simulation_results');
        Schema::dropIfExists('simulations');
    }
}; 