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
        Schema::create('defense_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('defense_id')->constrained('defenses');
            $table->foreignId('faculty_id')->constrained('faculties');
            $table->foreignId('student_id')->constrained('students');
            $table->decimal('project_work');
            $table->decimal('presentation');
            $table->decimal('documentation');
            $table->decimal('total');
            $table->tinyInteger('is_finalized')->default(0);
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
        Schema::dropIfExists('defense_grades');
    }
};
