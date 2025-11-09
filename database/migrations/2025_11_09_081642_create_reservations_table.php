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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTimeTz('reservation_start_time')->notNullable();
            $table->dateTimeTz('reservation_end_time')->notNullable();
            $table->timestamp('reservation_updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->enum('status', ['pending', 'approved', 'declined', 'ongoing', 'canceled'])->notNullable()->default('pending');
            $table->text('reservation_description')->nullable();
            $table->foreignId('student_user_id')->nullable()->constrained('users')->onDelete(action: 'set null');
            $table->foreignId('librarian_user_id')->nullable()->constrained('users')->onDelete(action: 'set null');
            $table->foreignId('resource_id')->nullable()->constrained('resources')->onDelete(action: 'set null');
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->onDelete(action: 'set null');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
