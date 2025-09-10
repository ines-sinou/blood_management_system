<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // donor making appointment
            $table->foreignId('hospital_id')->constrained()->onDelete('cascade'); // hospital chosen
            $table->dateTime('appointment_date');   // when the donor wants to donate
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->text('notes')->nullable();      // optional notes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
