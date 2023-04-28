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
        Schema::create('deadline_types', function (Blueprint $table) {
            $table->id();
            $table->dateTime('name');
            $table->timestamps();
        });

        Schema::create('deadlines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deadline_type_id')->constrained('deadline_types');
            $table->dateTime('deadline');
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
        Schema::dropIfExists('deadlines');
    }
};
