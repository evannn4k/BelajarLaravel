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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->text("description");
            $table->foreignId("category_id")->constrained("categories", "id");
            $table->integer("price");
            $table->integer("quota");
            $table->boolean("status");
            $table->dateTime("event_date");
            $table->dateTime("reg_open_at");
            $table->dateTime("reg_close_at");
            $table->string("image");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
