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
        Schema::create('fyp_registration_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            // $table->foreignId('request_log_id')->nullable()->constrained('fyp_request_logs');
            $table->string('registration_number')->unique();
            $table->dateTime('registration_date');
            $table->string('personal_email')->nullable()->unique();
            $table->tinyInteger('fyp_student_agreement')->default(0);
            $table->tinyInteger('with_in_city')->nullable();
            $table->tinyInteger('out_of_city')->nullable();
            $table->integer('passed_subjects')->nullable();
            $table->text('current_residential')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('image')->nullable();
            $table->text('remarks')->nullable();
            $table->tinyInteger('is_rejected')->default(0);
            $table->string('rejected_by')->nullable();
            $table->tinyInteger('is_approved')->default(0);
            $table->string('approved_by')->nullable();
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
        Schema::dropIfExists('fyp_registration_numbers');
    }
};
