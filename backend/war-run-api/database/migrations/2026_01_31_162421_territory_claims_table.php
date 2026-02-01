<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
    {
        Schema::create('territory_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('territory_id')->constrained('territories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('old_owner_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('new_owner_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('workout_id')->constrained('workouts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('claim_time');
            $table->enum('claim_type', ['new', 'steal']);
            $table->timestamps();
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
