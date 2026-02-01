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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->bigInteger("event_id")->references("id")->on("events")->onDelete("cascade");
            $table->bigInteger("coupon_id")->references("id")->on("coupons")->onDelete("cascade")->nullable();
            $table->enum("status", ["pending", "approved"]);
            $table->integer("final_price");
            $table->string("payment_proof")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
