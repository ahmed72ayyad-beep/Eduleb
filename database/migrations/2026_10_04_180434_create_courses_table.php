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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('sub_title')->nullable();

            $table->foreignId("instructor_id")->nullable()->constrained()->cascadeOnDelete();

            $table->integer('star_num');
            $table->string('outer_image')->nullable();
            $table->string('inner_image')->nullable();
            $table->string('duration')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('price');
            $table->integer('total_lectures')->nullable();
            $table->text('description')->nullable();
            $table->text('overview')->nullable();
            $table->longText('curriculum')->nullable();
            $table->integer('available_seats')->nullable();
            $table->enum("certification",["yes","no"])->default("yes")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
