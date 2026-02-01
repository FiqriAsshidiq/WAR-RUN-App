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
    Schema::create('workouts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
        $table->dateTime('start_time');
        $table->dateTime('end_time')->nullable();
        $table->decimal('total_distance', 8, 2)->default(0);
        $table->decimal('avg_speed', 5, 2)->nullable();
        $table->decimal('max_speed', 5, 2)->nullable();
        $table->integer('total_steps')->unsigned()->nullable();
        $table->decimal('start_lat', 10, 7);
        $table->decimal('start_lng', 10, 7);
        $table->decimal('end_lat', 10, 7)->nullable();
        $table->decimal('end_lng', 10, 7)->nullable();
        $table->boolean('is_loop')->default(false);
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
