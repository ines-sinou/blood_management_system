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
           Schema::create('hospitals', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('region'); // Add this column
    $table->unsignedBigInteger('membership_id')->nullable();
    $table->date('membership_start')->nullable();
    $table->date('membership_end')->nullable();
    $table->timestamps();

    // Foreign key, assuming memberships table exists
    $table->foreign('membership_id')
          ->references('id')
          ->on('memberships')
          ->onDelete('set null');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
