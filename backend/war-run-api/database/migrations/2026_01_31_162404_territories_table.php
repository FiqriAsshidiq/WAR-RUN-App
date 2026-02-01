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
        Schema::create('territories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('workout_id')->constrained('workouts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name', 100);
            $table->decimal('center_lat', 10, 7);
            $table->decimal('center_lng', 10, 7);
            $table->decimal('area_distance', 8, 2); 
            $table->integer('best_time')->unsigned(); 
             $table->index(['owner_id']);
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
