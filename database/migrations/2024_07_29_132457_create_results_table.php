<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('reps_type');
            $table->string('rehearsals');
            $table->string('weights');
            $table->integer('rounds');
            $table->string('percentage')->nullable();
            $table->timestamp('done_at')->default(Carbon::now());
            $table->foreignId('user_id')->constrained();
            $table->foreignId('exercise_id')->constrained('exercises');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
