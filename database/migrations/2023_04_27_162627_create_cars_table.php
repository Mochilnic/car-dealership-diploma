<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->integer('price');
            $table->string('body_type');
            $table->string('transmission');
            $table->integer('doors');
            $table->string('engine_type');
            $table->integer('engine_power');
            $table->integer('torque');
            $table->float('acceleration');
            $table->integer('top_speed');
            $table->text('description');
            $table->text('main_image');
            $table->json('additional_images')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
