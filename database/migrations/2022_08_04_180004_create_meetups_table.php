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
        Schema::create('meetups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('meet_link')->nullable();
            $table->dateTime('event_start')->nullable();
            $table->dateTime('event_end')->nullable();
            $table->dateTime('meet_datetime')->nullable();
            $table->dateTime('next_expected_meet')->nullable();
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
        Schema::dropIfExists('meetups');
    }
};
