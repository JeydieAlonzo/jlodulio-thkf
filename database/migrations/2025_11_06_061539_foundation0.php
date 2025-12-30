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
        // let's make the database from scratch - foundational tables made were: schedules, usertypes, sections, resources, tables still needed are users and reservations

        Schema::dropIfExists('schedules');
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
        });

        Schema::dropIfExists('usertypes');
        Schema::create('usertypes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->enum('role', ['admin', 'librarian', 'student'])->notNullable();
        });

        Schema::dropIfExists('sections');
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('section_name')->notNullable();
            $table->text('description')->nullable();
            $table->timestamp('section_updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        Schema::dropIfExists('resources');
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('resource_type', 20)->notNullable();
            $table->string('resource_name')->unique()->notNullable();
            $table->text('description')->nullable();
            $table->integer('availability')->unsigned()->default(0)->notNullable();
            $table->timestamp('resource_updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('set null');
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
