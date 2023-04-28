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
        Schema::create('pre_defenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('defense_id')->constrained('defenses');
            $table->foreignId('faculty_id')->constrained('faculties');
            $table->foreignId('student_id')->constrained('students');
            $table->text('reviews');
            $table->enum('status', ['Yes', 'No', 'Repeat again']);
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
        Schema::dropIfExists('pre_defenses');
    }
};
