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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("author_id")->constrained("users")->cascadeOnDelete();
            $table->string("subject");
            $table->string("image");
            // $table->timestamp("created_at")->useCurrent();
            $table->string("title");
            $table->text("sub_title");
            $table->text("content");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
