<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('session_id')->constrained('sessions');
            $table->string('roll_number')->unique();
            $table->integer('semester');
            $table->integer('capstone')->default(1);
            $table->integer('credit_hours')->nullable();
            $table->integer('quality_points')->nullable();
            $table->float('cgpa');
            $table->tinyInteger('is_alumni')->default(0);
            $table->tinyInteger('late_status')->default(0);
            $table->tinyInteger('fyp_registration_status')->default(0);
            $table->tinyInteger('supervisor_allocation_status')->default(0);
            $table->tinyInteger('group_formation_status')->default(0);
            $table->integer('progress_level')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
